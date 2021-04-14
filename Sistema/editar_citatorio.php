<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_citatorio']) || empty($_POST['razon']) || empty($_POST['fecha_creado']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} 
		else{
			$id_citatorio= $_POST['id_citatorio'];
			$razon= $_POST['razon'];
			$fecha_creado= $_POST['fecha_creado'];
			$fecha_citatorio= $_POST['fecha_citatorio'];
			$id_persona= $_POST['id_persona'];
			$id_requerimiento= $_POST['id_requerimiento'];
			
			
					if(empty($_POST['id_citatorio'])){
						$sql_update= mysqli_query($conection,"UPDATE citatorios_anuncios SET id_citatorio='$id_citatorio', razon='$razon', fecha_creado='$fecha_creado', fecha_citatorio='$fecha_citatorio', id_persona='$id_persona', id_requerimiento='$id_requerimiento' WHERE id_citatorio='$id_citatorio'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE citatorios_anuncios SET id_citatorio='$id_citatorio', razon='$razon', fecha_creado='$fecha_creado', fecha_citatorio='$fecha_citatorio', id_persona='$id_persona', id_requerimiento='$id_requerimiento' WHERE id_citatorio='$id_citatorio'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Citatorio actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el citatorio</p>';
					}	
			
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_citatorio.php');
			mysqli_close($conection);
	}
		$id_citatorio= $_GET['id'];
		$query= mysqli_query($conection,"SELECT c.id_citatorio, c.razon, c.fecha_creado, c.fecha_citatorio, c.id_persona, p.nombre_responsable, p.nombre_comercial, c.id_requerimiento, r.id_requerimiento, r.descripcion FROM personas p INNER JOIN citatorios_anuncios c on p.id_persona=c.id_persona INNER JOIN requerimientos_anuncios r on r.id_requerimiento=c.id_requerimiento WHERE c.id_citatorio=$id_citatorio");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_citatorio.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_citatorio= $data['id_citatorio'];
				$razon= $data['razon'];
				$fecha_creado= $data['fecha_creado'];
				$fecha_citatorio= $data['fecha_citatorio'];
				$id_persona= $data['id_persona'];
				$nombre_responsable= $data['nombre_responsable'];
				$nombre_comercial= $data['nombre_comercial'];
				$id_requerimiento= $data['id_requerimiento'];
				$descripcion= $data['descripcion'];	

			}	
		}
	$timeq = strtotime($fecha_citatorio);
	echo date('d/m/Y h:i a', $timeq);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar citatorio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar citatorio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_citatorio" value="<?php echo $id_citatorio; ?>">
        <label for="razon">Razón</label>
        <input type="text" name="razon" id="razon" placeholder="Razon de citatorio" value="<?php echo $razon; ?>">
        <label for="fecha_creado">Fecha</label>
        <input type="date" name="fecha_creado" id="fecha_creado" placeholder="Fecha de proceso" value="<?php echo $fecha_creado; ?>">
        <label for="fecha_citatorio">Fecha citatorio</label>
        <input type="datetime-local" name="fecha_citatorio" id="fecha_citatorio" placeholder="Fecha citatorio" value="<?php echo date('d/m/Y h:i:sa', $timeq); ?>">
        <label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
		$query_persona= mysqli_query($conection, "select * from personas order by id_persona asc");
			mysqli_close($conection);
		$result_persona= mysqli_num_rows($query_persona);

		?>
        <select name="id_persona" id="id_persona"> 
        	<option value="<?php echo $id_persona; ?>" selected><?php echo "$nombre_responsable - $nombre_comercial"; ?></option>
			<?php
                if ($result_persona > 0)
                {
            
                   while($id_persona= mysqli_fetch_array($query_persona)) {
			?>
            <option value="<?php echo $id_persona['id_persona']; ?>"><?php echo $id_persona['nombre_responsable'], " - ", $id_persona['nombre_comercial'] ?></option>
            <?php
					}
                }
            
        ?>
    	</select>
    	<label for="id_requerimiento">Requerimiento</label>
        <?php include "conexion.php";
        $query_multa= mysqli_query($conection, "select * from requerimientos_anuncios order by id_requerimiento");
            mysqli_close($conection);
        $result_multa= mysqli_num_rows($query_multa);

        ?>
        <select name="id_requerimiento" id="id_requerimiento"> 
        	<option value="<?php echo $id_requerimiento; ?>" selected><?php echo "$id_requerimiento - $descripcion"; ?></option>
            <?php
                if ($result_multa > 0)
                {
            
                   while($id_requerimiento= mysqli_fetch_array($query_multa)) {
            ?>
            <option value="<?php echo $id_requerimiento['id_requerimiento']; ?>"><?php echo $id_requerimiento['id_requerimiento'], " - ", $id_requerimiento['descripcion'] ?></option>
            <?php
                    } 
                }
            
        ?>
        </select>
        <input type="submit" value="Actualizar citatorio" class="btn_save">
    </form>
    </div>
			</div>
            	<?php include "includes/aside.php"; ?>
            </div>	 
		</div>
	</section>
		<?php include "includes/footer.php"; ?>
</body>
</html>