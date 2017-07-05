<?php
// iniciar las variables de SESSION
session_start();
if(!isset($_SESSION['usuario']))
    header("location:index.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!DOCTYPE HTML>
<html>
	<head>
		<title>SmartStore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="css/page_style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/slider/coin-slider-styles.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/nav_l/styles.css">
        <link rel="stylesheet" href="css/breadcrumb/BreadCrumb.css" type="text/css">
        <link rel="icon" type="img/png" href="img/favicon.png">

		<!--[if lte IE 7]>
		<script type="text/javascript" src="js/jquery/jquery.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
		<![endif]-->
        
		<script type="text/javascript" src="js/jquery/jquery.js"></script>
		<script type="text/javascript" src="js/nav_l/sliding_effect.js"></script>
        <script type="text/javascript" src="js/slider/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/slider/coin-slider.min.js"></script>
        <script src="js/breadcrumb/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
        <script src="js/breadcrumb/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
		<script language="JavaScript">
		function cargar(valor)
		{
	location.href="stock.php?fec="+valor;
		}

		</script>

        
	</head>
<body>
	<!-- p?gina -->
	<div id="container">

		<!-- cabecera -->
		<div id="header">
        	<div class="top_nav">
            	<ul>
					<li>Hola,
<a href="profile.php"> <?php  
		echo $_SESSION['usuario'];?></a> 			</li>
					<li>|</li>
					<li>
						<a href="verCarrito.php" class="cart_counter"><img src="img/total_cart.png" width="18" height="18"> (<?php						
// conexion
include("conexion_bd.php");
$id = $_SESSION['usuario'];
if (isset($_GET['fec'])){
	$cantidad = $_GET['fec'];
$max;
$min;
if ($cantidad == 1){
	$min = 1;
	$max = 9;
} else if ($cantidad == 2){
		$min = 10;
	$max = 49;
} else if ($cantidad == 3){
	$min = 50;
	$max = 99;
} else if ($cantidad == 4){
	$min = 100;
	$max = 199;
} else if ($cantidad == 5){
	$min = 200;
	$max = 99999999999;
} else {
	$min = 0;
	$max = 99999999999;
}}
 else {
	 	$min = 0;
	$max = 99999999999;
 }
$sql="SELECT productos.imagen, productos.precio, categorias.nombre, productos.unidades FROM productos, categorias, paises WHERE productos.idcategoria = categorias.idcategoria AND productos.idpais = paises.idpais AND productos.unidades >= $min AND productos.unidades <= $max";
$registros=mysql_query($sql)or die("Error al leer compras <br> <a href='tienda.php'>Pulse aqui para continuar </a>");
while($linea=mysql_fetch_array($registros))
{
	$imagen = $linea['productos.imagen'];
	echo "<img src=$imagen</img>";
}
// Controlar si encuentra registros
$total = mysql_num_rows($registros);	echo $total;				
?>)</a>
					</li>
					<li>|</li>
					<li><a href="logout.php">Salir</a></li>
				</ul>
            </div><!-- end of .top_nav -->
            <hr>
            <div class="logo">
            	<img src="img/logo.png" height="56" width="300" alt="SmartShop">
            </div><!-- end of .logo -->
            <div class="right_nav">
            	<ul>
					<li><a href="tienda.php">INICIO</a></li>
    				<li><a href="empresa.html">EMPRESA</a></li>
    				<li><a href="servicios.html">SERVICIOS</a></li>
    				<li><a href="productos.html">PRODUCTOS</a></li>
					<li>
					<?php
	if ($_SESSION['usuario']=='admin')
	{
	   echo"<a href='estadistica.php'>ESTADISTICA</a></li>";
	}
	else
	{
	  echo"<a href='contacto.html'>CONTACTO</a></li>";
	}
	?>
	
	   			</ul>
			            </div>
		</div><!-- fin cabecera -->

		<!-- parte izquierda -->
        <div id="left_sidebar">
        	<div id="navigation-block">
            <ul id="sliding-navigation">
<?php
//Preparamos y ejecutamos la consulta
$sql="SELECT * FROM categorias";
$reg=mysql_query($sql)or die("Error al leer categorias <br> <a href='tienda.php'>Pulse aqui para continuar </a>");
// Lectura de los registros y la presentaci�n en la web
while($linea=mysql_fetch_array($reg))
{
   echo "<li class='sliding-element'><a href='tienda.php?cat=$linea[idcategoria]'>$linea[nombre]</a>			</li>";
}
?>
	            </ul>
			</div><!-- end of #navigation-block -->
			<h4>Folleto</h4>
			<div class="poster">
			<img src="img/folleto_p.png" width="155" height="200" alt="Folleto" title="Folleto">
			</div><!-- end of .poster -->
			<h4>Sugerencias</h4>
			<div class="newsletter_form">
			<form method="post" action="altasSugerencias.php">
			<textarea cols="16" rows="3" name="sugerencias"></textarea>
			<input name="send" type="submit" value="Enviar" class="button">
			</form>			
			</div><!-- end of .newsletter_form -->
			 <h4>Trabaja con nostros</h4>
			 <div class="poster">
			 <img src="img/jobs1.jpg" height="250" width="140" alt="Trabaja con nosotros" title="Trabaja con nosotros">
			 </div>             
		</div><!-- fin parte izquierda -->
        
	<!-- parte central -->               
        <div id="main_content">
             <div class="breadCrumbHolder module">
                <div id="breadCrumb3" class="breadCrumb module">
<select name="filtro" id="filtro" onchange="cargar(this.value)">
     <option value=''>Elige filtro
	 <option value=1>Menos de 10</option>
	 <option value=2>Entre 10 y 50</option>
	 <option value=3>Entre 50 de 100</option>
	 <option value=4>Entre 100 de 200</option>
	 <option value=5>Más de 200</option>
</select>
				
				
				</div>
            </div>
			
			<table>
			<thead><tr><td>Imagen</td><td>Precio</td><td>Categoria</td><td>bandera</td><td>unidades</td></tr></thead>
	</table>
		</div><!-- fin parte central -->			 
			 <!-- parte derecha -->
			<div id="right_sidebar">
				 <div class="cart">
				 <div class="counter">
				 <?php echo $total?>
				 </div>
					<h5>Su cesta de compra</h5>			
						<a href='verCarrito.php'><img  class="cart_big" src="img/carrito.png" width="80" height="80" alt="Ver carrito y efectuar pago"></a><br>
						<p class="checkout">Ver carrito y efectuar pago</p>
				  </div> 
				  <div>
				  </div>
			</div><!-- fin parte derecha -->
       		
			<!-- pie de p?gina -->
			<div id="footer">
		
			<table>
			<tr>
			<br />
			</tr>
			</table>


			</div>
			<!-- fin pie de p?gina -->  
  
	</div><!-- fin p?gina-->



 <script>$(document).ready(function() {
	$('#games').coinslider({ hoverPause: false });
});
</script>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11860629-1");
pageTracker._trackPageview();
} catch(err) {}
</script>

<link href='http://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
  
  
</body>
</html>
