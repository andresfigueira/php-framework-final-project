<?php

use function Core\dd;
use Helpers\GeneralHelper;

$id = $publicacion['id'];
$titulo = $publicacion['titulo'];
$descripcion = $publicacion['descripcion'];
$referencia = $publicacion['referencia'];
$direccion = $publicacion['direccion'];
$provincia = $publicacion['provincia'];
$nombreUsuario = $publicacion['nombre_usuario'];
$email = $publicacion['email'];
$nombreAnimal = $publicacion['nombre_animal'];
$descripcionAnimal = $publicacion['descripcion_animal'];
$tipoAnimal = $publicacion['tipo_animal'];
$razaAnimal = $publicacion['raza_animal'];
$sexoAnimal = $publicacion['sexo_animal'];
$imagen = $publicacion['imagen'];

?>

<div class="jumbotron p-4 w-full">
    <div class="flex flex-col">
        <div class="flex flex-col h-full sm:flex-row">
            <div class="w-full h-full sm:w-64">
                <img class="img-thumbnail" alt="<?= $nombreAnimal ?>" src="<?= $imagen ? $imagen : GeneralHelper::defaultBlankImage() ?>" />
            </div>

            <div class="flex flex-col w-full h-full mt-2 justify-between sm:ml-2 sm:mt-0">
                <div class="flex flex-col sm:flex-row sm:justify-between">
                    <h5 class="mt-2">
                        <?= $titulo ?>
                        <small class="text-muted">(<?= $provincia ?>)</small>
                    </h5>

                    <div>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $tipoAnimal ?></small>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $razaAnimal ?></small>
                        <small class="text-muted mt-2 sm:mt-0 sm:ml-2"><?= $sexoAnimal ?></small>
                    </div>
                </div>
                <p class="text-muted mb-2"><?= $descripcion ?></p>
                <p class="mb-2"><?= $provincia ?>, <?= $direccion ?></p>
            </div>
        </div>

        <div class="inline-flex flex-col sm:flex-row sm:justify-between items-end">
            <div class="mr-auto">
                <h6 class="mt-2">
                    <?= $nombreAnimal ?>
                    <small class="text-muted">(<?= $referencia ?>)</small>
                </h6>
                <small class="text-muted"><?= $descripcionAnimal ?></small>
            </div>
            
            <?php
            if ($email != $_SESSION['user']['email']) { ?>
                <div>
                    <a class="btn btn-primary btn-sm items-end float-right" href="mailto:<?= $email ?>" role="button">Contactar a <?= $nombreUsuario ?></a>
                </div>
            <?php } ?>
            
            <?php
                if ($email == $_SESSION['user']['email']) { ?>
                    <div>
                        <form method="POST" action="/publicaciones/inactivar">
                            <div>
                                <input type="hidden" name="publicacion_id" value="<?= $id ?>">
                            </div>
                            <div>
                                <button type="submit" onClick="return confirm('¿Estás seguro de borrar esta publicación?')" class="btn btn-danger btn-sm items-end float-right">Borrar</a>
                            </div>
                        </form>
                    </div>
                    <div class="ml-2">
                        <a class="btn btn-primary btn-sm items-end float-right" href="/publicaciones/editar?id=<?= $id ?>" role="button">Editar</a>
                    </div>
            <?php } ?>
        </div>

    </div>

</div>
