const menu = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".slidebar-toggler");
const container_calendario = document.querySelector(".cont");
const row_calendario =document.querySelector(".row")
const contenedor = document.querySelector(".contenedor_effect");


sidebarToggler.addEventListener("click", ()=> {
    sidebar.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    menu.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    container_calendario.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    row_calendario.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    contenedor.classList.toggle("collapsed");
});

//FUNCIONES DEL CALENDARIO 

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    const agendarModal = new bootstrap.Modal(document.getElementById("agendarModal"));

    const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarModal"));

    const msgViewEvento = document.getElementById('msgViewEvento');


    var calendar = new FullCalendar.Calendar(calendarEl, {

      themeSystem: 'bootstrap5',  

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      
      locale:'es',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: 'lista_evento.php',

      eventClick: function (info) {

        document.getElementById("VisualizarEvento").style.display = "block";
        document.getElementById("visualizarModalLabel").style.display = "block";

        document.getElementById("EditarEvento").style.display = "none";
        document.getElementById("editarModalLabel").style.display = "none";


        document.getElementById("visualizar_id_reserva").innerText = info.event.id;
        document.getElementById("visualizar_usuario").innerText = info.event.extendedProps.usuario;
        document.getElementById("visualizar_title").innerText = info.event.title;
        document.getElementById("visualizar_start").innerText = info.event.start.toLocaleString();
        document.getElementById("visualizar_end").innerText = info.event.end !==null ? info.event.end.toLocaleString() : info.event.start.toLocaleString();
        document.getElementById("visualizar_obs").innerText = info.event.extendedProps.obs;

        document.getElementById("edit_id").value = info.event.id;
        document.getElementById("edit_title").value = info.event.title;
        document.getElementById("edit_start").value = convertirData(info.event.start);
        document.getElementById("edit_end").value = info.event.end !==null ? convertirData(info.event.end) : convertirData(info.event.start);
        document.getElementById("edit_obs").value = info.event.extendedProps.obs;
        document.getElementById("edit_color").value = info.event.backgroundColor;

        visualizarModal.show();
      },

      select: function(info){

        console.log(info);

        document.getElementById("ag_start").value = convertirData(info.start);
        document.getElementById("ag_end").value = convertirData(info.start);

        agendarModal.show();
      }
    });

    calendar.render();

 

    function convertirData(data) {

        const dataObj = new Date(data);

        const ano = dataObj.getFullYear();

        const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
        const dia = String(dataObj.getDate()).padStart(2, '0');
        const hora = String(dataObj.getHours()).padStart(2, '0');
        const minuto = String(dataObj.getMinutes()).padStart(2, '0');

        return `${ano}-${mes}-${dia} ${hora}:${minuto}`;

    };

    const formCadEvento = document.getElementById("formCadEvento");
    const msg = document.getElementById("msg");
    const msgAgEvento = document.getElementById("msgAgEvento");
    const btnCadEvento = document.getElementById("btnCadEvento");

    if (formCadEvento){

        formCadEvento.addEventListener("submit", async (e) => {

            e.preventDefault();

            const start = new Date(document.getElementById("ag_start").value);
            const end = new Date(document.getElementById("ag_end").value);

            // Validar que el evento sea el mismo día
            if (
                start.getFullYear() !== end.getFullYear() ||
                start.getMonth() !== end.getMonth() ||
                start.getDate() !== end.getDate()
            ) {
                alert("El evento debe ser agendado para el mismo día.");
                return; // Detener el envío del formulario
            }

            // Validar que la duración no exceda 2 horas
            const diffMs = end - start; // Diferencia en milisegundos
            const diffHours = diffMs / (1000 * 60 * 60); // Convertir a horas

            //Validar horario de reserva
            if (
                start.getHours() < 8 ||
                end.getHours() > 14
            ) {
                alert("El evento esta siendo reservado fuera del horario establecido (8:00am - 02:00 pm)");
                return;
            }


            if (diffHours > 2) {
                alert("El evento no puede durar más de 2 horas.");
                return; // Detener el envío del formulario
            }

            btnCadEvento.value = "Salvando...";

            const datosForm = new FormData(formCadEvento);

            const datos = await fetch("agendar_evento.php", {
                method: "POST",
                body: datosForm,
            });

            const respuesta = await datos.json();

            if (!respuesta['status']){
                msgAgEvento.innerHTML = `<div class="alert alert-danger" role="alert">${respuesta['msg']}</div>`; 

            }else {

                msg.innerHTML = `<div class="alert alert-success" role="alert">${respuesta['msg']}</div>`;
                
                msgAgEvento.innerHTML = "";
                
                formCadEvento.reset();

                const nuevoEvento = {
                    id: respuesta['id'],
                    title: respuesta['title'],
                    color: respuesta['color'],
                    start: respuesta['start'],
                    end: respuesta['end'],
                    obs: respuesta['obs'],
                }

                calendar.addEvent(nuevoEvento);

                removerMsg();

                agendarModal.hide();

            }

            btnCadEvento.value = "Reservar";


        });
    };

    function removerMsg() {
        setTimeout(() => {
            document.getElementById('msg').innerHTML = "";
        }, 3000)
    }

    const btnViewEditEvento = document.getElementById("btnViewEditEvento");

    if (btnViewEditEvento){

        btnViewEditEvento.addEventListener("click", () => {
            document.getElementById("VisualizarEvento").style.display = "none";
            document.getElementById("visualizarModalLabel").style.display = "none";

            document.getElementById("EditarEvento").style.display = "block";
            document.getElementById("editarModalLabel").style.display = "block";
        });
    }

    const btnViewEvento = document.getElementById("btnViewEvento");

    if (btnViewEvento){

        btnViewEvento.addEventListener("click", () => {
            document.getElementById("VisualizarEvento").style.display = "block";
            document.getElementById("visualizarModalLabel").style.display = "block";

            document.getElementById("EditarEvento").style.display = "none";
            document.getElementById("editarModalLabel").style.display = "none";
        });
    }


    const formEditEvento = document.getElementById("formEditEvento");

    const msgEditEvento = document.getElementById("msgEditEvento");

    const btnEditEvento = document.getElementById("btnEditEvento");

    if (formEditEvento){

        formEditEvento.addEventListener("submit", async (e) => {
            
            e.preventDefault();

            btnEditEvento.value= "Guardando...";

            const datosForm = new FormData(formEditEvento);

            const datos = await fetch("editar_evento.php", {
                method: "POST",
                body: datosForm
            });

            const respuesta = await datos.json();

            if (!respuesta['status']){
                msgEditEvento.innerHTML = `<div class="alert alert-danger" role="alert">${respuesta['msg']}</div>`;

            } else {
                msg.innerHTML = `<div class="alert alert-success" role="alert">${respuesta['msg']}</div>`;
                msgEditEvento.innerHTML = "";

                formEditEvento.reset();

                const eventoExiste = calendar.getEventById(respuesta['id']);

                if (eventoExiste) {
                    eventoExiste.setProp('title', respuesta['title']);
                    eventoExiste.setProp('color', respuesta['color'])
                    eventoExiste.setStart('start', respuesta['start'])
                    eventoExiste.setEnd('end', respuesta['end'])
                    eventoExiste.setExtendedProp('obs', respuesta['obs'])
                }

                removerMsg();

                visualizarModal.hide();
            }

            btnEditEvento.value = "Guardar";

        });
    }

    const btnElimtEvento = document.getElementById("btnElimtEvento")

    if (btnElimtEvento){
        btnElimtEvento.addEventListener("click", async() =>{
            const confirmacion = window.confirm("Esta seguro que desea elimnar la reserva?");

            if (confirmacion) {
                var idEvento = document.getElementById("visualizar_id_reserva").textContent;

                const datos = await fetch("eliminar_evento.php?id=" + idEvento);

                const respuesta = await datos.json();

                if (!respuesta ['status']) {
                    msgViewEvento.innerHTML=`<div class="alert alert-danger"  role="alert">${respuesta['msg']}</div>`;
                }else {
                    msg.innerHTML=`<div class="alert alert-warning"  role="alert">${respuesta['msg']}</div>`;
                    msgViewEvento.innerHTML="";

                    const eventoExisteRemover = calendar.getEventById(idEvento);

                    if (eventoExisteRemover){
                        eventoExisteRemover.remove();
                    }

                    removerMsg();

                    visualizarModal.hide();
                }
            }
        });
    };
  });