<?php //Ejemplo curso PHP aprenderaprogramar.com
date_default_timezone_set("America/Mexico_City");
$time = time();
$date= date("d-m-Y (H:i)", $time);

?>

		<div class="wrapp">
			<div class="mensaje">
				<h1><i class="fas fa-desktop"></i>  Bienvenido al Sistema de la DDUMAYT</h1>
			</div>

            		<div class="wrapp">

			<nav>
				<ul>
					<li><a href="index.php"><i class="fas fa-home"></i>Inicio</a> </li>                  
					<li><a href="http://observatorio.ciudadvictoria.gob.mx/" targetS="_blank"><i class="fas fa-map-marker-alt"></i>GEOVIC</a></li>
					<li><p><i class="far fa-calendar-alt"></i> fecha:<?php echo $date ?></p></li>
			<!--	    <li><p class="user"><i class="fas fa-user"></i><?php echo $_SESSION['user'].'- '.$_SESSION['rol'] ?><p></li> -->

				</ul>
			</nav>
		</div>