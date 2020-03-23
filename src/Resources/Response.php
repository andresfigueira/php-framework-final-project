<?php

namespace Resources;

class Response
{
    protected $templatePath;
    protected $variables;

    public function __construct($templatePath, $variables = array())
    {
        $this->setTemplatePath($templatePath);
        $this->setVariables($variables);
        $this->render();
    }

    public function render()
    {
        $templatePath = $this->getTemplatePath();
        $variables = $this->getVariables();
        $templateFullPath = TEMPLATES_PATH . "/" . $templatePath;

        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }

        if (file_exists($templateFullPath)) {
            require_once($templateFullPath);
        } else {
            /*
            If the file isn't found the error can be handled in lots of ways.
            In this case we will just include an error template.
        */
            // TODO:
            // Create error page
            var_dump($templatePath . ' not found.');
            // require_once(TEMPLATES_PATH . "/error.php");
        }
    }

    public function getTemplatePath(): String
    {
        return $this->templatePath;
    }

    public function setTemplatePath($templatePath): self
    {
        $this->templatePath = $templatePath;

        return $this;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables($variables): self
    {
        $this->variables = $variables;

        return $this;
    }
}
