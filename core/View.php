<?php


namespace Core;


class View
{
    protected static string $viewPath;

    public static function init(string $viewPath)
    {
        self::$viewPath = $viewPath;
    }

    // filename = app.home.index
    public static function render(string $filename, array $data = [])
    {
        $pathParts = explode('.', $filename);
        $filePath = self::$viewPath . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';

        ob_start();
        extract($data);
        include $filePath;
        return ob_get_clean();
    }
}