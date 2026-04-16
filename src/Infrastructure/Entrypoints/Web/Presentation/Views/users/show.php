<?php require __DIR__ . '/../layouts/header.php'; ?> 
<?php require __DIR__ . '/../layouts/menu.php'; ?> 

<h1>Detalle de usuario</h1> 

<?php 
// Por si acaso llegamos aquí y hubo un problema cargando los datos, mostramos el aviso
if (!empty($message)): 
?> 
    <div class="alert-error"> 
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?> 
    </div> 
<?php endif; ?> 

<table class="detail-table"> 
    <tr> 
        <th>ID</th> 
        <?php // El ID nunca cambia, así que solo lo pinto tal cual viene de la base de datos ?>
        <td><?= htmlspecialchars($user->getId(), ENT_QUOTES, 'UTF-8') ?></td> 
    </tr> 
    <tr> 
        <th>Nombre</th> 
        <td><?= htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8') ?></td> 
    </tr> 
    <tr> 
        <th>Correo</th> 
        <td><?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8') ?></td> 
    </tr> 
    <tr> 
        <th>Rol</th> 
        <td><?= htmlspecialchars($user->getRole(), ENT_QUOTES, 'UTF-8') ?></td> 
    </tr> 
    <tr> 
        <th>Estado</th> 
        <td><?= htmlspecialchars($user->getStatus(), ENT_QUOTES, 'UTF-8') ?></td> 
    </tr> 
</table> 

<p style="margin-top: 16px;"> 
    <?php /* Si el administrador decide que algo está mal viendo los detalles, 
             este botón lo manda directo al formulario de edición que ya se armo. */ ?>
    <a class="btn btn-warning" href="?route=users.edit&amp;id=<?= urlencode($user->getId()) ?>">Editar</a> 
    &nbsp; 
    <a class="btn" href="?route=users.index">Volver al listado</a> 
</p> 

<?php require __DIR__ . '/../layouts/footer.php'; ?>