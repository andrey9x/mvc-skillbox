<?php


namespace Core\Session;


use Core\App;

class SessionHandler implements \SessionHandlerInterface
{
    /** @var string */
    protected $savePath = '';

    /**
     * @inheritDoc
     */
    public function close()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($session_id)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @inheritDoc
     */
    public function gc($maxlifetime)
    {
        // TODO: Implement gc() method.
    }

    /**
     * @inheritDoc
     */
    public function open($save_path, $name)
    {
        $this->savePath = $save_path;
        if (!dir($this->savePath)) {
            mkdir($this->savePath, 0777, true);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($session_id)
    {
        $file = $this->savePath . DIRECTORY_SEPARATOR . $session_id;
        if (!file_exists($file)) {
            touch($file);
        }

        return file_get_contents($file);
    }

    /**
     * @inheritDoc
     */
    public function write($session_id, $session_data)
    {
        return file_put_contents($this->savePath . DIRECTORY_SEPARATOR . $session_id, $session_data) !== false;
    }
}