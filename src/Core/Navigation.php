<?php

namespace Core;

use Controllers\SecurityController;

class Navigation extends SecurityController
{
    public array $items;

    public function __construct()
    {
        $items = [
            [
                'label' => 'Publicaciones',
                'url' => '/',
                'auth' => false,
            ],
            [
                'label' => 'Mis publicaciones',
                'url' => '/perfil?publicaciones=1',
                'auth' => true,
            ],
            [
                'label' => 'Mis animales',
                'url' => '/perfil?animales=1',
                'auth' => true,
            ],
            [
                'label' => 'Quiénes somos',
                'url' => '/quienes-somos',
                'auth' => false,
                'hideOnAuth' => true,
            ],
            [
                'label' => 'Perfil',
                'url' => '/perfil',
                'auth' => true,
            ],
            [
                'label' => 'Contacto',
                'url' => 'mailto:andresfigueiram@gmail.com;javierlaso213@gmail.com',
                'auth' => false,
            ],
            [
                'label' => 'Acceder',
                'url' => '/acceder',
                'auth' => false,
                'hideOnAuth' => true,
            ],
            [
                'label' => 'Cerrar sesión',
                'url' => '/cerrar-sesion',
                'auth' => true,
            ],
        ];

        $items = $this->filterItems($items);

        $this->setItems($items);
    }

    public function filterItems(array $items): array
    {
        $filteredNavigation = [];

        foreach ($items as $item) {
            $needsAuth = $item['auth'] && !SecurityController::isLoggedIn();
            $hideOnAuth = $item['hideOnAuth'] && SecurityController::isLoggedIn();

            if ($needsAuth || $hideOnAuth) {
                continue;
            }

            array_push($filteredNavigation, $item);
        }

        return $filteredNavigation;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
