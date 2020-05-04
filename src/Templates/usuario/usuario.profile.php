<?php

use function Core\dd;

$nombre = $_SESSION['user']['nombre'];
$apellido = $_SESSION['user']['apellido'];
$email = $_SESSION['user']['email'];
$imagen = $_SESSION['user']['imagen'];
$direccion = $_SESSION['user']['direccion'];
$provincia = $_SESSION['user']['provincia'];
$telefono_1 = $_SESSION['user']['telefono_1'];
$telefono_2 = $_SESSION['user']['telefono_2'];

$showAnimales = $_GET['animales'] == 1;
$showPublicaciones = !$showAnimales;

?>

<?php if ($responseSuccess['message']) { ?>
    <div class="alert alert-success mt-5" role="alert">
        <?= $responseSuccess['message'] ?>
    </div>
<?php } ?>

<div class="flex flex-col items-center sm:flex-row sm:justify-between">
    <h1 class="lead mb-4 mt-4">Perfil</h1>
    <a class="btn btn-primary btn-sm" href="/perfil/editar" role="button">Editar</a>
</div>

<div class="jumbotron p-4 w-full">
    <div class="flex flex-col sm:flex-row">
        <div class="w-full h-full sm:w-64">
            <img src="<?= $imagen ?>" />
        </div>
        <div class="ml-2 w-full">
            <h1 class="lead mb-4"><?= $nombre ?> <?= $apellido ?></h1>
            <p><?= $email ?></p>


            <p><?= $direccion ? "$provincia, $direccion" : $provincia ?></p>
            <small><?= $telefono_1 ?></small>
            <small><?= $telefono_2 ?></small>
            <div class="w-full">
                <a class="btn btn-primary btn-sm float-right" href="mailto:<?= $email ?>" role="button">Contactar</a>
            </div>
        </div>
    </div>
</div>

<ul class="navbar-nav flex flex-row">
    <li class="nav-item">
        <a class="nav-link" href="/perfil?publicaciones=1">Publicaciones</a>
    </li>
    <li class="nav-item ml-3">
        <a class="nav-link" href="/perfil?animales=1">Animales</a>
    </li>
</ul>

<?php if ($showPublicaciones) { ?>
    <a class="btn btn-primary btn-sm mb-2" href="/publicaciones/crear" role="button">Crear publicación</a>

    <?php
    // Publicaciones
    foreach ((array) $publicaciones as $publicacion) {
        include dirname(__FILE__) . '/../publicacion/components/publicacion.php';
    }

    if (empty($publicaciones)) { ?>
        <h6 class="lead">No se encontraron publicaciones.</h6>
    <?php
    }
} else if ($showAnimales) { ?>
    <a class="btn btn-primary btn-sm mb-2" href="/animales/crear" role="button">Crear animal</a>

    <?php
    //  Animales
    foreach ((array) $animales as $animal) {
        include dirname(__FILE__) . '/../animal/components/animal.php';
    }

    if (empty($animales)) {
    ?>
        <h6 class="lead">No se encontraron animales.</h6>
<?php
    }
}

?>
