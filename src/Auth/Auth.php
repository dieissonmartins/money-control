<?php
declare(strict_types=1);

namespace Src\Auth;


class Auth implements AuthInterface
{
    private JasnyAuth $jasnyAuth;

    /**
     * @param JasnyAuth $jasnyAuth
     */
    public function __construct(JasnyAuth $jasnyAuth)
    {
        $this->jasnyAuth = $jasnyAuth;
    }

    /**
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        [
            'email' => $email,
            'password' => $password
        ] = $credentials;

        $ret = $this->jasnyAuth->login($email, $password) !== null;

        return $ret;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        return false;
    }

    public function logout(): void
    {

    }

    /**
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        $ret = $this->jasnyAuth->hashPassword($password);

        return $ret;
    }
}
