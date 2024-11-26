<?php

class ControladorSubunidades
{

    /*=============================================
    CREAR SUBUNIDADES
    =============================================*/

    static public function ctrCrearSubunidad()
    {

        if (isset($_POST["nuevaSubunidad"])) {

            $tabla = "subunidades";

            $datos = array("id_unidad" => $_POST["nuevaUnidad"],
                "subunidad" => $_POST["nuevaSubunidad"]);

            $respuesta = ModeloSubunidades::mdlCrearSubunidad($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "La subunidad ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subunidades";

									}
								})

					</script>';

            }

        }

    }

    /*=============================================
    MOSTRAR SUBUNIDADES
    =============================================*/

    static public function ctrMostrarSubunidades($item, $valor)
    {

        $tabla = "subunidades";

        $respuesta = ModeloSubunidades::mdlMostrarSubunidades($tabla, $item, $valor);

        return $respuesta;

    }

    static public function ctrMostrarSubunidadesPorID($item, $valor)
    {

        $tabla = "subunidades";

        $respuesta = ModeloSubunidades::mdlMostrarSubunidades($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    EDITAR SUBUNIDAD
    =============================================*/

    static public function ctrEditarSubunidad()
    {

        if (isset($_POST["editarSubunidades"])) {


            $tabla = "subunidades";

            $datos = array("subunidad" => $_POST["editarSubunidades"],
                "id" => $_POST["id_subunidad"]);

            $respuesta = ModeloSubunidades::mdlEditarSubunidad($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "La subunidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subunidades";

									}
								})
					</script>';
            }
        }
    }

    /*=============================================
    BORRAR SUBUNIDAD
    =============================================*/

    static public function ctrBorrarSubunidad()
    {

        if (isset($_GET["id_subunidad"])) {

            $tabla = "subunidades";
            $datos = $_GET["id_subunidad"];

            $respuesta = ModeloSubunidades::mdlBorrarSubunidad($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "La subunidad ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subunidades";

									}
								})

					</script>';
            }
        }

    }
}
