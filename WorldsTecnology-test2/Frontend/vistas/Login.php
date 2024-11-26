<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/style/index.css">
    <title>Login - Sala de Juegos</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Frontend/img/logo.png" alt="Logo Sala de Juegos">
        </div>
        <h2 class="title">Iniciar Sesión</h2>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="index.php?action=login" method="post">
            <div class="input-text">
                <input type="text" name="username" placeholder="identificacion" required>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="submit">
                <button type="submit">Ingresar</button>
            </div>
        </form>

        <!-- Enlace para crear cuenta -->
        <a href="index.php?action=createAccount">Crear cuenta</a>
        <a href="index.php?action=forgotPassword">Olvidé mi contraseña</a>

    </div>
</body>
</html>
