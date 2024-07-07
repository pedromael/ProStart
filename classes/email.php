<?php
function enviar_email($conteudo,$destinatario,$PHPMailer)  {
   $mail = $PHPMailer;
   try {
      // Configuração do servidor SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';  // Altere para o servidor SMTP correto
      $mail->SMTPAuth = true;
      $mail->Username = 'pedromael14@gmail.com'; // Seu email
      $mail->Password = '';  // Sua senha de email
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Remetente e destinatário
      $mail->setFrom('pedromael14@gmail.com', 'pedro Manuel');
      $mail->addAddress($destinatario[0], $destinatario[1]);

      // Conteúdo do email
      $mail->isHTML(true);
      $mail->Subject = $conteudo[0]; //'Assunto do Email'
      $mail->Body = $conteudo[1]; //'Este é o conteúdo da mensagem HTML.'
      $mail->AltBody = $conteudo[2]; //'Este é o conteúdo da mensagem em texto simples para clientes de email que não suportam HTML.'

      // Enviar email
      $mail->send();
      return true;
   } catch (Exception $e) {
      echo 'Erro ao enviar o email: ' . $mail->ErrorInfo;
   }
}
?>