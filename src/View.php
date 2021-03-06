<?php


namespace Quiz;


class View
{
    protected $viewFile;

    protected $templateFile;

    /** @var string */
    public $js;
    /** @var string[] */
    public $jsFiles = [];
    /** @var string[] */
    public $cssFiles = [];

    public function __construct(string $viewName, string $templateName)
    {
        $this->viewFile = $this->getViewFilePath($viewName);
        $this->templateFile = $this->getViewFilePath($templateName, TEMPLATE_BASE_FOLDER);
    }

    protected function getViewFilePath(string $viewName, string $baseDir = VIEW_BASE_FOLDER)
    {
        return $baseDir . DS . $viewName . '.php';
    }

    public function render(array $params = []): string
    {
        return $this->getFileContents($this->templateFile, $params);
    }

    public function renderContent(array $params = []): string
    {
        return $this->getFileContents($this->viewFile, $params);
    }

    public function renderView(string $viewName, array $params = [])
    {
        $filePath = $this->getViewFilePath($viewName);
        return $this->getFileContents($filePath, $params);
    }

    protected function getFileContents(string $fileName, array $params = [])
    {
        extract($params);
        $content = '';

        if (!empty($fileName) && file_exists($fileName)) {
            ob_start();
            include "$fileName";
            $content = ob_get_clean();
        }

        return $content;
    }


    public function registerjs(string $js)
    {
        $this->js .= $js;
    }

    public function registerJsFile(string $fileName)
    {
        $this->jsFiles[] = $fileName;
    }

    public function registerCssFile(string $fileName)
    {
        $this->cssFiles[] = $fileName;
    }



}