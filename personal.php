<?php  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>memorandums</title>
</head>
<body>
	<form action="functions/registrar-empleado.php" method="POST">
		<label for="">Nombres: </label>
		<input type="text" name="nvchnombres" placeholder="Ingrese Nombres" required>
		<br>
		<label for="">Apellidos: </label>
		<input type="text" name="nvchapellidos" placeholder="Ingrese Apellido" required>
		<br>
		<br>
		<input type="submit" value="Registrar">
	</form>
	<br>
	<a href="memos.php">Registrar Memo</a>
</body>
</html>