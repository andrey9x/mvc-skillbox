<?php


namespace Core;


use Core\Http\Request;
use Core\Http\Router;
use Core\Session\SessionHandler;

class App
{
    protected static string $root;

    protected string $configPath;
    protected string $routesPath;

    protected array $config = [];

    protected ?Request $request = null;

    public function __construct()
    {
        self::$root = getcwd();
        $this->configPath = self::$root . '/config/config.php';
        $this->routesPath = self::$root . '/config/routes.php';
    }

    public function setConfigPath(string $configPath): App
    {
        $this->configPath = self::$root . $configPath;
        return $this;
    }

    public function setRoutesPath(string $routesPath): App
    {
        $this->routesPath = self::$root .$routesPath;

        return $this;
    }

    public function run()
    {
        $response = $this->init()
            ->startSession()
            ->dispatch();

        $this->terminate($response);
    }

    protected function init(): App
    {
        // configPath = config/config.php
        $this->config = include $this->configPath;

        $this->request = Request::init();
        Router::setRoutes($this->routesPath);

        set_error_handler([ErrorHandler::class, 'error']);
        set_exception_handler([ErrorHandler::class, 'exception']);

        return $this;
    }

    protected function startSession(): App
    {
        session_save_path(self::$root . $this->config['app']['session_save_path']);
        session_set_save_handler(new SessionHandler());
        session_start();

        $_SESSION['authorized'] = isset($_SESSION['authorized']) ? $_SESSION['authorized'] : false;

        return $this;
    }

    protected function dispatch()
    {
        return Router::dispatch($this->request);
    }

    protected function terminate($response)
    {
        exit($response);
    }
}