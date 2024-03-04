<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Cache-Control" content="no-store">
		
		<meta name="description" content="CRUD básico: acceso a Base de Datos-PHP/SQL">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Listados</title>

		<!-- estilo de "menú" -->
		<link href="ficheros/estilo_menu.css" rel="stylesheet">
		
		<!-- biblioteca de "iconos" -->
		<link href="ficheros/all.css" rel="stylesheet">

		<!-- estilo de "formularios" -->
		<link href="ficheros/formularios.css" rel="stylesheet">
		
		<!-- estilo de "tablas" -->
		<link href="ficheros/tablas.css" rel="stylesheet">

</head>


<!-- este código se ejecuta antes de cargar la página -->
<script type="text/javascript">
//**********************************************************************************
// para pasar el foco de ejecución a un objeto y seleccionar su contenido si lo tuviese
function pasofoco(objeto)
{
	document.getElementById(objeto).focus();
	document.getElementById(objeto).select();
}
//**********************************************************************************
function borro_iFrame()
{
	// de esta forma se borra el contenido de un iFrame
	mensaje.document.open();
	mensaje.document.close();
}
//**********************************************************************************
function listado_usuarios(elcriterio)
{
	//alert(elcriterio);
	// borro iframe 
	borro_iFrame();
	// visualizo la estrellita
	document.getElementById('estrella').style.visibility='visible';
	// inhabilito botón de realizar consulta
	document.getElementById('boton1').disabled=true;
	// llamamos al script que nos lista los registros
	// le pasamos por "GET" el valor del SELECT 
	document.getElementById('pongotabla').src='PHP-Listado_Usuarios.php?elorden='+elcriterio;
}
//**********************************************************************************
//**********************************************************************************
function borro_iFrame()
{
	var iframe_element = window.frames['pongotabla'];
	iframe_element.document.open();
	iframe_element.document.close();
}
//**********************************************************************************
function oculto_estrella()
{
	// ocultamos de nuevo la estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botón de realizar consulta
	document.getElementById('boton1').disabled=false;	
}
//**********************************************************************************
//*****************************************************************
function inicio()
{
}
//*****************************************************************
//*****************************************************************

</script>

<!-- una vez que la página esté cargada pasamos el foco al "select" -->
<body onload="document.getElementById('criterio1').focus();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>

<div class="BarraNavegar">
		<!-- Imagen de la barra -->
		<div id="cabecera">
				<i class="fas fa-users fa-2x"></i>
				<label  class="L1">Base Datos 1ºDAW&nbsp </label>		
				<label  class="L2"><b>Listados SÍNCRONA (chapuza!!)</b></label>		
		</div>

		<!-- alineados a la derecha -->
		<nav class="Grupo_opciones Grupo_opciones_derecha">
					<label class="label2"
					onclick="window.open('../index.html','_parent')">volver</label>
		</nav>
  
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div id="contenedor" class="contenedor">
		<div id="cajapagina" class="contenedor2">
				<div class="contenedor4">
						<button class="boton" id="boton1" type="button"  
						onclick="listado_usuarios(document.getElementById('criterio1').value);">
						<i class="fas fa-question"></i> Iniciar Listado
						</button>

						<label id="c1">Ordenar:</label>
						<select id="criterio1" name= "criterio1" 
						onchange="listado_usuarios(document.getElementById('criterio1').value)">
									<option value="CODC">CODC</option>
									<option value="NOMBRE" selected="selected">NOMBRE</option>
									<option value="FECHA">FECHA</option>
									<option value="EDAD">EDAD</option>
						</select> 		

						<!-- donde se visualiza la tabla -->
						<iframe  id="pongotabla" name="pongotabla" align="center" allow="fullscreen">
						</iframe>	
				</div>
		</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"/>
		&nbsp&nbsp<i class="fab fa-php fa-3x" ></i>
		<label>&nbsp de PHP al Cielo ©2024</label>	
</footer>

</body>
</html>

<!-- este código se ejecuta cuando termina de cargarse la página web -->
<script>
var alto_iframe=0;
function ancho_y_alto_pantalla()
 {
	 // portátil 14"
	 // ancho-> 1518
	 // alto-> 712
	var ancho_pantalla;
	var alto_pantalla;
		alto_pantalla = document.getElementsByTagName('body')[0].clientHeight;
		ancho_pantalla = document.getElementsByTagName('body')[0].clientWidth;
	return alto_pantalla;
 }	
 //alert(ancho_y_alto_pantalla());
 alto_iframe=((ancho_y_alto_pantalla())-300);
 document.getElementById('pongotabla').height=alto_iframe;	
</script>