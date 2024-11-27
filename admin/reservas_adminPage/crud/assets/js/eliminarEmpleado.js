/**
 * Modal para confirmar la eliminación de un evento
 */
async function cargarModalConfirmacion() {
  try {
    const existingModal = document.getElementById("confirmModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Realizar una solicitud GET usando Fetch para obtener el contenido de la modal
    const response = await fetch("crud/modales/modalDelete.php");

    if (!response.ok) {
      throw new Error("Error al cargar la modal de confirmación");
    }

    // Obtener el contenido de la modal
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(modalContainer.querySelector(".modal"));
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para eliminar un evento desde la modal
 */
async function eliminarEvento(idReserva, avatarEmpleado) {
  try {
    // Llamar a la función para cargar y mostrar la modal de confirmación
    await cargarModalConfirmacion();

    // Establecer el ID y la ruta del avatar del empleado en el botón de confirmación
    document
      .getElementById("confirmDeleteBtn")
      .setAttribute("data-id", idReserva);
    document
      .getElementById("confirmDeleteBtn")
      .setAttribute("data-avatar", avatarEmpleado);

    // Agregar un event listener al botón "Eliminar evento"
    document
      .getElementById("confirmDeleteBtn")
      .addEventListener("click", async function () {
        // Obtener el ID y la ruta del avatar del empleado a eliminar
        var idReserva = this.getAttribute("data-id");
        var avatarEmpleado = this.getAttribute("data-avatar");

        try {
          const response = await axios.post("crud/acciones/delete.php", {
            id: idReserva,
            avatar: avatarEmpleado,
          });

          if (response.status === 200) {
            // Eliminar la fila correspondiente al evento de la tabla
            document.querySelector(`#evento_${idReserva}`).remove();
            // Mostrar mensaje de éxito con toastr
            if (window.toastrOptions) {
              toastr.options = window.toastrOptions;
              toastr.success("¡El evento se eliminó correctamente!");
            }
          } else {
            alert(`Error al eliminar el evento con ID ${idReserva}`);
          }
        } catch (error) {
          console.error(error);
          alert("Hubo un problema al eliminar el evento");
        } finally {
          // Cerrar la modal de confirmación
          var confirmModal = bootstrap.Modal.getInstance(
            document.getElementById("confirmModal")
          );
          confirmModal.hide();
        }
      });
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar la modal de confirmación");
  }
}
