$(document).ready(function() {
    carregarComentarios();
  
    $('#enviarComentario').click(function() {
      var textoComentario = $('#textoComentario').val();
  
      $.post('adicionar_comentario.php', { comentario: textoComentario }, function(data) {
        $('#textoComentario').val('');
        $('#comentarios').append("<div>" + data + "</div>");
      });
    });
  });
  
  function carregarComentarios() {
    $.get('carregar_comentario.php', function(data) {
      $('#comentarios').html(data);
    });
  }