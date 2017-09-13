<?php 

	$codigouser = $_POST['nvchcodigomemo'];
	$nombre = $_POST['intnamepersonal'];
	$fecha = $_POST['dtmemo'];
	$oficina = $_POST['intidoficina'];

	if($codigo==null || $nombre==null || $fecha==null || $oficina){
		header('location: ../memos.php');
	}

	include ('../db/conextion.php'); //incluytendo cadena de coneccion


	try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "
		    	INSERT INTO tb_memos 
		    		(intidcodigo, nvchcodigomemo, intnamepersonal, dtmemo, intidoficina)
		    	VALUES 
		    		(null, '$codigouser', '$nombre', '$fecha', '$oficina')
		    ";
		    // use exec() because no results are returned
		    $conn->exec($sql);
		    echo "Registro creado exitosamente..!!";
	    }
	catch(PDOException $e)
	    {
	   		echo $sql . "<br>" . $e->getMessage();
	    }

		$conn = null;

?>