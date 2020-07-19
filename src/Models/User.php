<?php


namespace App\Models;


class User extends \Core\Database\Model
{
    public int $id;
    public string $name;
    public int $age;

    protected static function table(): string
    {
        return 'users';
    }
}