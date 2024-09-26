<?php

class ControladorPersonal{

	/*=============================================
	CREAR PERSONAL
	=============================================*/

	static public function ctrCrearPersonal(){

		if(isset($_POST["nuevoPersonal"])){


			   	$tabla = "personal";

			   	$datos = array("nombre"=>$_POST["nuevoPersonal"],
					           "rut"=>$_POST["nuevoRutId"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
							   "empresa"=>$_POST["nuevaEmpresa"],
							   "busto"=>$_POST["nuevaBusto"],
							   "cintura"=>$_POST["nuevaCintura"],
							   "cadera"=>$_POST["nuevaCadera"],
							"ancho_espalda"=>$_POST["nuevaAnchoEspalda"],
							"talle_delantero"=>$_POST["nuevaTalleDelantero"],
							"talle_espalda"=>$_POST["nuevaTalleEspalda"],
							"largo_manga"=>$_POST["nuevaLargoManga"],
							"largo_blusa"=>$_POST["nuevaLargoBlusa"],
							"largo_guillete"=>$_POST["nuevaLargoGuillete"],
							"largo_chaqueta"=>$_POST["nuevaLargoChaqueta"],
							"largo_polera"=>$_POST["nuevaLargoPolera"],
							"largo_parka"=>$_POST["nuevaLargoParka"],
							"largo_polar"=>$_POST["nuevaLargoPolar"],
							"largo_vestido"=>$_POST["nuevaLargoVestido"],
							"pantalon_cintura"=>$_POST["nuevaCinturaPantalon"],
							"pantalon_cadera"=>$_POST["nuevaCaderaPantalon"],
							"pantalon_tiro"=>$_POST["nuevaTiroPantalon"],
							"pantalon_entrepierna"=>$_POST["nuevaEntrepiernaPantalon"],
							"pantalon_muslo"=>$_POST["nuevaMusloPantalon"],
							"pantalon_rodilla"=>$_POST["nuevaRodillaPantalon"],
							"pantalon_basta"=>$_POST["nuevaBastaPantalon"],
							"largo_pantalon"=>$_POST["nuevaLargoPantalon"],
							"falda_cintura"=>$_POST["nuevaCinturaFalda"],
							"falda_cadera"=>$_POST["nuevaCaderaFalda"],
							"largo_falda"=>$_POST["nuevaLargoFalda"]);

			   	$respuesta = ModeloPersonal::mdlIngresarPersonal($tabla, $datos);

				   if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El personal ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "personal";

									}
								})

					</script>';

				}

			

		}

	}

	/*=============================================
	MOSTRAR PERSONAL
	=============================================*/

	static public function ctrMostrarPersonal($item, $valor){

		$tabla = "personal";

		$respuesta = ModeloPersonal::mdlMostrarPersonal($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR PERSONAL
	=============================================*/

	static public function ctrEditarPersonal(){

		if(isset($_POST["editarPersonal"])){

			

			   	$tabla = "personal";

			   	$datos = array("id"=>$_POST["idPersonal"],
			   				   "nombre"=>$_POST["editarPersonal"],
					           "rut"=>$_POST["editarRutId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
							   "empresa"=>$_POST["editarEmpresa"],
							   "busto"=>$_POST["editarBusto"],
							   "cintura"=>$_POST["editarCintura"],
							   "cadera"=>$_POST["editarCadera"],
							"ancho_espalda"=>$_POST["editarAnchoEspalda"],
							"talle_delantero"=>$_POST["editarTalleDelantero"],
							"talle_espalda"=>$_POST["editarTalleEspalda"],
							"largo_manga"=>$_POST["editarLargoManga"],
							"largo_blusa"=>$_POST["editarLargoBlusa"],
							"largo_guillete"=>$_POST["editarLargoGuillete"],
							"largo_chaqueta"=>$_POST["editarLargoChaqueta"],
							"largo_polera"=>$_POST["editarLargoPolera"],
							"largo_parka"=>$_POST["editarLargoParka"],
							"largo_polar"=>$_POST["editarLargoPolar"],
							"largo_vestido"=>$_POST["editarLargoVestido"],
							"pantalon_cintura"=>$_POST["editarCinturaPantalon"],
							"pantalon_cadera"=>$_POST["editarCaderaPantalon"],
							"pantalon_tiro"=>$_POST["editarTiroPantalon"],
							"pantalon_entrepierna"=>$_POST["editarEntrepiernaPantalon"],
							"pantalon_muslo"=>$_POST["editarMusloPantalon"],
							"pantalon_rodilla"=>$_POST["editarRodillaPantalon"],
							"pantalon_basta"=>$_POST["editarBastaPantalon"],
							"largo_pantalon"=>$_POST["editarLargoPantalon"],
							"falda_cintura"=>$_POST["editarCinturaFalda"],
							"falda_cadera"=>$_POST["editarCaderaFalda"],
							"largo_falda"=>$_POST["editarLargoFalda"]);

			   	$respuesta = ModeloPersonal::mdlEditarPersonal($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Personal ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "personal";

									}
								})

					</script>';

				}

			

		}

	}

	/*=============================================
	ELIMINAR PERSONAL
	=============================================*/

	static public function ctrEliminarPersonal(){

		if(isset($_GET["idPersonal"])){

			$tabla ="personal";
			$datos = $_GET["idPersonal"];

			$respuesta = ModeloPersonal::mdlEliminarPersonal($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Personal ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "personal";

								}
							})

				</script>';

			}		

		}

	}

}

