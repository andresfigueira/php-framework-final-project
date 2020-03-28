<?php

namespace Core;

class Redirect
{
    private $url;

    public function __construct($url)
    {

        $this->url = $url;
        $this->redirect();
    }

    public function redirect()
    {
        header("Location: $this->url");
    }
}
