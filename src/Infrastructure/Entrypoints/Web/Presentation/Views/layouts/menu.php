<?php declare(strict_types=1); ?>
<?php $authUser = $_SESSION['auth'] ?? null; ?>

<nav>
    <a href="?route=home">Inicio</a>
    
    <?php if ($authUser): ?>
        <?php if ($authUser['role'] === 'ADMIN'): ?>
            <span style="margin: 0 10px; color:#555;">|</span>
            <a href="?route=users.create">Registrar usuario</a>
            <a href="?route=users.index">Listar Usuarios</a>
        <?php endif; ?>
    
    
        <span style="margin: 0 10px; color:#555;">|</span>
        <span style="color:#333;">👤 <?= htmlspecialchars($authUser['name'], ENT_QUOTES, 'UTF-8') ?></span> &nbsp;
        <a href="?route=auth.logout">Cerrar sesión</a>
    <?php else: ?>
        <a href="?route=auth.login">Iniciar sesión</a>
        
        <span style="margin: 0 5px; color:#555;">|</span>
        <a href="?route= users.create" style="font-weight: bold; color: #c185e4;">Registrarse</a>
        
        <a href="?route=auth.forgot">Recuperar contraseña</a>
    <?php endif; ?>
</nav>

<hr>