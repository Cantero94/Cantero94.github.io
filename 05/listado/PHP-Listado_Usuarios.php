<?php
//*************************************************************
// en este script PHP es el servidor quien formatea los datos en una tabla
// criterio de diseño -> "slim client-fat server"
// la tendencia actual no es esta
// la tendencia actual es "fat client-slim server"
// la tendencia actual es que sea el cliente quien realice el trabajo
// y el servidor que solamente sirva datos al cliente en formatos xml, json...
//*************************************************************

// simulamos un retraso en la ejecución de este script
sleep(1);

// incluimos el fichero de conexión
require('ficheros/conexion.php');

// recogemos el criterio de ordenación por "GET"
$ordenacion=trim($_GET['elorden']);

// ***** estilo de la tabla que vamos a crear *****//
// si no pongo esto aquí la tabla no hereda los estilos -> ¿por qué?
// porque es el servidor (y no el cliente) quien hace la tabla HTML
// comentar la línea de código -> y ver resultado
echo "<link href='ficheros/tablas.css' rel='stylesheet'>";
// ***************************************//

// nos declaramos una variable
// y ahí escribimos la consulta

$consulta = "SELECT * FROM tabla1 ORDER BY ".$ordenacion;
//$consulta = "SELECT * FROM tabla1";

//ejecuto la consulta SQL (la pasamos 2 parámetros)
// 1º la consulta SQL a ejecutar
// 2º la conexión
// en "$resultado" tendrá almacenados todos los registros que me devuelva la consulta
// puede ser que un SELECT no devuelva nada y entonces "$resultado"-> sería null
$resultado = mysqli_query($conexion,$consulta);

//obtengo el nº de registros devueltos en la consulta
//************** importante *****************//
// hago esto -> isset($resultado) -> porque si a "mysqli_num_rows()" no le paso nada me da error
if (isset($resultado))
{
	$nregistros=mysqli_num_rows($resultado);
}
else
{
	$nregistros=0;
}

// informo del nº de registros que tiene la tabla

echo "<div id='adorno'><br><b>Registros en tabla Clientes: </b><label id='nelementos'>".$nregistros."</label><br></div>";
// aunque no existan registros en la base de datos
// creamos la tabla
// y la cabecera de la tabla

// *********************** creo TABLA ********************//
echo "<table>";
// ****************** creo CABECERA TABLA ****************//
echo "<thead>";
		echo "<tr>";
		echo "<th>Código</th>";
		echo "<th>Nombre</th>";
		echo "<th>Fecha</th>";
		echo "<th>Edad</th>";
		echo "<th>Ajuste</th>";
		echo "<th>Borro</th>";
		echo "</tr>";
echo "</thead>";
//******************* listamos registros con tabla **********//
if ($nregistros>0)
{
	while($registro = mysqli_fetch_array($resultado))
	{
		echo "
		<tr>  
			<td>".$registro["CODC"]."</td>  
			<td>".$registro["NOMBRE"]."</td>  
			<td>".date('d-m-Y', strtotime($registro['FECHA']))."</td>
			<td>".$registro["EDAD"]."</td>   
			<td><input type='checkbox' id='marca' name='marca[]'>"."</td>
			<td><img id='papelera' onclick='' src='imagenes/papelera.png'>"."</td>
		</tr>";  			
	}
	// ****************** creo FOOTER TABLA ****************//
	echo "<tfoot>";
		echo "<tr>";
			echo "<th>Código</th>";
			echo "<th>Nombre</th>";
			echo "<th>Fecha</th>";
			echo "<th>Edad</th>";
			echo "<th>Ajuste</th>";
			echo "<th>Borro</th>";
		echo "</tr>";
	echo "</tfoot>";
	// ***************************************************//
	// cerramos la tabla
	echo "</table>";
}

// callback()
// para ocultar estrella
// y para habilitar el botón de la consulta
echo "<script>parent.oculto_estrella();</script>"; 

// cerramos la conexion - OBLIGATORIO
 mysqli_close($conexion); 
?> 
