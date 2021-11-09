<?php
declare(strict_types=1);

namespace Src\Auth;


use SONFin\Models\UserInterface;

interface AuthInterface
{
    public function login(array $credentials): bool;

    public function check(): bool;

    public function logout(): void;
}
