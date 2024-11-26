<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/style/index.css">
    <title>Olvidé mi contraseña</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Frontend/img/logo.png" alt="Logo Sala de Juegos">
        </div>
        <h2 class="title">Restablecer Contraseña</h2>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <p style="color: green;"><?= $success ?></p>
        <?php endif; ?>

        <form action="index.php?action=resetPassword" method="post">
            <div class="input-text">
                <input type="text" name="identificacion" placeholder="Identificación" required>
                <input type="text" name="code" placeholder="Codigo de seguridad" required>
                <input type="password" name="password" placeholder="Nueva Contraseña" required>
            </div>
            <div class="submit">
                <button type="submit">Restablecer</button>
            </div>
        </form>

        <!-- Enlace para volver al login -->
        <div class="back-to-login">
            <a href="index.php?action=login">Volver al login</a>
        </div>
    </div>
</body>
</html>
