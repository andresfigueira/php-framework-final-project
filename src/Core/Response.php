<?php

namespace Core;

class Response
{
    private $templatePath;
    private $variables;
    private $baseTemplateFullPath;

    public function __construct($templatePath, $variables = array())
    {
        $this->setTemplatePath($templatePath);
        $this->setVariables($variables);
        $this->setBaseTemplateFullPath(TEMPLATES_PATH . "/base/base.index.php");
        $this->render();
    }

    public function render()
    {
        $templatePath = $this->getTemplatePath();
        $variables = $this->getVariables();
        $baseTemplateFullPath = $this->getBaseTemplateFullPath();
        // Sera renderizado en la base template
        $__templateFullPath = TEMPLATES_PATH . "/" . $templatePath;

        if (!empty($variables)) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }

        if (file_exists($__templateFullPath)) {
            require_once($baseTemplateFullPath);
        } else {
            // TODO:
            // Create error page
            die($templatePath . ' not found.');
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

    public function getBaseTemplateFullPath(): String
    {
        return $this->baseTemplateFullPath;
    }

    public function setBaseTemplateFullPath($baseTemplateFullPath): self
    {
        $this->baseTemplateFullPath = $baseTemplateFullPath;

        return $this;
    }
}
