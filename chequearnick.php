<?php
// Datos configuración de la conexión al MySQL.
$nombrebase="c32mksf";
$usuario="c32a12marcosfb";
$servidor="localhost";
$password="abc123.";

//////////////////////////////////////
// Hacemos la conexión al servidor de MySQL utilizando mysqli.

$mysqli=@new mysqli($servidor,$usuario,$password,$nombrebase);

if ($mysqli->connect_error)
{
	die ("Error en conexión base datos: ".$mysqli->connect_error);
}

// Preparamos la consulta.
$sentencia = $mysqli->prepare("SELECT * from amadeus_usuarios where nick=?") or die($mysqli->error);

// Enlazamos los parámetros (s string)
// http://es2.php.net/manual/es/mysqli-stmt.bind-param.php

$sentencia->bind_param("s",$_POST['nick']);


// Ejecutamos la consulta preparada.
$sentencia->execute();

// Si es una consulta de select almacenamos el resultado.
$sentencia->store_result();

// Número de filas obtenidas.
$numfilas=$sentencia->num_rows;
if ($numfilas==1)
     echo "Nick en uso";
else
     echo "Nick disponible";

// Liberamos el espacio que ocupa ese resultado en memoria.
$sentencia -> free_result();

// Cerramos la conexión con el servidor mysql.
$mysqli->close();
?>