<?php 
// retardo en la ejecución
sleep(2);

//conexión con la base de datos
require('ficheros/conexion.php');

// configuramos la librería para que se puedan tratar errores
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_OFF);

// esto no hace falta->la información que envía el usuario la podemos tratar directamente
// la vamos a almacenar primero en unas variables->para que la consulta SQL quede más clara									

// estamos trabajando con formularios
// la información que envía el usuario se almacena en una tabla temporal
// llamada $_POST

// en los corchetes de $_POST -> se ponen los "name" de los objetos HTML
$v1=$_POST['codc'];
$v2=strtoupper($_POST['nombre']);
$v3=$_POST['fecha'];
$v4=$_POST['edad'];


// para poder probar el script PHP directamente sin la página web
/*
$v1=2112; 
$v2="PEPE";
$v3="2023-12-01";
$v4=12;
*/

// nos declaramos una variable "$consulta"
// y ahí escribimos la consulta
$consulta="INSERT INTO $tabla (CODC,NOMBRE,FECHA,EDAD) VALUES ($v1,'$v2','$v3',$v4)";

//ejecuto la consulta SQL (le pasamos 2 parámetros)
// 1º la consulta SQL a ejecutar
// 2º la conexión
@mysqli_query($conexion,$consulta);

// comprobamos el resultado de la inserción después de ejecutar la consulta en la base de datos
// el error CERO significa NO ERROR 
// el error 1062 significa Clave duplicada 
// en los errores forzamos a que nos ponga el número de error 
// y el significado de ese error (aunque sea en inglés).... 

if (mysqli_errno($conexion)==0)
{
	echo "<center><b><font face='Calibri' color='green' size='3'>Socio dado de alta correctamente!!</font><b></center>";
	// la llamada al "callback()" que está en el "parent"->"parent" es la página que ha llamado a este script
	echo "<script>parent.limpio_pantalla(0);</script>";
}
else 
{
	$numerror=mysqli_errno($conexion); 
	$descrerror=mysqli_error($conexion); 
	// todo esto no cabe en el iframe
	//echo "<b><font face='Calibri' color='red' size='3'>Error nº $numerror corresponde a: $descrerror</font><b>";
	echo "<center><b><font face='Calibri' color='red' size='3'>Error nº $numerror (cliente ya existe)</font><b></center>";
	// la llamada al "callback()" que está en el "parent"->"parent" es la página que ha llamado a este script
	echo "<script>parent.limpio_pantalla(1);</script>";
}	

// cerramos la conexion - OBLIGATORIO
mysqli_close($conexion); 
?>
