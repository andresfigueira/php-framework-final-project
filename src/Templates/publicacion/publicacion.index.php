<div class="p-4">
    <h3>Publicaciones</h3>

    <form method="GET" action="/">
        <div class="flex flex-col sm:flex-row sm:items-center">
            <div>
                <input class="form-control" name="busqueda" placeholder="Búsqueda" value="<?= $_GET['busqueda'] ?>">
            </div>

            <div class="w-full my-2 sm:ml-2 sm:my-0 sm:w-auto">
                <button type="submit" class="btn btn-success w-full">Buscar</button>
            </div>
        </div>
    </form>

    <?php
    foreach ($publicaciones as $publicacion) {
        include dirname(__FILE__) . '/components/publicacion.php';
    }

    if (empty($publicaciones)) {
    ?>
        <h6 class="lead mt-2">No se encontraron publicaciones.</h6>
    <?php
    }
    ?>
</div>
