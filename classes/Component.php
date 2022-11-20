<?php
namespace Computer;

use BaseClass;

class Component extends BaseClass implements ComponentInterface {
  private static $types = ['cpu', 'mobo', 'ram', 'disc', 'gpu', 'psu', 'case', 'cooler', 'fan'];
  protected string $type;
  protected string $name;

  private function __construct() {}

  public static function create($type, $name) {
    if (! self::_validate($type)) return null;
    $computer = new self;
    $computer->_set($type, $name);
    return $computer;
  }

  public function update($type, $name) {
    if (! self::_validate($type)) return false;
    $this->_set($type, $name);
    return true;
  }

  public function show() {
    echo $this;
    return $this;
  }

  public function __toString() {
    return $this->type.': '.$this->name;
  }

  public static function createFromFile($file) {
    // do zrobienia, funkcja ma zwracać tablicę komponentów z pliku
    $components = [];

    if (! file_exists($file)) return false;
    if (mime_content_type($file) != 'text/json') return false;

    $array = json_decode(file_get_contents($file));

    foreach ($array as $c) {
      $components;
    }

    return $components;
  }

  private function _set($type, $name) {
    $this->type = $type;
    $this->name = $name;
  }

  private static function _validate($type) {
    return in_array($type, self::$types);
  }

  public function __destruct() {}
}
?>