(function($){
  $('#categorias-productos').change(function(){
    $.ajax({
      url: pg.ajaxurl,
      method:"POST",
      data: {
        'action': ,
        'categoria': $(this).find(':selected').value(),
      },
      beforeSend: function(){
        $("#resultado-productos").html("Cargando...")
      },
      success: function(data){
        let html = "";
        data.forEach(item => {
            html += `<div class col-4 my-3>
            <figure> ${item.imagen} </figure>
            <h4 class=text-center my-2>
            <a href="${item.link}"> ${item.titulo} </a>
            </h4>
            </div>`
        })

        ${"#resultados-novedades"}.html(html);

      },
      error: function(error){
        console.log(error)
      },
    })
  })

  $('document').ready(function(){
    $.ajax({
      url: pg.apiurl+'novedades/3',
      method: "GET",
      beforeSend: function() {
        $("#resultado-novedades").html("Cargando...")
      },
      success: function(data){
        let html = "";
        data.forEach(item => {
            html += `<div class col-4 my-3>
            <figure> ${item.imagen} </figure>
            <h4 class=text-center my-2>
            <a href="${item.link}"> ${item.titulo} </a>
            </h4>
            </div>`
        })

        ${"#resultados-novedades"}.html(html);

      },
      error: function(error){
        console.log(error)
      },
    })
  })
})(jQuery);
