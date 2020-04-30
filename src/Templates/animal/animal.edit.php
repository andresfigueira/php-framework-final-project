<?php

use function Core\dd;
use Repository\AnimalRepository;

$id = $_GET['id'];
$animal = AnimalRepository::findById($id);
$nombre = $animal['nombre'];
$descripcion = $animal['descripcion'];
$fechaNacimiento = $animal['fecha_nacimiento'];
$tipo_animal_id = $animal['tipo_animal_id'];
$raza_animal_id = $animal['raza_animal_id'];
$sexo_animal_id = $animal['sexo_animal_id'];
$estado_id = $animal['estado_id'];
$imagen = $animal['imagen'];
$imagen_id = $animal['imagen_id'];

?>

<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
        <h1 class="lead mb-4">Editar publicacion</h1>

        <form method="POST" action="/animales/editar">
            <div>
                <input type="hidden" name="animal_id" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" name="nombre" placeholder="Ingresa nombre" required value="<?= $nombre ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['nombre'] ?></small>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <input class="form-control" name="descripcion" placeholder="Ingresa descripción" value="<?= $descripcion ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['descripcion'] ?></small>
            </div>
            <div class="form-group">
                <label>Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento_animal" placeholder="Ingresa la fecha de nacimiento" value="<?= $fechaNacimiento ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['fecha_nacimiento_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Tipo de animal</label>
                <select class="form-control" name="tipo_animal_id" placeholder="Selecciona la especie">
                    <option value="" selected>Selecciona la especie</option>
                    <?php foreach ($tipoAnimalOptions as $tipoAnimalOption) { ?>
                        <option <?= $tipo_animal_id == $tipoAnimalOption['id'] ? 'selected' : '' ?> value="<?= $tipoAnimalOption['id'] ?>">
                            <?= $tipoAnimalOption['nombre'] ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['tipo_animal_id'] ?></small>
            </div>
            <div class="form-group">
                <label>Raza animal</label>
                <select class="form-control" name="raza_animal_id" placeholder="Selecciona la raza">
                    <option value="" selected>Selecciona la raza</option>
                    <?php foreach ($razaAnimalOptions as $razaAnimalOption) { ?>
                        <option <?= $raza_animal_id == $razaAnimalOption['id'] ? 'selected' : '' ?> value="<?= $razaAnimalOption['id'] ?>">
                            <?= $razaAnimalOption['nombre'] ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['raza_animal_id'] ?></small>
            </div>
            <div class="form-group">
                <label>Sexo del animal</label>
                <select class="form-control" name="sexo_animal_id" placeholder="Selecciona el sexo">
                    <option value="" selected>Selecciona el sexo</option>
                    <?php foreach ($sexoAnimalOptions as $sexoAnimalOption) { ?>
                        <option <?= $sexo_animal_id == $sexoAnimalOption['id'] ? 'selected' : '' ?> value="<?= $sexoAnimalOption['id'] ?>">
                            <?= $sexoAnimalOption['nombre'] ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['sexo_animal_id'] ?></small>
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
            <div class="form-group">
                <label>Imagen</label>
                <input value="<?= $imagen ?>" type="url" class="form-control" name="imagen" placeholder="URL de la imagen">
                <input type="hidden" value="<?= $imagen_id ?>" />
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Editar publicación</button>
            </div>
        </form>
    </div>
</div>
