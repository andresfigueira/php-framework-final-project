<?php

use function Core\dd;
use Repository\UserRepository;
use Repository\ImagenRepository;

$nombre = $_SESSION['user']['nombre'];
$apellido = $_SESSION['user']['apellido'];
$email = $_SESSION['user']['email'];
$direccion = $_SESSION['user']['direccion'];
$telefono_1 = $_SESSION['user']['telefono_1'];
$telefono_2 = $_SESSION['user']['telefono_2'];
$provincia_id = $_SESSION['user']['provincia_id'];
$imagen = $_SESSION['user']['imagen'];
$imagen_id = $_SESSION['user']['imagen_id'];


?>

<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
        <h1 class="lead mb-4">Editar perfil</h1>

        <form method="POST" action="/perfil/editar">
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" name="nombre" placeholder="Ingresa nombre" required value="<?= $nombre ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['nombre'] ?></small>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input class="form-control" name="apellido" placeholder="Ingresa apellido" required value="<?= $apellido ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['apellido'] ?></small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Ingresa email" required value="<?= $email ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['email'] ?></small>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input class="form-control" name="direccion" placeholder="Ingresa dirección" value="<?= $direccion ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['direccion'] ?></small>
            </div>
            <div class="form-group">
                <label>Teléfono 1</label>
                <input class="form-control" name="telefono_1" placeholder="Ingresa teléfono 1" value="<?= $telefono_1 ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['telefono_1'] ?></small>
            </div>
            <div class="form-group">
                <label>Teléfono 2</label>
                <input class="form-control" name="telefono_2" placeholder="Ingresa teléfono 2" value="<?= $telefono_2 ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['telefono_2'] ?></small>
            </div>
            <div class="form-group">
                <label>Provincia</label>
                <select class="form-control" name="provincia_id" placeholder="Selecciona la provincia">
                    <option value="" selected>Selecciona la provincia</option>
                    <?php foreach ($provinciaOptions as $provinciaOption) { ?>
                        <option <?= $provincia_id == $provinciaOption['id'] ? 'selected' : '' ?> value="<?= $provinciaOption['id'] ?>">
                            <?= $provinciaOption['nombre'] ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['provincia'] ?></small>
            </div>
            <div class="form-group">
                <label>Imagen</label>
                <input value="<?= $imagen ?>" type="url" class="form-control" name="imagen" placeholder="URL de la imagen">
                <input type="hidden" value="<?= $imagen_id ?>" />
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Editar perfil</button>
            </div>
        </form>
    </div>
</div>
