
var resultado = []

for (let index = 0; index < fechas.length; index++) {

    var tipo = "";

    switch (fechas[index].tipo) {
        case 1:
            tipo = "birthday-cake"
            break;
        case 2:
            tipo = "cutlery"
            break;    
        default:
            tipo = "group"
            break;
    }

    var fecha = {
        id: fechas[index].id,
        title: fechas[index].titulo,
        description: fechas[index].descripcion,
        image: fechas[index].image,
        start: fechas[index].fecha,
        end: fechas[index].finalDate,
        className: 'fc-bg-default',
        icon : tipo

    }

    var date = new Date(fecha.end);
    date.setDate(date.getDate() + 1)
    fecha.end = date


    resultado.push(fecha)

}


jQuery(document).ready(function(){
    jQuery('.datetimepicker').datepicker({
        timepicker: true,
        language: 'es',
        range: true,
        multipleDates: true,
            multipleDatesSeparator: " - ",
      });
    jQuery("#add-event").submit(function(){
        alert("Submitted");
        var values = {};
        $.each($('#add-event').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(
          values
        );
    });
  });
  
  (function () {    
      'use strict';
      // ------------------------------------------------------- //
      // Calendar
      // ------------------------------------------------------ //
      jQuery(function() {
          // page is ready
          jQuery('#calendar').fullCalendar({
              monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
              monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
              dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
              dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
              themeSystem: 'bootstrap4',
              // emphasizes business hours
              businessHours: false,
              defaultView: 'month',
              displayEventTime: false,
              // event dragging & resizing
              editable: false,
              // header
              header: {
                  left: 'title',
                  center: 'month,agendaWeek,agendaDay',
                  right: 'today prev,next'
              },
              events: 
                resultado
                ,
              eventRender: function(event, element) {
                  if(event.icon){
                      element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
                  }
                },
              dayClick: function() {
                  jQuery('#modal-view-event-add').modal();
              },
              eventClick: function(event, jsEvent, view) {
                      if(event.image){
                        jQuery('.event-image').html("<img id='imagen' src=/images/fotos/"+event.image+" alt="+event.image+">");
                      }else{
                        jQuery('.event-image').html("");
                      }
                      jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
                      jQuery('.event-delete').html("<input name='id' type='number' value="+event.id+" hidden>");
                      jQuery('.event-title').html(event.title);
                      jQuery('.event-body').html(event.description.replace("{{","").replace("}}",""));
                      jQuery('.eventUrl').attr('href',event.url);
                      jQuery('#modal-view-event').modal();
              },
          })
      });
    
  })(jQuery);