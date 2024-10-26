<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Fechas</title>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- jQuery 3 -->
    <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <style>
        .modal-content {
            background-color: white !important; /* Fondo blanco */
            color: black !important; /* Color del texto */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="col-xs-6">
        <div class="d-block" style="font-size:14px;">Fecha Emisión</div>
        <div class="form-group">
            <div class="input-group">
                <input type="date" class="form-control input-sm" name="nuevaFechaEmision" id="nuevaFechaEmision" 
                value="<?php echo date('Y-m-d'); ?>" required 
                onchange="validarFechas(this.id, 'nuevaFechaVencimiento')">
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="d-block" style="font-size:14px;">Fecha Venc.</div>
        <div class="form-group">
            <div class="input-group">
                <input type="date" class="form-control input-sm" name="nuevaFechaVencimiento" id="nuevaFechaVencimiento" 
                required 
                onchange="validarFechas('nuevaFechaEmision', this.id)">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="alertModalLabel">Error</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                La fecha de vencimiento no puede ser anterior a la fecha de emisión.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function validarFechas(fechaInicioId, fechaFinId) {
    const fechaInicio = document.getElementById(fechaInicioId).value;
    const fechaFin = document.getElementById(fechaFinId).value;

    if (fechaInicio && fechaFin) {
        if (new Date(fechaInicio) > new Date(fechaFin)) {
            $('#alertModal').modal('show'); // Mostrar la ventana modal
            document.getElementById(fechaFinId).value = ''; // Limpiar el campo de fecha de vencimiento
        }
    }
}
</script>

</body>
</html>


