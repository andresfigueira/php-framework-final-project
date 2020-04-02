<?php

use function Core\dd;

$nombre = $user['nombre'];
$apellido = $user['apellido'];
$email = $user['email'];
$imagen = $user['imagen'];

?>

<h1 class="lead mb-4 mt-4">Perfil</h1>

<div class="jumbotron p-4 prueba-1 w-full">
    <img src="<?= $imagen ?>" />
    <h1 class="lead mb-4"><?= $nombre ?> <?= $apellido ?></h1>
    <p><?= $email ?></p>
</div>
