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
    <h3>Gestión de Usuarios (CRUDL)</h3>    
    <ul>
        <li><strong>C:</strong> Registrar usuario</li>
        <li><strong>R:</strong> Consultar usuario</li>
        <li><strong>U:</strong> Actualizar usuario</li>
        <li><strong>D:</strong> Eliminar usuario</li>
        <li><strong>L:</strong> Listar usuarios</li>
    </ul>
<?php else: ?>
    <div style="background: #e1cff8; padding: 20px; border-radius: 8px; border: 1px solid #a79ef7;">
        <h1>¡Bienvenida, <?= htmlspecialchars($authUser['name'] ?? 'Usuario') ?>!</h1>
        <p>Hoy es un buen día para organizar tus gastos.</p>
        
        <div style="margin-top: 20px;">
            <a href="?route=gastos.index" style="background: #9500a8; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;">
                Ver mi Tablero de Gastos
            </a>
        </div>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/layouts/footer.php'; ?>