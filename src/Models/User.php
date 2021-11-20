<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser
{
    protected $table = "users";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    public function getId(): int
    {
        $ret = (int)$this->id;
        return $ret;
    }

    public function getUsername(): string
    {
        $ret = $this->email;
        return $ret;
    }

    public function getHashedPassword(): string
    {
        $ret = $this->password;
        return $ret;
    }

    public function onLogin()
    {
        // TODO: Implement onLogin() method.
    }

    public function onLogout()
    {
        // TODO: Implement onLogout() method.
    }
}