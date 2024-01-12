<?php

class HtmlGenerator
{
    private array $dataTexts;
    private array $dataHtml;
    private array $langs = ['Отпуск' => 'vacation', 'Путь' => 'way'];

    /**
     * @param $dataTexts
     * @param $dataHtml
     */
    public function __construct(array $dataTexts, array $dataHtml)
    {
        $this->dataTexts = $dataTexts;
        $this->dataHtml = $dataHtml;
    }


    /**
     * Генерируем HTML
     * @return string
     */
    public function generateHtml(): string
    {
        $html = '';
        $sizes = array_map('count', $this->dataTexts);
        $maxSize = max($sizes);

        for ($i = 0; $i < $maxSize; $i++) {
            foreach ($this->langs as $key => $lang) {
                if (isset($this->dataTexts[$key][$i]) && isset($this->dataHtml[$lang][$i])) {
                    $text = $this->dataTexts[$key][$i];
                    $tag = $this->dataHtml[$lang][$i];
                    $html .= $this->replaceTagContent($tag, $text);
                }
            }
        }

        return $html;
    }

    /**
     * Вставляем текс в теги
     * @param $template
     * @param $text
     * @return string
     */
    private function replaceTagContent(string $tag, string $text): string
    {
        return str_replace('><', '>' . $text . '<', $tag);
    }
}

$dataTexts = [
    'Отпуск' => [
        'Египет',
        'Турция',
        'Финляндия'
    ],
    'Путь' => [
        'Поезд',
        'Самолет',
        'Автобус'
    ],
];

$dataHtml = [
    'vacation' => [
        '<h1></h1>',
        '<span></span>',
        '<div></div>'
    ],

    'way' => [
        '<h3></h3>',
        '<b></b>',
        '<strong></strong>'
    ],
];

$htmlGenerator = new HtmlGenerator($dataTexts, $dataHtml);
$html = $htmlGenerator->generateHtml();

echo $html;