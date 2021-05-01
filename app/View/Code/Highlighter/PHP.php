<?php

declare(strict_types=1);

namespace App\View\Code\Highlighter;

class PHP extends Highlighter
{
    public function __construct(string $codeOrPath)
    {
        parent::__construct($codeOrPath);
        $this->processingVia = file_exists($codeOrPath) ? 'highlight_file': 'highlight_string';
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
        $this->convertBrs();
        $this->convertNbsp();
        // $this->addLines();

    }

    private function convertBrs(): void
    {
        $this->processedCode = (string)preg_replace('/<br\s*\/?>/', PHP_EOL . '<br>', $this->processedCode);
    }

    private function convertNbsp() : void
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
