<?php

use Core\Navigation;
use Core\Router;
use Helpers\GeneralHelper;

$navigation = new Navigation();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand pl-4" href="/">AnimalCare</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php
            foreach ($navigation->getItems() as $item) {
                $label = $item['label'];
                $url = $item['url'];
                $auth = $item['auth'];
                $active = Router::currentUrl() === $url ? 'active' : '';
            ?>
                <li class="nav-item <?= $active ?>">
                    <a class="nav-link" href="<?= $url ?>"><?= $label ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>
