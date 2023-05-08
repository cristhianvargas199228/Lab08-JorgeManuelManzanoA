<?php include 'template/encabezado_promociones.php' ?>

<?php
include_once "./model/conexion.php";
$codigo = $_GET["codigo"];

$sentencia = $bd->prepare("select * from pacientes where codigo = ?;");
$sentencia->execute([$codigo]);
$paciente = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_promocion = $bd->prepare("select * from promociones where id_persona = ?;");
$sentencia_promocion->execute([$codigo]);
$promocion = $sentencia_promocion->fetchAll(PDO::FETCH_OBJ); 
?>


<div style="margin: 0px; text-align: center;">
    <div style="width 100%; display: inline-flex;">
        <div style="margin: 0 auto; padding: 0px; width: 40%;">
            <div style="background-color: #f5f5f5; margin:40px;  border-radius: 5px; padding: 20px;">
                <h2 style="text-align: center; margin-bottom: 20px; font-size:19px;">Registrar promocion:</h2>
                <form class="p-4" method="POST" action="registrarpromocion.php">
                    <div class="mb-3">
                        <label class="form-label">Promocion: </label>
                        <input type="text" class="form-control" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 80%; margin-bottom: 10px;" name="txtPromocion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duración de la Promocion: </label>
                        <input type="text" class="form-control" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 80%; margin-bottom: 10px;" name="txtDuracion" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $paciente->codigo; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" style="padding: 10px; border-radius: 5px; border: none; background-color: #007bff; color: #fff; width: 88%; margin-bottom: 10px; cursor: pointer; font-size:14px" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div style="margin: 0 auto; width: 65%;">
            <div style="background-color: #F2F2F2; margin:40px; padding: 20px; border-radius: 5px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
                <h2 style="margin-bottom: 20px; text-align: center; font-size: 20px;">Lista de promociones de <?php echo $paciente->nombres.' '.$paciente->apellido_paterno.' '.$paciente->apellido_materno; ?></h2>
                <table style="width: 100%; text-align: center; border-collapse: collapse;">
                    <thead style="background-color: #fff; color: #444; font-weight: bold;">
                        <tr style="font-size: 13px;">
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: center;" scope="col">Id</th>
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: center;" scope="col">Promocion</th>
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: center;" scope="col">Duracion</th>
                            <th style="border: 1px solid #ddd; padding: 10px; width: 200px; text-align: center;" scope="col" colspan="3">Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #F2F2F2; color: #5E5E5E; font-size: 12px;">
                        <?php
                            foreach ($promocion as $dato) {
                            ?>
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;" scope="row"><?php echo $dato->id; ?></td>
                                <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->promocion; ?></td>
                                <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->duracion; ?></td>
                                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                                    <button class="btn-enviar" onclick="location.href='enviarmensaje.php?codigo=<?php echo $dato->id; ?>'"><img src="./imagenes/enviar.png" alt="Editar" width="15px" height="15px"></button>
                                    <form method="get" action="eliminarpromociones.php" style="display: inline-block;">
                                        <input type="hidden" name="codigo" value="<?php echo $dato->id; ?>">
                                        <button class="btn-eliminar" type="submit" onclick="return confirm('¿Estás seguro de eliminar este elemento?')"><img src="./imagenes/eliminar.png" alt="Eliminar" width="15px" height="15px"></button>
                                    </form>    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



