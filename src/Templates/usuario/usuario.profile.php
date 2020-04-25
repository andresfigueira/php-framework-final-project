<?php

use function Core\dd;

$nombre = $_SESSION['user']['nombre'];
$apellido = $_SESSION['user']['apellido'];
$email = $_SESSION['user']['email'];
$imagen = $_SESSION['user']['imagen'];

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
        <div class="ml-2">
            <h1 class="lead mb-4"><?= $nombre ?> <?= $apellido ?></h1>
            <div class="flex flex-col items-center sm:justify-between sm:flex-row">
                <p><?= $email ?></p>
            </div>
            <div>
                <a class="btn btn-primary btn-sm items-end" href="mailto:<?= $email ?>" role="button">Contactar</a>
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

<?php
if ($showPublicaciones) {
    // Publicaciones
    foreach ((array) $publicaciones as $publicacion) {
        include dirname(__FILE__) . '/../publicacion/components/publicacion.php';
    }

    if (empty($publicaciones)) {
?>
        <h6 class="lead mt-2">No se encontraron publicaciones.</h6>
    <?php
    }
} else if ($showAnimales) {
    //  Animales
    foreach ((array) $animales as $animal) {
        include dirname(__FILE__) . '/../animal/components/animal.php';
    }

    if (empty($animales)) {
    ?>
        <h6 class="lead mt-2">No se encontraron animales.</h6>
<?php
    }
}

?>
