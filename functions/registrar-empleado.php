<?php 

	$nombre = $_POST['nvchnombres'];
	$apellido = $_POST['nvchapellidos'];

	if($nvchapellido==null || $apellido==null){
		header('location: ../personal.php');
	}

	include ('../db/conextion.php'); //incluytendo cadena de coneccion


	try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $sql = "
		    	INSERT INTO tb_personal 
		    		(intidcodigo, nvchnombres, nvchapellidos)
		    	VALUES 
		    		(null, '$nombre', '$apellido')
		    ";
		    $conn->exec($sql);
		    echo '<script>alert("Registro creado exitosamente..!!");</script>';
	    }
	catch(PDOException $e)
	    {
	   		echo $sql . "<br>" . $e->getMessage();
	    }

		$conn = null;

?>