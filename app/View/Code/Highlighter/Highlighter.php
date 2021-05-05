<?php

declare(strict_types=1);

namespace App\View\Code\Highlighter;

abstract class Highlighter
{
    protected string $codeOrPath;

    protected string $processingVia;

    protected string $theme;

    protected string $themeDir;

    protected array $themeConfig = [];

    protected string $processedCode;

    /**
     * Highlighter constructor.
     * @param string $codeOrPath
     */
    public function __construct(string $codeOrPath)
    {
        $this->codeOrPath = $codeOrPath;
        $this->themeDir = __DIR__ . '/themes/' . strtolower(
                (new \ReflectionClass(static::class))->getShortName()
            ) . '/';
        $this->setTheme('default.ini');
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     * @return Highlighter
     */
    public function setTheme(string $theme): Highlighter
    {
        $this->theme = $this->themeDir . $theme;
        $this->themeConfig = parse_ini_file($this->theme);
        return $this;
    }


    public abstract function highlight();
}
