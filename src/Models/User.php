<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

/**
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $email
 * @property mixed $password
 * @property mixed $id
 */
class User extends Model implements JasnyUser, UserInterface
{
    protected $table = "users";

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at',
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

    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}