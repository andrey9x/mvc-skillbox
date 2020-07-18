<?php


namespace Core;


use Core\Session\SessionHandler;

class App
{
    /** @var string */
    protected static $root;

    /** @var string */
    protected $configPath;
    /** @var string */
    protected $routesPath;

    /** @var array */
    protected $config = [];

    public function __construct()
    {
        self::$root = getcwd();
        $this->configPath = self::$root . '/config/config.php';
        $this->routesPath = self::$root . '/config/routes.php';
    }

    /**
     * @param string $configPath
     * @return App
     */
    public function setConfigPath($configPath): App
    {
        $this->configPath = self::$root . $configPath;
        return $this;
    }

    /**
     * @param string $routesPath
     * @return App
     */
    public function setRoutesPath($routesPath): App
    {
        $this->routesPath = self::$root .$routesPath;
        return $this;
    }

    public function run()
    {
        $this->init()
            ->startSession()
            ->dispatch();
    }

    protected function init()
    {
        // configPath = config/config.php
        $this->config = include $this->configPath;

        set_error_handler([ErrorHandler::class, 'error']);
        set_exception_handler([ErrorHandler::class, 'exception']);

        return $this;
    }

    protected function startSession()
    {
        session_save_path(self::$root . $this->config['app']['session_save_path']);
        session_set_save_handler(new SessionHandler());
        session_start();

        $_SESSION['authorized'] = isset($_SESSION['authorized']) ? $_SESSION['authorized'] : false;

        return $this;
    }

    protected function dispatch()
    {
        return $this;
    }
}