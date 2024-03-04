<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Cache-Control" content="no-store">
		
		<meta name="description" content="CRUD básico: acceso a Base de Datos-PHP/SQL">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Consulta</title>

		<!-- estilo de "menú" -->
		<link href="ficheros/estilo_menu.css" rel="stylesheet">
		
		<!-- biblioteca de "iconos" -->
		<link href="ficheros/all.css" rel="stylesheet">

		<!-- estilo de "formularios" -->
		<link href="ficheros/formularios.css" rel="stylesheet">

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
//**********************************************************************************
//******************************* CONSULTA DE USUARIO ******************************
//**********************************************************************************
//**********************************************************************************
function hago_cosas(elcodc)
{
	// borro iframe mensaje
	borro_iFrame();
	// visualizo la estrellita
	document.getElementById('estrella').style.visibility='visible';
	// inhabilito botón de consulta
	document.getElementById('boton2').disabled=true;
	//  inhabilito botón de limpiar
	document.getElementById('boton1').disabled=true;
	
	// llamamos al script PHP
	// aquí configuramos "ACTION" y hacemos "submit"
	document.formulario1.action="PHP_Consulta_Usuario.php";
	document.formulario1.submit(); 	
}
//**********************************************************************************
// a esta función se le llama desde el script PHP->"PHP-Consulta_Usuario.php"
// esta sería la forma "CHAPUZA" de poder hacer cosas una vez el script de "php" termine
// es una forma CHAPUZA de definir un "CALLBACK"
function limpio_pantalla(estado)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botones
	document.getElementById('boton1').disabled=false;
	
	// no hay error
	// dejo todo en situación inicial
	if (estado==0)
		{
			// permito borrar ya que el socio existe
			// habilito botón de borrar
			document.getElementById('boton3').disabled=false;
			// des-habilito caja texto "codc" para que no se pueda escribir
			document.getElementById('codc').disabled= true;
			// deshabilito botón de consulta
			document.getElementById('boton2').disabled=true;
		}
	// hay error	
	else	
	{
			// selecciono el contenido de la caja de texto codc
			pasofoco('codc');
			// habilito botón de consulta
			document.getElementById('boton2').disabled=false;			
	}
}
//**********************************************************************************
function pulso_limpiar()
{
	// habilito la caja de texto "codc" para que se pueda escribir en ella			
	document.getElementById('codc').disabled= false;
	// borro lo que hubiese en el iframe
	borro_iFrame();
	// habilito consulta y des-habilito borrar
	document.getElementById('boton3').disabled=true;
	document.getElementById('boton2').disabled=false;
	// paso el foco a la caja de texto "codc"
	pasofoco('codc');
}
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
//**********************************BAJA DE USUARIO*********************************
//**********************************************************************************
//**********************************************************************************
function baja(elcodc)
{
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';
		// inhabilito botón BORRAR
		document.getElementById('boton3').disabled=true;	
		// inhabilito botón LIMPIAR
		document.getElementById('boton1').disabled=true;	

		// llamamos al script PHP y por GET le pasamos cual es el "codc" a borrar
		document.getElementById('mensaje').src="PHP_Baja_Usuario.php?parametro_codc="+elcodc;
		
}
//**********************************************************************************
// esta función se ejecuta cuando termina la consulta el script "PHP-Baja_Usuario"
// a esta función se le llama desde el servidor
// es una forma un poco CHAPUZA de definir un "callback"

function limpio_pantalla_baja()
{	
	// cosas que hay que hacer DESPUÉS
	
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	// llamo a limpiar iframe 'mensaje' con un retardo de 3 seg
	setTimeout("borro_iFrame()",3000);				

	// habilito la caja de texto "codc" para que se pueda escribir en ella			
	document.getElementById('codc').disabled= false;
	// borro contenido "codc"
	document.getElementById('codc').value="";
	// paso foco a "codc"
	pasofoco('codc');
	
	// habilito botones consulta y limpiar
	document.getElementById('boton2').disabled=false;
	document.getElementById('boton1').disabled=false;		
	
	// deshabilito botón de borrar
	document.getElementById('boton3').disabled=true;		
}
//**********************************************************************************
function inicio()
{
}
//*****************************************************************
//*****************************************************************

</script>

<body id="body">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>

<div class="BarraNavegar">
		<!-- Imagen de la barra -->
		<div id="cabecera">
				<i class="fas fa-users fa-2x"></i>
				<label  class="L1">Base Datos 1ºDAW&nbsp </label>		
				<label  class="L2"><b>Consulta SÍNCRONA (chapuza!!)</b></label>		
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
				<div class="contenedor-formulario">
					<!-- observa las propiedades ACTION y TARGET del formulario -->
					<!-- no hemos indicado ACTION -> lo haremos con javascript -->
					<!-- como no hay nada en ACTION, cuando pulsemos botón SUBMIT->no pasará nada -->
					<!-- pero si el formulario se validad bien,  ocurrirá el evento "onsubmit" -->
					<form id="formulario1" name="formulario1" ENCTYPE="multipart/form-data" 
					ACTION="" METHOD="POST" TARGET="mensaje" autocomplete="off"
					onsubmit="hago_cosas(document.getElementById('codc').value);"> 
							
							<!-- en el TARGET indico el contenedor donde se van a colocar los datos que devuelva el servidor -->
							<!-- si no indico TARGET se abrirá una página nueva en el navegador -->
							<!-- en el ACTION indico el script PHP que se tiene que ejecutar en el servidor cuando pulse el botón submit -->
							<!-- en este caso NO lo hacemos -> lo haremos en javascript -->
							
							<legend class="leyenda">Consulta-Baja de Usuario: </legend><br>
							
							<div class="form-group">
								<label>Código:</label>
								<input class="input-control" type="number" id="codc" name="codc" min="1" max="9999" style="width: 30%" 
								required autocomplete="off" autofocus>
							</div>

							<!-- este es el iframe donde saldrán los datos consultados -->
							<div class="form-group">
								<iframe id="mensaje" name="mensaje" align="left" scrolling="no">
								</iframe>	
							</div>

							<div class="form-group" align="left">
									<button class="boton" id="boton1" type="reset" form="formulario1"
									onclick="pulso_limpiar();">
									<i class="fa fa-trash"></i> Limpiar
									</button>
					
									<!-- botón tipo submit -->
									<button class="boton" id="boton2" form="formulario1" type="submit"
									onclick="">
									<i class="fas fa-question"></i> Consulta
									</button>
									
									<!-- este botón no es de tipo submit -->
									<!-- imposible hacer submit -->
									<button class="boton" id="boton3" type="button"  disabled
									onclick="baja(document.getElementById('codc').value);">
									<i class="fas fa-trash-alt"></i> Borrar
									</button>
							</div>
					</form>
				</div>				
		</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fab fa-php fa-3x" ></i>
		<label>&nbsp de PHP al Cielo ©2024</label>	
</footer>

</body>
</html>
