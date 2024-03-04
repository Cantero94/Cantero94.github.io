<?php 
// SALIDA->ERROR->si el socio no existe
// SALIDA->si el socio existe->los datos del socio en formato "HTML"

//*************************************************************
// en este script PHP es el servidor quien formatea los datos en "HTML"
// criterio de diseño -> "slim client-fat server"
// la tendencia actual no es esta
// la tendencia actual es "fat client-slim server"
// la tendencia actual es que sea el cliente quien realice el trabajo
// y el servidor que solamente sirva datos al cliente en formatos xml, json...
//*************************************************************

// estilo del HTML de PHP
echo "<link href='ficheros/estilo_php.css' rel='stylesheet'>";

// retardo
sleep(1);

//conexión con la base de datos
require('ficheros/conexion.php');

// recogemos los datos de SOCIO a consultar del array $_POST									
$v1=$_POST['codc'];

// compruebo si el socio existe en la tabla"tabla1"
$consulta="SELECT * FROM tabla1 WHERE CODC=$v1;";
$resultado=mysqli_query($conexion,$consulta); 

// si se comprueban errores internos del SGBD hay que hacerlo aquí
// en este caso->no lo comprobamos
// ** ** //

// obtengo el numero de registros devueltos por la consulta -> mysqli_num_rows()
// cuantos registros me devolverá esta consulta como máximo??->1
$nregistros=mysqli_num_rows($resultado);

if($nregistros==1)
{
			// existe el socio
			// recupero el registro de datos devuelto por la consulta
			
			// en "$resultado" tengo los datos devueltos por la consulta->pero son inaccesibles
			// para que sean accesibles->hay que formatearlos con "fetch"
			// ahora en "$registro" tendré los datos "accesibles" en formato tabla-array
			$registro = mysqli_fetch_array($resultado);
			
			echo
			"<label class='lalabel'>NOMBRE:</label>".
			"<input class='elinput' disabled value=".$registro['NOMBRE']."><br>";
			

			$fechaaux=date("d-m-Y", strtotime($registro['FECHA']));
			echo
			"<label class='lalabel'>FECHA:</label>".
			"<input class='elinput' disabled value=".$fechaaux."><br>";
						
			echo
			"<label class='lalabel'>EDAD:</label>".
			"<input class='elinput' disabled value=".$registro['EDAD']."><br>";
		
			echo "<script>parent.limpio_pantalla(0);</script>";
}
else
{
			// no existe el socio
			// devuelvo mensaje ERROR
			echo "<center><b><font face='Calibri' color='red' size='3'>Error: CODC de socio no existe!!</font><b></center>";
			echo "<script>parent.limpio_pantalla(1);</script>";
}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
 ?>