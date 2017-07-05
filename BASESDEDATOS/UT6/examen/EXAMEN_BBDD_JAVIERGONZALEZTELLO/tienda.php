<?php
session_start();
if (!isset($_SESSION['usuario']))
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
        <link rel="icon" type="img/png" href="img/favicon.png">

		<!--[if lte IE 7]>
		<script type="text/javascript" src="js/jquery/jquery.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
		<![endif]-->
        
		<script type="text/javascript" src="js/jquery/jquery.js"></script>
		<script type="text/javascript" src="js/nav_l/sliding_effect.js"></script>
        <script type="text/javascript" src="js/slider/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/slider/coin-slider.min.js">
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

	<a href="profile.php"><?php echo $_SESSION['usuario'];?></a>
					</li>
					<li>|</li>
					<li>
						<a href="verCarrito.php" class="cart_counter"><img src='img/total_cart.png' width="18" height="18"> (<?php						
// conexion
include("conexion_bd.php");
$id = $_SESSION['usuario'];
$sql="SELECT * FROM compras  WHERE comprador='$id'";
$registros=mysql_query($sql)or die("Error al leer compras <br> <a href='tienda.php'>Pulse aqui para continuar </a>");
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
			<?php
			$isadmin;
				if ($_SESSION['usuario'] == 'admin'){
					$isadmin = true;
				} else {
					$isadmin = false;
				}
            	 echo "<ul>";
				echo "<li><a href=\"tienda.php\">INICIO</a></li>";
    				 echo "<li><a href=\"empresa.html\">EMPRESA</a></li>";
    				echo "<li><a href=\"servicios.html\">SERVICIOS</a></li>";
					if ($isadmin){
							echo "<li><a href=\"stock.php\">STOCK</a></li>";
					} else {
							echo "<li><a href=\"productos.html\">PRODUCTOS</a></li>";
					}
    				
				echo "<li>";
				echo "</ul>";
				?>
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
include("conexion_bd.php");
$sql="SELECT * FROM categorias";
$registros=mysql_query($sql);
while($linea=mysql_fetch_array($registros))
{
echo "<li class='sliding-element'><a href='tienda.php?cat=$linea[idcategoria]'>$linea[nombre]</a></li>";
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
			<form name="sugerencias" id="sugerencias" method="POST" action="altasSugerencias.php">
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
<?php
if(isset($_GET['cat']))
{
	$cat=$_GET['cat'];
	$sql="SELECT * FROM productos WHERE idCategoria=$cat";
}
else
{
	$sql="SELECT * FROM productos WHERE mostrar=1";
}
$registros=mysql_query($sql);
while($linea=mysql_fetch_array($registros))
{
	$bandera = "./img/cart_add.png"; //-> esto funciona
	// echo "alert('hola')";
	$variable = $linea['idpais'];
	// echo $variable;
	$registros2 = mysql_query("SELECT * FROM paises, productos WHERE paises.idpais = $variable");
	$linea2 = mysql_fetch_array($registros2);
	$bandera = $linea2['bandera'];
	echo"<div class='product'><img src='$linea[imagen]' width ='172'><div class='text'><p class='product_title'>$linea[nombre]</p><p class='price'>$linea[precio]</p><div class='buy'><a href='altasCarrito.php?ref=$linea[idProducto]'><img src='./img/cart_add.png'></a><img src=$bandera width='25'></div></div></div>";
}
?>			
			</div><!-- fin parte central -->
			 
			 <!-- parte derecha -->
				 <?php
				 if ($id != 'invitado'){
					 			echo "<div id=\"right_sidebar\">";
				 echo "<div class=\"cart\">";
				 echo "<div class=\"counter\">";
				echo $total;
				 echo "</div>";
					 echo "<h5>Su cesta de compra</h5>";
					 echo "<a href='verCarrito.php'><img  class=\"cart_big\" src=\"img/carrito.png\" width=\"80\" height=\"80\" alt=\"Ver carrito y efectuar pago\"></a><br>";
					 echo "<p class='checkout'>Ver carrito y efectuar pago</p>";
					 echo "</div>"; 
				 }
				  ?>
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