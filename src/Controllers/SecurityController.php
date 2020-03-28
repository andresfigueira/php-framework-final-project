<?php

namespace Controllers;

use Core\Redirect;
use Core\Response;
use Repository\UserRepository;

use function Core\dd;

class SecurityController extends DatabaseController
{
    private bool $isLoggedIn;
    private array $user;

    public function __construct()
    {
        session_start();

        $this->setIsLoggedIn(false);

        $this->checkSession();
    }

    private function checkSession(): void
    {
        if (isset($_SESSION['user'])) {
            $this->setIsLoggedIn(true);
        }
    }

    public function storeSession(): void
    {
        session_unset();

        $_SESSION['user'] = $this->user;

        $this->setIsLoggedIn(true);
    }

    public function destroySession(): void
    {
        session_start();
        session_unset();
        session_destroy();

        $this->setIsLoggedIn(false);
    }

    private function setIsLoggedIn(bool $isLoggedIn): self
    {
        $this->isLoggedIn = $isLoggedIn;

        return $this;
    }

    public static function isLoggedIn(): bool
    {
        $security = new SecurityController();

        return $security->isLoggedIn;
    }

    public function setUser(array $user): self
    {
        $this->user = $user;

        return $this;
    }

    public static function encryptPassword(String $password): String
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword(String $password, String $hash): String
    {
        if (!$password || !$hash) {
            return false;
        }

        return password_verify($password, $hash);
    }
}
