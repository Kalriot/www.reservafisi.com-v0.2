<?php
// Verificar si se recibe el id_reserva
if (isset($_GET['id_reserva'])) {
    $id_reserva = $_GET['id_reserva'];
} else {
    echo "ID de reserva no proporcionado.";
    exit;
}
?>

<!-- Modal -->
<div class="modal fade" id="aceptarReserva" tabindex="-1" role="dialog" aria-labelledby="aceptarReserva" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aceptarReserva">Ventada de confirmación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Usted confirma la aceptación de la reserva?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="aprobarReserva(<?php echo $id_reserva; ?>)">Aceptar</button>
      </div>
    </div>
  </div>
</div>