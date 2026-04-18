<style>
    /* Estilo minimalista - Letras bonitas */
    body { 
        font-family: 'Inter', -apple-system, sans-serif; 
        color: #1a1a1a; 
        padding: 60px 20px; 
        line-height: 1.6;
        background-color: #fff;
    }
    main { max-width: 450px; margin: 0 auto; }
    
    h2 { font-weight: 300; font-size: 2rem; margin-bottom: 5px; letter-spacing: -0.5px; }
    .subtitle { color: #888; font-size: 0.9rem; margin-bottom: 40px; }

    .form-group { margin-bottom: 30px; }
    
    /* Labels minimalistas en gris */
    label { 
        display: block; 
        font-size: 0.7rem; 
        text-transform: uppercase; 
        color: #bbb; 
        font-weight: 700; 
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    /* Inputs limpios, solo con línea inferior */
    input, textarea { 
        width: 100%; 
        padding: 10px 0; 
        border: none; 
        border-bottom: 1px solid #eee; 
        font-size: 1rem; 
        color: #333;
        outline: none; 
        transition: border-color 0.3s ease;
        background: transparent;
    }
    input:focus { border-bottom-color: #7d4ec8; }

    /* Botón principal sólido */
    .btn-save { 
        background: #000; 
        color: #fff; 
        border: none; 
        padding: 15px; 
        width: 100%; 
        font-weight: 600; 
        font-size: 0.9rem;
        cursor: pointer; 
        margin-top: 20px;
        letter-spacing: 0.5px;
    }
    .btn-save:hover { background: #333; }

    .btn-cancel { 
        display: block; 
        text-align: center; 
        margin-top: 20px; 
        color: #ff4d4d; 
        text-decoration: none; 
        font-size: 0.75rem; 
        font-weight: 700; 
        text-transform: uppercase;
    }
</style>

<main>
    <h2>Editar Gasto</h2>
    <p class="subtitle">Modifica los detalles del registro seleccionado</p>
    
    <form action="?route=gastos.update" method="POST">
        <input type="hidden" name="id" value="<?= $gasto['id'] ?>">>

        <div class="form-group">
            <label>Fecha del gasto</label>
            <input type="date" name="fecha" value="<?= htmlspecialchars($gasto['fecha']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tipo de Servicio</label>
            <input type="text" name="tipo_servicio" value="<?= htmlspecialchars($gasto['tipo_servicio']) ?>" required>
        </div>

        <div class="form-group">
            <label>Lugar / Establecimiento</label>
            <input type="text" name="lugar" value="<?= htmlspecialchars($gasto['lugar']) ?>" required>
        </div>

        <div class="form-group">
            <label>Monto Base (Sin IVA)</label>
            <input type="number" step="0.01" name="monto_sin_iva" value="<?= htmlspecialchars((string)$gasto['monto_sin_iva']) ?>" required>
        </div>

        <div class="form-group">
            <label>Notas adicionales</label>
            <textarea name="descripcion" rows="2"><?= htmlspecialchars($gasto['descripcion'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn-save">ACTUALIZAR REGISTRO</button>
        <a href="?route=gastos.index" class="btn-cancel">Cancelar cambios</a>
    </form>
</main>