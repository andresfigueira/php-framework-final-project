<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4">
        <h1 class="lead mb-4">Subir una publicación</h1>

        <form method="POST" action="/publicacion/crear">
            <div class="form-group">
                <label>Titulo*</label>
                <input class="form-control" name="titulo" placeholder="Ingresa un título" required value="<?= $responseError['params']['titulo_publ'] ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['titulo_publ'] ?></small>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <input class="form-control" name="descripcion" placeholder="Ingresa una descripción">
                <small class="form-text text-danger"><?= $responseError['errors']['descripcion_publ'] ?></small>
            </div>
            <div class="form-group">
                <label>Referencia</label>
                <input class="form-control" name="referencia" placeholder="Referencia????">
                <small class="form-text text-danger"><?= $responseError['errors']['referencia_publ'] ?></small>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input class="form-control" name="direccion" placeholder="Tu dirección">
                <small class="form-text text-danger"><?= $responseError['errors']['direccion'] ?></small>
            </div>
            <div class="form-group">
            <div class="form-group">
                <label>Provincia</label>
                <select class="form-control" name="provincia_id" placeholder="Selecciona la provincia">
                <option value="" selected>Selecciona la provincia</option>
                    <?php foreach ($provinciaOptions as $provinciaOption) { ?>
                        <option value="<?= $provinciaOption['id'] ?>"><?= $provinciaOption['nombre'] ?></option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['provincia'] ?></small>
            </div>
            <div class="form-group">
                <label>Animal*</label>
                <select class="form-control" name="animal_id" placeholder="Selecciona el animal">
                <option value="" selected>Selecciona el animal</option>
                    <?php foreach ($animalOptions as $animalOption) { ?>
                        <option value="<?= $animalOption['id'] ?>"><?= $animalOption['nombre'] ?></option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['animal_id'] ?></small>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Publicar</button>
            </div>
        </form>
    </div>
</div>