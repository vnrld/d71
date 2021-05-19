<?php

declare(strict_types=1);

namespace App\View\Code\Highlighter;

class PHP extends Highlighter
{
    public function __construct(string $codeOrPath)
    {
        parent::__construct($codeOrPath);
        $this->processingVia = file_exists($codeOrPath) ? 'highlight_file' : 'highlight_string';
    }

    public function highlight(bool $return = false)
    {
        $this->formatter();

        if ($return) {
            return $this->processedCode;
        }

        echo $this->processedCode;
    }

    private function formatter()
    {
        $function = $this->processingVia;

        $this->processedCode = $function($this->codeOrPath, true);

        $class = basename($this->theme, '.ini');

        $this->processedCode = str_replace('<code>', '<code class="' . $class . '">', $this->processedCode);

        $code = explode('<br />', $this->processedCode);

        $replacements = [
            ini_get('highlight.comment') => $this->themeConfig['highlight.comment'],
            ini_get('highlight.default') => $this->themeConfig['highlight.default'],
            ini_get('highlight.html') => $this->themeConfig['highlight.html'],
            ini_get('highlight.keyword') => $this->themeConfig['highlight.keyword'],
            ini_get('highlight.string') => $this->themeConfig['highlight.string']
        ];

        foreach ($code as $i => $wartosc) {
            echo strtr(
                '<span class="code-line-number noselect">'
                . ($i + 1) . str_repeat('&#160;', 5) . '</span>' . $wartosc . '<br>' . PHP_EOL,
                $replacements
            );
        }

        $this->processedCode = '';

        //die();


        // $this->convertBrs();
        // $this->convertNbsp();
        // $this->addLines();

    }

    private function convertBrs(): void
    {
        $this->processedCode = (string)preg_replace('/<br\s*\/?>/', PHP_EOL . '<br>', $this->processedCode);
    }

    private function convertNbsp(): void
    {
        $this->processedCode = str_replace('&nbsp;', '&#160;', $this->processedCode);
    }

    private function addLines(): void
    {
        $lines = explode(PHP_EOL, $this->processedCode);


        foreach ($lines as $index => &$line) {
            $line = ($index + 1) . '. ' . $line;
        }

        unset($line);
        $this->processedCode = implode(PHP_EOL, $lines);
    }
}
