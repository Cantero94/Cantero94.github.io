<?php
$base="id21275568_basededatos_cantero"; 

// recogemos en una variable el nombre de la TABLA
// en ningún sitio en este script utilizo esta variable ($tabla)
// esta variable la utilizaré en el script donde se tenga que utilizar la tabla 

// es opcional, se puede crear la variable o trabajar directamente con la "tabla1"
$tabla="tabla1"; 

#--------------------------------------------------------------------------
# establecemos la conexion con el servidor 
# gestionamos posible error
#--------------------------------------------------------------------------

//**********************************************************************
$conexion=@new mysqli("localhost","id21275568_cantero","Cantero@1994", $base);
//**********************************************************************

if (!$conexion)
 {
   echo "<font color='blue' size='4' font-weight: extra-bold>
   //ERROR: No se pudo realizar la conexión al servidor !!</font>";
   //exit;
 }

// para evitar problemas con acentos configuramos las querys de esta manera 
//**********************************************************************
$conexion->query("SET NAMES 'utf8'");
//**********************************************************************
//esta línea la quitaremos cuando usemos este script en PHP para conectarnos a una base de datos
echo "<font color='blue' size='4' font-weight: extra-bold>
//MENSAJE: La conexión con los datos se ha establecido correctamente !!</font>";
?>