<?php 
// SALIDA->si el socio se borra->mensaje de éxito en formato "HTML"
// SALIDA->si el socio NO se borra->mensaje de NO éxito en formato "HTML"

require("ficheros/conexion.php");

sleep(1);

// estamos trabajando con formularios
// la información se ha enviado por GET al servidor -> PHP-Baja_Usuario.php?parametro_codc="+elcodc
// la informacion que envia el usuario al servidor se almacena en una tabla temporal $_GET

$v1=$_GET['parametro_codc'];

// consulta SQL
// ojo!! DELETE -> no da error si no borra
$consulta="DELETE FROM tabla1 WHERE CODC=$v1";
	
mysqli_query($conexion,$consulta);
// con "mysql_affected_rows()" calculamos los registros que han sido afectados por la ejecución de la consulta
// como máximo se borrará 1 -> por qué -> porque "CODC" es clave primaria
$registros_borrados=mysqli_affected_rows($conexion);

if ($registros_borrados==1)
{
	// informo de que ese cliente se ha borrado con éxito
	echo "<center><b><font face='Calibri' color='green' size='3'>Usuario: ".$v1." borrado con éxito!!</font><b></center>";
}
else
{	
	// informo de que ese cliente ya NO existe
	echo "<center><b><font face='Calibri' color='blue' size='3'>Usuario: ".$v1." ya no existe!!</font><b></center>";
}
	
// la llamada al "callback()" que está en el "parent"->"parent" es la página que ha llamado a este script
echo "<script>parent.limpio_pantalla_baja();</script>";

// cerramos la conexión con la base de datos
mysqli_close($conexion);
?>