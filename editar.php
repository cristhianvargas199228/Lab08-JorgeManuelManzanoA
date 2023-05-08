<!DOCTYPE html>
<html>
<head>
	<title>CRUD Hospital</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
		body {
			background-image: url('./imagenes/Fondo2.jpg');
			background-size: cover;
			background-repeat: no-repeat;
		}
    </style>
</head>
<body>
<?php
if(!isset($_GET['codigo'])){
    header('Location: index.php?mensaje=error');
    exit();
}
include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['txtNombres'];
    $ap_paterno =  $_POST['txtApPaterno']; 
    $ap_materno = $_POST['txtApMaterno'];
    $seguro_medico = $_POST['txtSegMedico'];
    $genero = $_POST['txtGenero'];
    $celular =  $_POST['txtCelular'];
    $direccion =  $_POST['txtDireccion'];
    $estado = $_POST ['txtEstado'];

    $sentencia = $bd->prepare("UPDATE hospital.pacientes SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, seguro_medico = ?,
                            genero = ?, celular = ?, direccion = ?, estado = ? WHERE codigo = ?;");
    $resultado = $sentencia->execute([$nombres, $ap_paterno, $ap_materno, $seguro_medico, $genero, $celular, $direccion, $estado, $codigo]);

    if ($resultado) {
        header('Location: index.php?mensaje=editado');
        exit();
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
} else {
    $sentencia = $bd->prepare("SELECT * FROM hospital.pacientes WHERE codigo = ?;");
    $sentencia->execute([$codigo]);
    $persona = $sentencia->fetch(PDO::FETCH_OBJ);
}
?>
<div style="max-width: 420px; margin: 72px auto; border-radius: 5px; font-family: Arial, sans-serif; background-color: #f5f5f5;
            border-radius: 5px; padding: 35px;">
    <h2 style="text-align: center; margin-bottom: 20px; font-size:19px;">Editar datos:</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?codigo=' . $codigo); ?>">
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929;  margin-bottom: 5px;">Nombres: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;"
                class="form-control" name="txtNombres" required value="<?php echo $persona->nombres; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Apellido Paterno: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;"
                class="form-control" name="txtApPaterno" autofocus required value="<?php echo $persona->apellido_paterno; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Apellido Materno: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtApMaterno" autofocus required value="<?php echo $persona->apellido_materno; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Seguro Medico: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtSegMedico" autofocus required value="<?php echo $persona->seguro_medico; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Genero: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtGenero" autofocus required value="<?php echo $persona->genero; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Celular: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtCelular" autofocus required value="<?php echo $persona->celular; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Direccion: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtDireccion" autofocus required value="<?php echo $persona->direccion; ?>">
        </div>
        <div class="mb-3">
            <label style="display: block; font-weight: bold; color: #292929; margin-bottom: 5px;">Estado: </label>
            <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 95%; margin-bottom: 10px;" class="form-control" name="txtEstado" autofocus required value="<?php echo $persona->estado; ?>">
        </div>
        <input type="hidden" name="codigo" value="<?php echo $persona->id; ?>">
        <div class="d-grid">
            <input type="submit" style="padding: 10px; border-radius: 5px; border: none; background-color: #007bff; color: #fff; width: 100%; margin-bottom: 10px; cursor: pointer; font-size:14px" class="btn btn-primary" value="Editar">
        </div>
    </form>
</div>
</body>
</html> 

