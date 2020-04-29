<?php

use function Core\dd;
use Repository\PublicacionRepository;

$id = $_GET['id'];
$publicacion = PublicacionRepository::findById($id);
$titulo = $publicacion['titulo'];
$descripcion = $publicacion['descripcion'];
$referencia = $publicacion['referencia'];
$direccion = $publicacion['direccion'];
$estado_id = $publicacion['estado_id'];
$usuario_id = $publicacion['usuario_id'];
$provincia_id = $publicacion['provincia_id'];
$animal_id = $publicacion['animal_id'];

?>

<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
        <h1 class="lead mb-4">Editar publicacion</h1>

        <form method="POST" action="/publicaciones/editar">
            <div>
                <input type="hidden" name="publicacion_id" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label>Título</label>
                <input class="form-control" name="titulo" placeholder="Ingresa título" required value="<?= $titulo ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['titulo'] ?></small>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <input class="form-control" name="descripcion" placeholder="Ingresa descripción" value="<?= $descripcion ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['descripcion'] ?></small>
            </div>
            <div class="form-group">
                <label>Referencia</label>
                <input type="form-control" class="form-control" name="referencia" placeholder="Ingresa referencia" value="<?= $referencia ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['referencia'] ?></small>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input class="form-control" name="direccion" placeholder="Ingresa dirección" value="<?= $direccion ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['direccion'] ?></small>
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
                <label>Estado</label>
                <select class="form-control" name="estado_id" placeholder="Selecciona el estado de la publicación" required>
                    <?php foreach ($estadoOptions as $estadoOption) { ?>
                        <option <?= $estado_id == $estadoOption['id'] ? 'selected' : '' ?> value="<?= $estadoOption['id'] ?>">
                            <?= $estadoOption['nombre'] ?>
                        </option>                    
                    <?php } ?>
                </select>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Editar publicación</button>
            </div>
        </form>
    </div>
</div>
