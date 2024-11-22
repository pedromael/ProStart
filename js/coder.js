try{
  var textareas = document.querySelectorAll(".ver_code");
  textareas.forEach(function(textarea) {
      CodeMirror.fromTextArea(textarea, {
      lineNumbers: true,
      extraKeys: {"Ctrl-Space": "autocomplete"},
      autoCloseBrackets: true,
      matchBrackets: true,
      showCursorWhenSelecting: true,
      mode: "javascript",
      theme: "dracula",
      scrollbars: "none",
      readOnly: true
    });
  });
}catch{}

function activar_codemirror(classe) {
  //alert(classe);
  var textarea = document.querySelector(classe);

      CodeMirror.fromTextArea(textarea, {
      lineNumbers: true,
      extraKeys: {"Ctrl-Space": "autocomplete"},
      autoCloseBrackets: true,
      matchBrackets: true,
      showCursorWhenSelecting: true,
      mode: "javascript",
      theme: "dracula",
      scrollbars: "none",
      readOnly: true
  });
}
function code_all() {
  try{
    var textareas = document.querySelectorAll(".ver_code");
    textareas.forEach(function(textarea) {
        CodeMirror.fromTextArea(textarea, {
        lineNumbers: true,
        extraKeys: {"Ctrl-Space": "autocomplete"},
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        mode: "javascript",
        theme: "dracula",
        scrollbars: "none",
        readOnly: true
      });
    });
  }catch{}
}