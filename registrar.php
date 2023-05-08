<?php
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApPaterno"]) || empty($_POST["txtApMaterno"]) ||
    empty($_POST["txtSegMedico"]) || empty($_POST["txtGenero"]) || empty($_POST["txtCelular"]) || empty($_POST["txtDireccion"]) ||
    empty($_POST ["txtEstado"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';

$nombres = $_POST["txtNombres"];
$ap_paterno =  $_POST["txtApPaterno"]; 
$ap_materno = $_POST["txtApMaterno"];
$seguro_medico = $_POST["txtSegMedico"];
$genero = $_POST["txtGenero"];
$celular =  $_POST["txtCelular"];
$direccion =  $_POST["txtDireccion"];
$estado = $_POST ["txtEstado"];

$sentencia = $bd->prepare("INSERT INTO pacientes(nombres, apellido_paterno, apellido_materno, seguro_medico, genero, celular ,
                            direccion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$nombres, $ap_paterno, $ap_materno, $seguro_medico, $genero, $celular, $direccion, $estado]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}

