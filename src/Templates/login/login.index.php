<div class="row p-4">
    <div class="col-12 col-md-6 col-lg-4">
        <h1 class="lead mb-4">Iniciar sesión</h1>

        <form method="POST" action="/login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Ingresa email" required value="<?= $loginResponseError['params']['email'] ?>">
                <small class="form-text text-danger"><?= $loginResponseError['errors']['email'] ?></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Ingresa contraseña" required>
                <small class="form-text text-danger"><?= $loginResponseError['errors']['password'] ?></small>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-primary col-12">Iniciar sesión</button>
            </div>
        </form>
    </div>

    <div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
        <h1 class="lead mb-4">Registro</h1>

        <form method="POST" action="/register">
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" name="nombre" placeholder="Ingresa nombre" required value="<?= $registerResponseError['params']['nombre'] ?>">
                <small class="form-text text-danger"><?= $registerResponseError['errors']['nombre'] ?></small>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input class="form-control" name="apellido" placeholder="Ingresa apellido" required value="<?= $registerResponseError['params']['apellido'] ?>">
                <small class="form-text text-danger"><?= $registerResponseError['errors']['apellido'] ?></small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Ingresa email" required value="<?= $registerResponseError['params']['email'] ?>">
                <small class="form-text text-danger"><?= $registerResponseError['errors']['email'] ?></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Ingresa contraseña" required value="<?= $registerResponseError['params']['password'] ?>">
                <small class="form-text text-danger"><?= $registerResponseError['errors']['password'] ?></small>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn btn-success col-12">Registrarse</button>
            </div>
        </form>
    </div>
</div>
