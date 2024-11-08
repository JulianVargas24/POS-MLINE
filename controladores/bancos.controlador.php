<?php

class ControladorBancos {


    /*=============================================
    CREAR BANCO
    =============================================*/
    static public function ctrCrearBanco() {
        if(isset($_POST["nuevoBanco"]) && isset($_POST["nuevoCodigoSBIF"])) {
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoBanco"]) &&
               preg_match('/^[0-9]+$/', $_POST["nuevoCodigoSBIF"])) {
                
                $tabla = "bancos";
                $datos = array(
                    "nombre_banco" => $_POST["nuevoBanco"],
                    "codigo" => $_POST["nuevoCodigoSBIF"]
                );

                $respuesta = ModeloBancos::mdlIngresarBanco($tabla, $datos);

                if($respuesta == "ok") {
                    echo '<script>
                    swal({
                        type: "success",
                        title: "El Banco ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "bancos";
                        }
                    })
                    </script>';
                }

            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "¡El Banco no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.value) {
                        window.location = "bancos";
                    }
                })
                </script>';
            }
        }
    }

    /*=============================================
    MOSTRAR BANCOS
    =============================================*/
    static public function ctrMostrarBancos($item, $valor) {
        
        $tabla = "bancos";
        
        $respuesta = ModeloBancos::mdlMostrarBancos($tabla, $item, $valor);
        
        return $respuesta;
    
    }

    /*=============================================
    EDITAR BANCO
    =============================================*/
    static public function ctrEditarBanco() {
        if(isset($_POST["editarBanco"])) {

            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarBanco"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarCodigoSBIF"])) {
                
                $tabla = "bancos";
                $datos = array(
                    "id" => $_POST["idBanco"],
                    "nombre_banco" => $_POST["editarBanco"],
                    "codigo" => $_POST["editarCodigoSBIF"]
                );

                $respuesta = ModeloBancos::mdlEditarBanco($tabla, $datos);

                if($respuesta == "ok") {
                    echo '<script>
                    swal({
                        type: "success",
                        title: "El Banco ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "bancos";
                        }
                    })
                    </script>';
                }

            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "¡El Banco no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.value) {
                        window.location = "bancos";
                    }
                })
                </script>';
            }
        }
    }
    
    

    /*=============================================
    ELIMINAR BANCO
    =============================================*/
    static public function ctrEliminarBanco() {

    if (isset($_GET["idBanco"])) {

        $tabla = "bancos";
        $datos = $_GET["idBanco"];

        $respuesta = ModeloBancos::mdlBorrarBanco($tabla, $datos);

            if ($respuesta == "ok") {

            echo '<script>
                swal({
                    type: "success",
                    title: "El Banco ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.value) {
                        window.location = "bancos"; // Recarga la página para actualizar la lista
                    }
                });
            </script>';

            }

        }

    }

      
}