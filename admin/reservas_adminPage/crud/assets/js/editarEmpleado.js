/**
 * Función para mostrar la modal de aceptar reserva
 */
async function aceptarReserva(idReserva) {
  try {
    // Elimina el modal existente si ya está en el DOM
    const existingModal = document.getElementById("aceptarReserva");
    if (existingModal) {
      existingModal.remove();
    }

    // Cargar el modal desde el servidor
    const response = await fetch(`crud/modales/modalEditar.php?id_reserva=${idReserva}`);
    if (!response.ok) {
      throw new Error("Error al cargar la modal de editar el empleado");
    }
    const modalHTML = await response.text();

    // Agregar el modal al DOM
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;
    document.body.appendChild(modalContainer);

    // Mostrar el modal
    const myModal = new bootstrap.Modal(modalContainer.querySelector("#aceptarReserva"));
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para aprobar una reserva y actualizar su estado a "aprobada".
 * @param {number} idReserva - ID de la reserva a aprobar.
 */
async function aprobarReserva(idReserva) {
  try {
    // Enviar la solicitud al servidor para actualizar el estado
    const response = await fetch("crud/acciones/aprobar_evento.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id: idReserva, estado: "aprobada" }),
    });

    // Verificar la respuesta del servidor
    const data = await response.json();
    if (!response.ok || !data.status) {
      throw new Error(data.msg || "Error al aprobar la reserva");
    }

    // Mostrar mensaje de éxito
    alert(data.msg || "Reserva aprobada con éxito");

    // Cerrar el modal
    const modalElement = document.getElementById("aceptarReserva");
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
      modalInstance.hide();
    }
    modalElement.remove();

    // Opcional: actualizar la lista de eventos en la interfaz si es necesario
    // Puedes usar calendar.refetchEvents() si estás trabajando con FullCalendar
  } catch (error) {
    console.error("Error:", error);
    alert("No se pudo aprobar la reserva. Inténtalo de nuevo.");
  }
}