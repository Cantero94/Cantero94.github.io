<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Cache-Control" content="no-store">
		
		<meta name="description" content="CRUD básico: acceso a Base de Datos-PHP/SQL">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Alta</title>

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
function hago_cosas()
{
	// borro iframe mensaje
	borro_iFrame();
	// visualizo la estrellita
	document.getElementById('estrella').style.visibility='visible';
	// inhabilito botón de realizar alta
	document.getElementById('boton1').disabled=true;
	//  inhabilito botón de limpiar
	document.getElementById('boton2').disabled=true;
}
//**********************************************************************************
// a esta función se le llama desde el script PHP->"PHP-Alta_Usuario.php"
// esta sería la forma "CHAPUZA" de poder hacer cosas -> una vez que el script de "php" termine
// es una forma CHAPUZA de definir un "CALLBACK"
function limpio_pantalla(estado)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botones
	document.getElementById('boton1').disabled=false;
	document.getElementById('boton2').disabled=false;
	
	// no hay error
	// dejo todo en situación inicial
	if (estado==0)
		{
			// limpio cajas
			document.formulario1.reset();
			// llamo a limpiar iframe con un retardo de 3 seg
			setTimeout("borro_iFrame()",3000);
			// paso foco a codc
			document.formulario1.codc.select();
		}
	// hay error	
	else	
	{
			// selecciono el contenido de la caja de texto codc
			document.formulario1.codc.select();
			// así también
			// pasofoco('codc');
	}
}
//*****************************************************************
//*****************************************************************
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
				<label  class="L2"><b>Alta SÍNCRONA (chapuza!!)</b></label>		
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
								<!-- observa las propiedades ACTION y TARGET del formulario (contienen información)-->
								<!-- observa el evento que se produce cuando se realiza un "submit" -->
								<form id="formulario1" name="formulario1" ENCTYPE="multipart/form-data" 
								ACTION="PHP_Alta_Usuario.php" METHOD="POST" TARGET="mensaje" autocomplete="off"
								onsubmit="hago_cosas();"> 
								
								<legend class="leyenda">Alta de Usuario: </legend><br>
								
								<div class="form-group">
									<label>Código:</label>
									<input class="input-control" id="codc" name="codc" type="number" id="codc" name="codc"  min="1" max="9999" step="1" style="width: 25%" 
									required autofocus autocomplete="off">
								</div>

								<div class="form-group">
									<label>Nombre:</label>
									<input class="input-control" id="nombre" name="nombre" maxlength="10" style="width:60%" 
									required autocomplete="off">
								</div>

								<div class="form-group">
									<label>Fecha Alta:</label>
									<input class="input-control" type="date" id="fecha" name="fecha" required
									value="<?php echo date('Y-m-d');?>" style="width:45%;">
								</div>

								<div class="form-group">
									<label>Edad:</label>
									<input class="input-control" type="number" id="edad" name="edad" min="1" max="120" step="1" style="width:20%" 
									required autocomplete="off">
								</div>
								
								<div class="form-group">
								<label id="c1">Provincia:</label>
								<select id="provincia" name= "provincia" disabled>
											<option value="ALBACETE">ALBACETE</option>
											<option value="CIUDAD REAL">CIUDAD REAL</option>
											<option value="CUENCA" selected="selected">CUENCA</option>
											<option value="GUADALAJARA">GUADALAJARA</option>
											<option value="TOLEDO">TOLEDO</option>
								</select> 
								</div>

								<img id="img1" src="imagenes/usuario.png"  >

								<div class="form-group">
									<label>Imagen:</label>
									<!-- primer parámetro: id del input file -->
									<!-- segundo parámetro: id del objeto img -->
									<input type="file" class="input-control" id="imagen" name="imagen" required accept=".jpg" disabled
									onchange="visualizo('imagen','img1')">
								</div>
								
								<div class="form-group" align="left">
										<button class="boton" id="boton1" form="formulario1" type="reset"
										onclick="pasofoco('codc');borro_iFrame();document.getElementById('img1').src='imagenes/usuario.png';">
										<i class="fa fa-trash"></i> Limpiar
										</button>
										
										<!-- el "button" lo pongo de tipo "submit"  para que se pueda realizar un "submit"-->

										<button class="boton" id="boton2" form="formulario1" type="submit"
										onclick="">
										<i class="fas fa-pencil-alt"></i> Alta
										</button>
										
										<!-- en este iframe se visualiza la información que envía el servidor -->
										<iframe id="mensaje" name="mensaje" scrolling="no" >
										</iframe>
								</div>
						</form>
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
