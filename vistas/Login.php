<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Login - Sala de Juegos</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="path/to/logo.png" alt="Logo Sala de Juegos">
        </div>
        <h2 class="title">Iniciar Sesión</h2>
        
        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="index.php?action=login" method="post">
            <div class="input-text">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="submit">
                <button type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</body>
</html>
