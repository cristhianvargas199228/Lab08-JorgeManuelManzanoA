<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_persona, pac.nombres, pac.apellido_paterno, pac.apellido_materno, pac.seguro_medico, pac.genero, pac.celular, pac.direccion, pac.estado
  FROM promociones pro 
  INNER JOIN pacientes pac ON pac.codigo = pro.id_persona 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$paciente = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101816589/SendMessage/3966db0ba80240a483d349e42c068530d0e60dc3b5574635bb';
    $data = [
        "chatId" => "51".$paciente->celular."@c.us",
        "message" =>  'Estimado(a) *'.strtoupper($paciente->nombres).' '.strtoupper($paciente->apellido_paterno).' '.strtoupper($paciente->apellido_materno).'* Se le informa que desde este *'.strtoupper($paciente->duracion).'* estara activo *'.$paciente->promocion.'*. Lo esperamos'
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
?> 
