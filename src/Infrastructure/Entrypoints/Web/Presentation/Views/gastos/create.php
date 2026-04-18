<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<main class="container">
    <div class="custom-card" style="max-width: 550px; margin: 40px auto;">
        <div class="card-header-main">
            <h2 style="margin:0;">Registrar Nuevo Gasto</h2>
            <p style="margin:5px 0 0; opacity:0.9; font-size:0.85rem;">Ingresa los datos de tu factura</p>
        </div>

        <form action="?route=gastos.store" method="POST" style="padding: 30px;">
            <div style="margin-bottom: 20px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px; color:#666; font-size:0.8rem;">TIPO DE SERVICIO</label>
                <select name="tipo_servicio" class="form-control" required>
                    <?php foreach (GastoServicioTipoEnum::values() as $tipo): ?>
                        <option value="<?= $tipo ?>"><?= $tipo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display:block; font-weight:bold; margin-bottom:5px; color:#666; font-size:0.8rem;">MONTO NETO ($)</label>
                    <input type="number" name="monto_sin_iva" class="form-control" step="0.01" required>
                </div>
                <div style="flex: 1;">
                    <label style="display:block; font-weight:bold; margin-bottom:5px; color:#666; font-size:0.8rem;">FECHA FACTURA</label>
                    <input type="date" name="fecha" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px; color:#666; font-size:0.8rem;">EMPRESA / LUGAR</label>
                <input type="text" name="lugar" class="form-control" placeholder="Ej: Afinia, Surtigas..." required>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px; color:#666; font-size:0.8rem;">DESCRIPCIÓN</label>
                <textarea name="descripcion" class="form-control" rows="2" placeholder="Ej: Pago mes de abril..."></textarea>
            </div>

            <button type="submit" class="btn-main">GUARDAR GASTO</button>
            
            <div style="text-align:center; margin-top:15px;">
                <a href="?route=gastos.index" style="color:#999; text-decoration:none; font-size:0.85rem;">Cancelar y volver</a>
            </div>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>