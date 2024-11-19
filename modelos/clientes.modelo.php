<?php

require_once "conexion.php";

class ModeloClientes
{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos)
	{
		try {
			// Prepara la consulta
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            nombre, rut, email, telefono, direccion, comuna, region, pais, actividad, ejecutivo, 
            id_plazo, id_vendedor, factor_lista, id_producto, id_campana, contacto_cobranza, 
            email_cobranza, telefono_cobranza, linea_credito, observacion, estado, bloqueo_credito
        ) VALUES (
            :nombre, :rut, :email, :telefono, :direccion, :comuna, :region, :pais, :actividad, 
            :ejecutivo, :id_plazo, :id_vendedor, :factor_lista, :id_producto, :id_campana, 
            :contacto_cobranza, :email_cobranza, :telefono_cobranza, :linea_credito, :observacion, 
            :estado, :bloqueo_credito
        )");

			// Verifica los datos antes de ejecutar la consulta
			foreach ($datos as $key => $value) {
				echo "Binding $key => $value<br>";
			}

			// Asocia los valores
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
			$stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
			$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
			$stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
			$stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_plazo", $datos["id_plazo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
			$stmt->bindParam(":factor_lista", $datos["factor_lista"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
			$stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);
			$stmt->bindParam(":contacto_cobranza", $datos["contacto_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":email_cobranza", $datos["email_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono_cobranza", $datos["telefono_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":linea_credito", $datos["linea_credito"], PDO::PARAM_INT);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			$stmt->bindParam(":bloqueo_credito", $datos["bloqueo_credito"], PDO::PARAM_STR);

			// Ejecuta la consulta
			if ($stmt->execute()) {
				return "ok";
			} else {
				$errorInfo = $stmt->errorInfo();
				return "error: " . implode(" - ", $errorInfo);
			}
		} catch (PDOException $e) {
			return "error: " . $e->getMessage();
		} finally {
			// Cierra la conexión y libera recursos
			$stmt = null;
		}
	}


	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos)
	{
		try {
			// Prepara la consulta de actualización
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
            nombre = :nombre,
            rut = :rut,
            email = :email,
            telefono = :telefono,
            direccion = :direccion,
            comuna = :comuna,
            region = :region,
            pais = :pais,
            actividad = :actividad,
            ejecutivo = :ejecutivo,
            id_plazo = :id_plazo,
            id_vendedor = :id_vendedor,
            factor_lista = :factor_lista,
            id_producto = :id_producto,
            id_campana = :id_campana,
            contacto_cobranza = :contacto_cobranza,
            email_cobranza = :email_cobranza,
            telefono_cobranza = :telefono_cobranza,
            linea_credito = :linea_credito,
            observacion = :observacion,
            estado = :estado,
            bloqueo_credito = :bloqueo_credito
        WHERE id = :id");

			// Asocia los valores
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
			$stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
			$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
			$stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
			$stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_plazo", $datos["id_plazo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
			$stmt->bindParam(":factor_lista", $datos["factor_lista"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
			$stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);
			$stmt->bindParam(":contacto_cobranza", $datos["contacto_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":email_cobranza", $datos["email_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono_cobranza", $datos["telefono_cobranza"], PDO::PARAM_STR);
			$stmt->bindParam(":linea_credito", $datos["linea_credito"], PDO::PARAM_INT);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR); // Campo estado
			$stmt->bindParam(":bloqueo_credito", $datos["bloqueo_credito"], PDO::PARAM_STR); // Campo bloqueo_credito

			// Ejecuta la consulta
			if ($stmt->execute()) {
				return "ok"; // Si la actualización es exitosa, devuelve "ok"
			} else {
				$errorInfo = $stmt->errorInfo(); // Si ocurre un error, muestra el mensaje de error
				return "error: " . implode(" - ", $errorInfo);
			}
		} catch (PDOException $e) {
			return "error: " . $e->getMessage(); // Manejo de excepciones
		} finally {
			// Cierra la conexión y libera los recursos
			$stmt = null;
		}
	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
			return "error";

			return "error";
			return "error";

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
			return "error";

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
