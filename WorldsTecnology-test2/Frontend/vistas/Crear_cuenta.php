<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/style/index.css">
    <title>Crear Cuenta</title>
</head>
<body>
    <div class="container">
        <div class="logo">
        <img src="Frontend/img/logo.png" alt="Logo Sala de Juegos">
        </div>
        <h2 class="title">Crear Cuenta</h2>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="index.php?action=register" method="post">
            <div class="input-text">
                <input type="text" name="identificacion" placeholder="Identificación" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="text" name="code" placeholder="Codigo de seguridad" required>
            </div>
            <div class="submit">
                <button type="submit">Registrar</button>
            </div>
        </form>
        <div class="back-to-login">
            <a href="index.php?action=login">Volver al login</a>
        </div>
    </div>
</body>
</html>
