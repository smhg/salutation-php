<?php
namespace Salutation;

define('SALUTATION_LOCALE_DIR', dirname(__FILE__) . '/../../locale/');

class Salutation
{
    private $_data = array();

    private $_names = array();

    private $_mode = 'formal';

    public function __construct($locale, $names = array(), $mode = 'formal')
    {
        if (strlen($locale) !== 5) {
            throw new Exception('Bad locale format');
        }

        $localeFile = SALUTATION_LOCALE_DIR . preg_replace('/_/', '-', strtolower($locale)) . '.json';

        if (!file_exists($localeFile)) {
            throw new Exception('No data available for locale "' . $locale . '"');
        }

        $this->_data = json_decode(file_get_contents($localeFile), $assoc = true);

        $this->_names = $names;

        $this->_mode = $mode;
    }

    public function __toString()
    {
        $data = $this->_data;

        $greeting = $data['greeting'][$this->_mode];

        $format = 'greetingFormat';
        if (empty($this->_names)) {
            $format = 'greetingNoNameFormat';
        }

        $names = array_map(function ($name) use ($data) {
            // defaults
            $name = array_merge(array('title' => '', 'first' => '', 'last' => ''), $name);

            $format = 'nameFormat';
            if (!isset($name['title']) || !$name['title']) {
                $format = 'nameNoTitleFormat';
            }

            return sprintf($data[$format], $name['title'], $name['first'], $name['last']);
        }, $this->_names);

        return sprintf($data[$format], $greeting, implode(', ', $names));
    }
}
