<?php
declare(strict_types=1);

namespace Src\Auth;


use Src\Models\UserInterface;

class Auth implements AuthInterface
{
    private JasnyAuth $jasnyAuth;

    /**
     * @param JasnyAuth $jasnyAuth
     */
    public function __construct(JasnyAuth $jasnyAuth)
    {
        $this->jasnyAuth = $jasnyAuth;
        $this->sessionStart();
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
        return $this->user() != null;
    }

    public function logout(): void
    {
        $this->jasnyAuth->logout();
    }

    public function user(): ?UserInterface
    {
        return $this->jasnyAuth->user();
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

    protected function sessionStart(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
