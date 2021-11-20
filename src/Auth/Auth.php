<?php
declare(strict_types=1);

namespace Src\Auth;


class Auth implements AuthInterface
{
    private JasnyAuth $jasnyAuth;

    public function __construct(JasnyAuth $jasnyAuth)
    {
        $this->jasnyAuth = $jasnyAuth;
    }

    public function login(array $credentials): bool
    {
        [
            'email' => $email,
            'password' => $password
        ] = $credentials;

        $ret = $this->jasnyAuth->login($email,$password) !== null;

        return $ret;
    }

    public function check(): bool
    {
        return false;
    }

    public function logout(): void
    {

    }

    public function hashPassword(string $password): string
    {
        $ret = $this->jasnyAuth->hashPassword($password);

        return $ret;
    }
}
