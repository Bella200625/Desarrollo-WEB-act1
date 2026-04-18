<style>
    body { font-family: 'Inter', 'Segoe UI', sans-serif; color: #1a1a1a; padding: 40px; }
    h2 { font-weight: 300; font-size: 2.2rem; margin-bottom: 5px; }
    .subtitle { color: #888; font-size: 0.9rem; margin-bottom: 30px; }
    
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; font-size: 0.7rem; text-transform: uppercase; color: #aaa; border-bottom: 1px solid #000; padding: 10px 0; }
    td { padding: 18px 0; border-bottom: 1px solid #f4f4f4; font-size: 0.95rem; }
    
    .monto-total { font-weight: bold; color: #000; }
    .nav a { text-decoration: none; color: #7d4ec8; font-weight: bold; font-size: 0.8rem; margin-right: 20px; }
    .action { text-decoration: none; font-size: 0.7rem; font-weight: bold; margin-left: 12px; }
</style>

<main>
    <div class="nav">
        <a href="?route=home">INICIO</a>
        <a href="?route=gastos.create">NUEVO GASTO</a>
    </div>

    <h2>Gastos</h2>
    <p class="subtitle">Registros actuales en el sistema</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Servicio</th>
                <th>Lugar</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th style="text-align: right;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $gasto): ?>
                <tr>
                    <td><?= $gasto['fecha'] ?></td>
                    <td style="color: #7d4ec8;"><?= $gasto['tipo_servicio'] ?></td>
                    <td><?= $gasto['lugar'] ?></td>
                    <td>$<?= number_format((float)$gasto['monto_sin_iva'], 2, ',', '.') ?></td>
                    <td style="color: #ccc;">$<?= number_format((float)$gasto['iva'], 2, ',', '.') ?></td>
                    <td class="monto-total">$<?= number_format((float)$gasto['monto_total'], 2, ',', '.') ?></td>
                    <td style="text-align: right;">
                        <a href="?route=gastos.edit&id=<?= $gasto['id'] ?>" class="action" style="color: #cca300;">EDITAR</a>
                        <a href="?route=gastos.delete&id=<?= $gasto['id'] ?>" class="action" style="color: #ff4d4d;" onclick="return confirm('¿Borrar?')">BORRAR</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>