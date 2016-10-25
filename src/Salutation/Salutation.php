<?php
namespace Salutation;

define('SALUTATION_LOCALE_DIR', dirname(__FILE__) . '/../../locale/');

class Salutation
{
    private $data = array();

    private $names = array();

    private $mode = 'formal';

    public function __construct($locale, $names = array(), $mode = 'formal')
    {
        if (strlen($locale) !== 5) {
            throw new Exception('Bad locale format');
        }

        $localeFile = SALUTATION_LOCALE_DIR . preg_replace('/_/', '-', strtolower($locale)) . '.json';

        if (!file_exists($localeFile)) {
            throw new Exception('No data available for locale "' . $locale . '"');
        }

        $assoc = true;
        $this->data = json_decode(file_get_contents($localeFile), $assoc);

        $this->names = $names;

        $this->mode = $mode;
    }

    public function __toString()
    {
        $data = $this->data;

        $greeting = $data['greeting'][$this->mode];

        $names = array_reduce($this->names, function ($result, $name) use ($data) {
            // defaults
            $name = array_merge(array('title' => '', 'first' => '', 'last' => ''), $name);

            $format = 'nameFormat';
            if (!isset($name['title']) || !$name['title']) {
                $format = 'nameNoTitleFormat';
            }

            $nameString = sprintf($data[$format], $name['title'], $name['first'], $name['last']);

            if ($nameString) {
                $result[] = $nameString;
            }

            return $result;
        }, array());

        $format = 'greetingFormat';
        if (empty($this->names) || strlen(trim(implode('', $names))) === 0) {
            $format = 'greetingNoNameFormat';
        }

        return sprintf($data[$format], $greeting, implode(', ', $names));
    }
}
