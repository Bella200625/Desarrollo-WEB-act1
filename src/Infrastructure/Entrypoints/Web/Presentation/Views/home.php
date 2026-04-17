<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/menu.php'; ?>

<h1>Menú principal del CRUDL de usuarios</h1>
<p>Desde aquí podrás acceder a las operaciones del sistema.</p>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if ($authUser && $authUser['role'] === 'ADMIN'): ?>
    <h2>Gestión de Usuarios (CRUDL)</h2>    
    <ul>
        <li><strong>C:</strong> Registrar usuario</li>
        <li><strong>R:</strong> Consultar usuario</li>
        <li><strong>U:</strong> Actualizar usuario</li>
        <li><strong>D:</strong> Eliminar usuario</li>
        <li><strong>L:</strong> Listar usuarios</li>
    </ul>
<?php else: ?>
    <div style="background: #eef9ff; padding: 20px; border-radius: 8px; border: 1px solid #b6d4fe;">
        <h3>¡Bienvenido, <?= htmlspecialchars($authUser['name'] ?? 'Usuario') ?>!</h3>
        <p>Desde aquí vas a poder registrar tus gastos de luz, de gas o de agua. Pero primero </p>
        <p style="color: hsl(268, 57%, 73%); font-style: italic;">Próximamente: Módulo de gestión de servicios públicos.</p>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/layouts/footer.php'; ?>