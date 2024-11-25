<?php
class notificacoes extends process
{
    private $id_user; 

    public function __construct(){
        parent::__construct();
        $this->id_user = $_SESSION['id_user'];
    }
    private function mostrar($sql, $stilo_de_bordas)
    {
        $stilo_de_bordas = $stilo_de_bordas == 1 ? 'notific_1' : 'notific_2';

        $id_dest = $sql['id_dest'];
        $id = $sql['id'];
        $user = $this->usuario($id_dest);
        $imagen = pegar_foto_perfil('perfil', $id_dest);
        
        $data = resumir_data($sql['data']);
        $userName = htmlspecialchars($user['nome']);

        if ($sql['tipo'] == "cmt" || $sql['tipo'] == "cmt_code") {
            $id_historico = $sql['id_historico'];
            $id = mysqli_query(conn(), "SELECT id FROM pro_start_outros.historico_id WHERE id_historico = $id_historico");
            $id = mysqli_fetch_assoc($id);
            if (empty($id['id'])) return false;
            $id = $id['id'];

            if ($sql['tipo'] == "cmt") {
                $cmt = mysqli_query(conn(), "
                    SELECT cmt.texto AS texto_cmt, pbl.id_pbl, tipo, pbl.texto AS texto_pbl 
                    FROM pbl 
                    INNER JOIN cmt ON cmt.id = pbl.id_pbl
                    WHERE cmt.id_cmt = $id
                ");
                $cmt = mysqli_fetch_assoc($cmt);

                $commentText = resumir_texto($cmt['texto_cmt'], 28);
                $postId = criptografar($cmt['id_pbl']);
                echo $this->renderNotification(
                    $imagen,
                    $userName,
                    " comentou na tua publicação",
                    $commentText,
                    "pbl/?pbl=$postId",
                    "chat-left-dots",
                    $data,
                    $stilo_de_bordas
                );
            } elseif ($sql['tipo'] == "cmt_code") {
                $cmt = $this->pdo->prepare("
                    SELECT cmt.texto AS texto_cmt, cod.id_code, tipo, cod.titulo AS texto_pbl 
                    FROM codigos AS cod
                    INNER JOIN cmt ON cmt.id = cod.id_code
                    WHERE cmt.id_cmt = :id AND cmt.tipo = 'code'
                ");
                $cmt->bindValue(":id", $id);
                $cmt->execute();
                $cmt = $cmt->fetch();

                $commentText = resumir_texto($cmt['texto_cmt'], 28);
                $codeId = criptografar($cmt['id_code']);
                echo $this->renderNotification(
                    $imagen,
                    $userName,
                    " comentou no teu código",
                    $commentText,
                    "coder/ver.php?coder=$codeId&modificar=0&comentar=1",
                    "chat-left-dots",
                    $data,
                    $stilo_de_bordas
                );
            }
        } elseif ($sql['tipo'] == "reagir_pbl") {
            $pbl = mysqli_query(conn(), "
                SELECT pbl.texto, pbl.id_pbl 
                FROM pbl 
                WHERE id_pbl = $id
            ");
            $pbl = mysqli_fetch_assoc($pbl);

            $reactionText = resumir_texto($pbl['texto'], 25);
            $postId = criptografar($pbl['id_pbl']);
            echo $this->renderNotification(
                $imagen,
                $userName,
                " reagiu à tua publicação",
                $reactionText,
                "pbl/?pbl=$postId",
                "heart-fill",
                $data,
                $stilo_de_bordas
            );
        } elseif ($sql['tipo'] == "contacto_aceite") {
            $profileLink = "perfil/?user=" . criptografar($id_dest);
            echo $this->renderNotification(
                $imagen,
                $userName,
                " aceitou teu pedido de amizade",
                "",
                $profileLink,
                "people",
                $data,
                $stilo_de_bordas
            );
        }
    }

    private function renderNotification($image, $userName, $action, $content, $link, $icon, $date, $style)
    {
    return <<<HTML
    <div class="$style d-flex align-items-start p-3 mb-3 border rounded shadow-sm">
        <div class="profile-pic rounded-circle" style="background-image: url('media/img/$image'); width: 50px; height: 50px; background-size: cover; background-position: center;"></div>
        <div class="ms-3 flex-grow-1">
            <a href="$link" class="text-decoration-none text-dark">
                <div>
                    <strong>$userName</strong>$action
                </div>
                <div class="text-muted small">$content</div>
            </a>
        </div>
        <div class="ms-auto">
            <img src="bibliotecas/bootstrap/icones/$icon.svg" alt="" class="icon-small">
        </div>
        <div class="text-muted small ms-3">$date</div>
    </div>
    HTML;
    }

    public function procurar($tipo = false)
    {
        $query =  $this->pdo->prepare("SELECT id_historico,h.id_user AS id_dest, h.id, tipo , h.data FROM $this->bdnome2.historico AS h
        LEFT JOIN pbl AS p ON (h.id = p.id_pbl AND p.id_user = :user AND (h.tipo = 'cmt' OR h.tipo = 'reagir_pbl'))
        LEFT JOIN contacto AS c ON (h.id = c.id_contacto AND c.id_user = :user AND c.id_user_dest = h.id_user)
        LEFT JOIN codigos AS cod ON (h.id = cod.id_code AND cod.id_user = :user AND h.tipo = 'cmt_code')
        WHERE (((p.id_pbl > 0 OR cod.id_code > 0) AND tipo != 'contacto_aceite') OR (c.id_contacto > 0)) AND h.id_user != :user ORDER BY id_historico DESC");
        $query->bindValue(":user", $this->id_user);
        $query->execute();
        
        if ($tipo) {
            return $query->fetchAll();
        }
        $query = $query->fetchAll();
        foreach ($query as $sql) {
            if (!isset($stilo_de_bordas)) {
                $stilo_de_bordas = 1;
            }
            if ($sql['id'] != NULL) {
                if ($stilo_de_bordas == 1) {
                    $stilo_de_bordas = 2 ;
                }else {
                    $stilo_de_bordas = 1;
                }
                $this->mostrar($sql,$stilo_de_bordas);
                $this->marcar_visto($sql['id_historico'],"notific");
            }
        }  
    }
}
?>