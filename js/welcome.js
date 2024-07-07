function escrever() {
    var div = document.querySelector('.escrever_automatico');
    var texto = div.innerHTML;
    div.innerHTML = '';
    var i = 0;

    function escrever_proxima_letra(i) {
        if (i < texto.length) {
            div.innerHTML += texto[i];
            i++;
            setInterval( function () { }, 200);
            escrever_proxima_letra(i)
        }
    }
    escrever_proxima_letra(i)
}