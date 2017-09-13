<?php  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>memorandums</title>
</head>
<body>
	<form action="functions/registrar-memos.php" method="POST">
		<label for=""> Codigo de Memorandum: </label>
		<input type="text" name="nvchcodigomemo" placeholder="Ingrese codigo de " required>
		<br>
		<label for="">Nombre del personal: </label>
		<!--input type="text" name="intnamepersonal" placeholder="Ingrese nombres completos" required-->
		<select name="intnamepersonal" id="">
			<?php 
			
				include ('db/conextion.php'); //incluytendo cadena de coneccion
		  		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

				$sql = 'SELECT intidcodigo, nvchnombres, nvchapellidos FROM tb_personal';
				    foreach ($conn->query($sql) as $row) {
				        echo '
				        	<option value="'.$row["intidcodigo"].'">'.$row["nvchnombres"].' '.$row['nvchapellidos'].'</option>';
				    }

			 ?>
		</select>
		<a href="personal.php">Registrar Personal</a>
		<br>
		<label for="">Año de memorandum: </label>
		<input type="date" name="dtmemo" placeholder="Ingrese Año">
		<br>
		<label for="">Oficina</label>
		<select name="intidoficina" id="">
			<option value="Dirección">Dirección</option>
			<option value="Administración">Administración</option>
			<option value="Contabilidad">Contabilidad</option>
			<option value="Coordinación">Coordinación</option>
		</select>
		<br>
		<br>
		<input type="submit" value="Registrar">
	</form>
</body>
</html>