<?php 
    require_once("dompdf/dompdf_config.inc.php");
    $conexion = mysql_connect("localhost","root","");
    mysql_select_db("db_memos",$conexion);

    //obteniendo parametro
    $codigo = $_GET['codreport'];


    //obteniendo fecha
    date_default_timezone_set('America/Lima');
    $dia = date("N"); //dia en numeros
    $mesdelanio = date("m"); //mes del anio en numero
    $diadelmes = date("j"); //dia del mes
    $anio = date("Y"); //anio en 4 digitos

    $time = date("H:i:s"); //time formato Hor/minuto/segundo

    $timehora = date("g");
    $timeminuto = date("i");
    $timeminuto2 = date("a");

    //calendari mostrando fecha y hora actual
    switch ($mesdelanio) {
      case '1':
        $mesdelanio1 = "Enero";
        break;
      case '2':
        $mesdelanio1 = "Febrero";
        break;
      case '3':
        $mesdelanio1 = "Marzo";
        break;
      case '4':
        $mesdelanio1 = "Abril";
        break;
      case '5':
        $mesdelanio1 = "Mayo";
        break;
      case '6':
        $mesdelanio1 = "Junio";
        break;
      case '7':
        $mesdelanio1 = "Julio";
        break;
      case '8':
        $mesdelanio1 = "Agosto";
        break;
      case '9':
        $mesdelanio1 = "septiembre";
        break;
      case '10':
        $mesdelanio1 = "Octubre";
        break;
      case '11':
        $mesdelanio1 = "Noviembre";
        break;
      case '12':
        $mesdelanio1 = "Diciembre";
        break;
      default:
        echo "no se dfinio correctamente";
        break;
    }


$fechadoc = $diadelmes.' '.$mesdelanio1.' a las '.$time; 


$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Memorandums</title>
</head>
<body>
<div style="text-align:right; font-size:11px">
'.
$fechadoc.'
</div>
<div>
  <h1>Reporte Memorandums</h1>
</div>
<div>
  <p>
    Usuario: ';
    $consulta=mysql_query("
          select 
            nvchnombres, 
            nvchapellidos 
          from 
            tb_personal 
          WHERE 
            tb_personal.intidcodigo = $codigo;
        ");
    while($dato=mysql_fetch_array($consulta))
    {
      $codigoHTML.=''.$dato['nvchnombres'].' '.$dato['nvchapellidos'];
    } 
    
    $codigoHTML.='
  </p>
  <p>Memorandums enviados:</p>
</div>
<div align="center">
    <table style="text-align: center; width:100%">
      <thead>
        <tr>
          <td ><strong>Codigo Memorandum</strong></td>
          <td ><strong>Oficina que Emite</strong></td>
          <td ><strong>Fecha Emitida</strong></td>
        </tr>
      </thead>
    <tbody>';
        $consulta=mysql_query("
            select
              tb_personal.intidcodigo,
              CONCAT(
                tb_personal.nvchnombres,' ',tb_personal.nvchapellidos
              ) as 'nvcnombresusers',
              tb_memos.nvchcodigomemo,
              tb_memos.intidoficina,
              tb_memos.dtmemo
          from 
            tb_memos inner join tb_personal
            on tb_memos.intnamepersonal = tb_personal.intidcodigo
          WHERE 
             tb_personal.intidcodigo = $codigo;
            ");
        while($dato=mysql_fetch_array($consulta)){
        $codigoHTML.='
              <tr style="text-transform:uppercase">
                <td>'.$dato['nvchcodigomemo'].'</td>
                <td>'.$dato['intidoficina'].'</td>
                <td>'.$dato['dtmemo'].'</td>
              </tr>';
              } 
        $codigoHTML.='
  </tbody>
  </table>
</div>
</body>
</html>';


$nmrndm = 'Reportememorandum'.$fechadoc;
$namedoc = $nmrndm.$fechadoc.'.pdf';

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream($namedoc, array("Attachment" => false));
?>