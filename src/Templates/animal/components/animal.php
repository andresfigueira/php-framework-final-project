<?php

use Helpers\GeneralHelper;
use Repository\PublicacionRepository;

use function Core\dd;

$id = $animal['id'];
$nombre = $animal['nombre'];
$descripcion = $animal['descripcion'];
$fechaNacimiento = $animal['fecha_nacimiento'];
$tipoAnimal = $animal['tipo_animal'];
$razaAnimal = $animal['raza_animal'];
$sexoAnimal = $animal['sexo_animal'];
$imagen = $animal['imagen'] ? $animal['imagen'] : GeneralHelper::defaultBlankImage();

?>

<div class="jumbotron p-4 w-full">
    <div class="flex flex-col">
        <div class="flex flex-col h-full sm:flex-row">
            <div class="w-full h-full sm:w-64">
                <img class="img-thumbnail" alt="<?= $nombre ?>" src="<?= $imagen ?>" />
            </div>

            <div class="flex flex-col w-full h-full mt-2 justify-between sm:ml-2 sm:mt-0">
                <div class="flex flex-col sm:flex-row sm:justify-between">
                    <h5 class="mt-2">
                        <?= $nombre ?>
                    </h5>

                    <div>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $tipoAnimal ?></small>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $razaAnimal ?></small>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $sexoAnimal ?></small>
                    </div>
                </div>
                <p class="text-muted mb-2"><?= $descripcion ?></p>
                <p class="mb-2"><?= $fechaNacimiento ?></p>
            </div>
        </div>

        <div class="inline-flex flex-col sm:flex-row sm:justify-end">
        <?php
                if ($email == $_SESSION['user']['email']) { ?>
                    <div>
                        <form method="POST" action="/animales/inactivar">
                            <div>
                                <input type="hidden" name="animal_id" value="<?= $id ?>">
                                <input type="hidden" name="imagen_id" value="<?= $id ?>">
                            </div>
                            <div>
                                <button type="submit" onClick="return confirm('¿Estás seguro de borrar este animal?')" class="btn btn-danger btn-sm items-end float-right">Borrar</a>
                            </div>
                        </form>
                    </div>
                    <div class="ml-2">
                        <a class="btn btn-primary btn-sm items-end float-right" href="/animales/editar?id=<?= $id ?>" role="button">Editar</a>
                    </div>
            <?php } ?>
        </div>
    </div>

</div>
