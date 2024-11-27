/**
 * Función para mostrar la modal de detalles del empleado
 */
async function verDetallesEvento(idReserva) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("detalleEventoModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Buscar la Modal de Detalles
    const response = await fetch("crud/modales/modalDetalles.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de detalles del evento");
    }
    // response.text() es un método en programación que se utiliza para obtener el contenido de texto de una respuesta HTTP
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#detalleEventoModal")
    );
    myModal.show();

    await cargarDetalleEvento(idReserva);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para cargar y mostrar los detalles del evento en la modal
 */
async function cargarDetalleEvento(idReserva) {
  try {
    const response = await axios.get(
      `crud/acciones/detallesEmpleado.php?id=${idReserva}`
    );
    if (response.status === 200) {
      console.log(response.data);
      const { usuario, title, start, end, obs } = response.data;


      // Limpiar el contenido existente de la lista ul

      const ulDetalleEvento = document.querySelector(
        "#detalleEventoContenido ul"
      );

      ulDetalleEvento.innerHTML = ` 
        
        <li class="list-group-item"><b>🕵️‍♀️ Usuario:</b> 
          ${usuario ? usuario : "No disponible"}
        </li>
        <li class="list-group-item"><b>➡️ Título :</b> 
          ${title ? title : "No disponible"}
        </li>
        <li class="list-group-item"><b>🕛 Hora de inicio:</b> 
          ${start ? start : "No disponible"}
        </li>
        <li class="list-group-item"><b>🕧 Hora de finalización:</b> 
          ${end ? end : "No disponible"}
        </li>
        <li class="list-group-item"><b>📜 Observaciones:</b> 
          ${obs ? obs : "No disponible"}
        </li>
      `;
    } else {
      alert(`Error al cargar los detalles del evento con ID ${idReserva}`);
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del evento");
  }
}

// Función para verificar la existencia de una imagen
async function verificarExistenciaImagen(url) {
  try {
    const response = await fetch(url, { method: "HEAD" });
    return response.ok;
  } catch (error) {
    console.error("Error al verificar la existencia de la imagen:", error);
    return false;
  }
}
