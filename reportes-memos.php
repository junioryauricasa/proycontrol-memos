<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reportes</title>
	<script src='js/jquery-1.12.4.js'></script>
	<script src='js/jquery.dataTables.min.js'></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body>
    <div>
        <a href="memos.php">registrar Memo</a>
        <a href="personal.php">Crear Personal</a>
    </div>
    <br>
    <div style="width:600px">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres y Apellidos</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    include ('db/conextion.php'); //incluytendo cadena de coneccion
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                    $sql = '
                            SELECT 
                                intidcodigo, nvchnombres, nvchapellidos 
                            FROM 
                                tb_personal
                            ';

                        foreach ($conn->query($sql) as $row) {
                            
                            echo 
                                '
                                <tr>
                                    <td>'.$row["intidcodigo"].'</td>
                                    <td>'.$row["nvchnombres"].' '.$row["nvchapellidos"].'</td>
                                    <td><a target="_blank" href="reporte-memos.php?codreport='.$row["intidcodigo"].'">ver reportes</a></td>
                                </tr>
                                ';

                        }

                 ?>
            </tbody>
        </table> 
    </div>

	
</body>
</html>


<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>