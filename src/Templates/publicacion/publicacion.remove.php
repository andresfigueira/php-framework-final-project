<?php

use function Core\dd;
use Repository\PublicacionRepository;

$id = $_GET['id'];
$publicacion = PublicacionRepository::findById($id);

?>

<div class="row p-4">
    <div class="col-18 col-md-6 col-lg-4 mt-4 mt-md-0">
        <h1 class="lead mb-4">Borrar publicacion</h1>

        <div>
            <div>
                <h6 class="lead mb-4">¿Estás seguro? Esta acción no se puede deshacer</h6>
            </div>
            
            <div class="flex justify-start">
                <form method="POST" action="/publicaciones/borrar">
                    <div>
                        <input type="hidden" name="publicacion_id" value="<?= $id ?>">
                    </div>
                    <div class="mx-4">
                        <button type="submit" class="btn btn-primary col-12 mr-2">Aceptar</a>
                    </div>
                </form>
                <div>
                    <a class="btn btn-primary col-12 mr-2" href="/" role="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
