<?php
declare(strict_types=1);

final class View 
{
    /**
     * Renderiza una plantilla PHP pasando datos opcionales.
     */
    public static function render(string $template, array $data = array()): void 
    {
        // Construye la ruta hacia la carpeta 'Views' que debe estar al mismo nivel
        $file = __DIR__ . '/Views/' . $template . '.php';

        if (!file_exists($file)) {
            throw new RuntimeException('Vista no encontrada: ' . $template);
        }

        // Convierte las llaves del array en variables 
        extract($data);
        require $file;
    }

    /**
     * Redirige a una ruta específica usando el parámetro del sistema.
     */
    public static function redirect(string $route): void 
    {
        header('Location: ?route=' . urlencode($route));
        exit;
    }
}