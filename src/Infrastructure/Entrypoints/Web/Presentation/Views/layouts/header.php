<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Gastos</title>
    <style>
        /* BASE MINIMALISTA */
        * { box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: #fff;
            margin: 0;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .container { 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 20px; /* Reducido para que no flote tanto */
        }

        /* HEADER LIMPIO - SOLO TÍTULO */
        .card-header-main {
            padding: 40px 0 20px 0;
            border-bottom: 1px solid #f2f2f2;
            margin-bottom: 40px;
        }

        .card-header-main h1 {
            font-weight: 300;
            font-size: 2.2rem;
            margin: 0;
            letter-spacing: -1.5px;
            color: #000;
        }

        /* FORMULARIOS MODERNOS (REUTILIZABLES) */
        .form-control {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-bottom: 1px solid #eee;
            background: transparent;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-control:focus { border-bottom-color: #7d4ec8; }

        /* BOTONES SÓLIDOS */
        .btn-main {
            background: #000;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            letter-spacing: 0.5px;
        }
        .btn-main:hover { background: #333; }

        /* SCROLLBAR DISCRETA */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <header class="card-header-main">
            <h1>Sistema de Gestión</h1>
        </header>