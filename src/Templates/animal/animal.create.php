<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4">
        <h1 class="lead mb-4">Crear nuevo animal</h1>

        <form method="POST" action="/animales/crear">
            <div class="form-group">
                <label>Nombre*</label>
                <input class="form-control" name="nombre_animal" placeholder="Ingresa el nombre" required value="<?= $responseError['params']['nombre_animal'] ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['nombre_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Descripción*</label>
                <input class="form-control" name="descripcion" placeholder="Ingresa una descripción" required value="<?= $responseError['params']['descripcion'] ?>">
                <small class="form-text text-danger"><?= $responseError['errors']['descripcion'] ?></small>
            </div>
            <div class="form-group">
                <label>Fecha de nacimiento</label>
                <input value="" type="date" class="form-control" name="fecha_nacimiento_animal">
                <small class="form-text text-danger"><?= $responseError['errors']['fecha_nacimiento_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Tipo*</label>
                <select class="form-control" name="tipo_animal" placeholder="Selecciona un animal" required value="<?= $responseError['params']['tipo_animal'] ?>">
                <option value="" selected>Selecciona un animal</option>
                    <?php foreach ($tipoAnimalOptions as $tipoAnimalOption) { ?>
                        <option value="<?= $tipoAnimalOption['id'] ?>"><?= $tipoAnimalOption['nombre'] ?></option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['tipo_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Raza</label>
                <select class="form-control" name="raza_animal" placeholder="Selecciona una raza">
                <option value="" selected>Selecciona una raza</option>
                    <?php foreach ($razaAnimalOptions as $razaAnimalOption) { ?>
                        <option value="<?= $razaAnimalOption['id'] ?>"><?= $razaAnimalOption['nombre'] ?></option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['raza_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Sexo</label>
                <select class="form-control" name="sexo_animal" placeholder="Selecciona el sexo">
                <option value="" selected>Selecciona el sexo</option>
                    <?php foreach ($sexoAnimalOptions as $sexoAnimalOption) { ?>
                        <option value="<?= $sexoAnimalOption['id'] ?>"><?= $sexoAnimalOption['nombre'] ?></option>
                    <?php } ?>
                </select>
                <small class="form-text text-danger"><?= $responseError['errors']['raza_animal'] ?></small>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="url" class="form-control" name="imagen" placeholder="Copia la url de la fotografía">
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Crear animal</button>
            </div>
        </form>
    </div>
</div>