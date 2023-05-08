<?php include 'template/encabezado.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from pacientes");
    $pacientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<style>
    .mensaje {
        position: relative;
        margin-bottom: 10px;
        background-color: #F2F2F2;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    .mensaje .cerrar {
        position: absolute;
        top: 10px;
        right: 16px;
        cursor: pointer;
        font-size: 30px;
    }
</style>

<div style="margin-top: 40px; display: flex; justify-content: center;">
    <div style="width: 75%; display: flex;">
        <div style="width: 95%;">
            <?php if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'):?>
                <div class="mensaje" style="background-color: #c82333; color: #FAFAFA; border-color: #c82333;">
                    <span class="cerrar" onclick="this.parentElement.style.display='none'">&times;</span>
                    <strong>Error!</strong> Rellena todos los campos.
                </div>
            <?php endif;?>

            <?php if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'):?>
                <div class="mensaje" style="background-color: #23903B; color: #FAFAFA; border-color: #23903B;">
                    <span class="cerrar" onclick="this.parentElement.style.display='none'">&times;</span>
                    <strong>Se registraron todos los datos correctamente!</strong>
                </div>
            <?php endif;?>

            <?php if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'):?>
                <div class="mensaje" style="background-color: #c82333; color: #FAFAFA; border-color: #c82333;">
                    <span class="cerrar" onclick="this.parentElement.style.display='none'">&times;</span>
                    <strong>Error!</strong> Vuelve a intentar.
                </div>
            <?php endif;?>   

            <?php if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'):?>
                <div class="mensaje" style="background-color: #23903B; color: #FAFAFA; border-color: #23903B;">
                    <span class="cerrar" onclick="this.parentElement.style.display='none'">&times;</span>
                    <strong>Los datos fueron actualizados correctamente!</strong>
                </div>
            <?php endif;?> 

            <?php if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'):?>
                <div class="mensaje" style="background-color: #23903B; color: #FAFAFA; border-color: #23903B;">
                    <span class="cerrar" onclick="this.parentElement.style.display='none'">&times;</span>
                    <strong>Los datos fueron eliminados correctamente!</strong>
                </div>
            <?php endif;?>

            
            <div style="margin-top: 0x; background-color: #F2F2F2; padding: 20px; border-radius: 5px; margin-bottom: 20px; 
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
            <h2 style="margin-bottom: 20px; text-align: center; font-size: 22px;">Lista de pacientes</h2>
            <table style="width: 100%; text-align: center; border-collapse: collapse;">
            <thead style="background-color: #fff; color: #444; font-weight: bold;">
            <tr style= "font-size: 13px">
                <th style="border: 1px solid #ddd; padding: 10px;">Id</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Nombres</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Apellido Paterno</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Apellido Materno</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Seguro Medico</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Genero</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Celular</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Direccion</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Estado</th>
                <th style="border: 1px solid #ddd; padding: 10px; width: 200px;">Opciones</th>
            </tr>
            </thead>
            <tbody style="background-color: #F2F2F2; color: #5E5E5E; font-size: 12px;">
            <?php foreach($pacientes as $dato){ ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->codigo; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->nombres; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->apellido_paterno; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->apellido_materno; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->seguro_medico; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->genero; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->celular; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->direccion; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $dato->estado; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; width: 200px; text-align: center;">
                    <form method="get" action="editar.php" style="display: inline-block;">
                        <input type="hidden" name="codigo" value="<?php echo $dato->codigo; ?>">
                        <button class="btn-editar" type="submit"><img src="./imagenes/editar.png" alt="Editar" width="15px"
                            height="15px"></button>
                    </form>
                    <form method="get" action="promociones.php" style="display: inline-block;">
                        <input type="hidden" name="codigo" value="<?php echo $dato->codigo; ?>">
                        <button class="btn-promociones" type="submit"><img src="./imagenes/promocion.png" alt="Promociones" width="15px" 
                            height="15px"></button>
                    </form>
                    <form method="get" action="eliminar.php" style="display: inline-block;">
                        <input type="hidden" name="codigo" value="<?php echo $dato->codigo; ?>">
                        <button class="btn-eliminar" type="submit" onclick="return confirm('¿Estás seguro de eliminar este elemento?')">
                        <img src="./imagenes/eliminar.png" alt="Eliminar" width="15px" height="15px"></button>
                    </form>
                    </td>
                <?php }?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<div style="max-width: 400px; margin: 0 auto, padding: 0px;">
    <div style="background-color: #f5f5f5; border-radius: 5px; padding: 20px; padding-bottom: 3px; margin-bottom:40px">
        <h2 style="text-align: center; margin-bottom: 10px; font-size:19px;">Registrar pacientes:</h2>
        <form style="text-align: center; font-size: 14px" method="POST" action="registrar.php">
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nombres: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px;
                    margin-bottom:2px;" name="txtNombres" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Apellido Paterno: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px;
                    margin-bottom:5px;" name="txtApPaterno" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Apellido Materno: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px;
                    margin-bottom:5px;" name="txtApMaterno" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Seguro Medico: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px; 
                    margin-bottom:5px;" name="txtSegMedico" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Genero: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px;
                    margin-bottom:5px;" name="txtGenero" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Numero de celular : </label>
                <input type="number" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 5px;
                    margin-bottom:5px;" name="txtCelular" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Direccion: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 8px;"
                    name="txtDireccion" autofocus required>
            </div>
            <div class="mb-3">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Estado: </label>
                <input type="text" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; margin-top: 8px;" 
                    name="txtEstado" autofocus required>
            </div>
            <div class="mb-3">
                <input type="hidden" name="oculto" value="1">
                <input type="submit" style="padding: 10px; border-radius: 5px; border: none; background-color: #007bff; color: #fff;
                    width: 100%; margin-top: 20px; margin-bottom:20px; cursor: pointer; font-size:14px" value="Registrar">
            </div>
        </form>
    </div>
</div>

