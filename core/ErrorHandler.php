<?php


namespace Core;


class ErrorHandler
{
    public static function error($code, $message, $filename, $lineno)
    {
        throw new \ErrorException($message, $code, 1, $filename, $lineno);
    }

    public static function exception(\Throwable $exception)
    {
        exit("<pre>$exception</pre>");
    }
}