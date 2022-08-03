<?php
namespace Computer;

use BaseClass;

class Component extends BaseClass implements ComponentInterface {
  private static $types = ['cpu', 'mobo', 'ram', 'disc', 'gpu', 'psu', 'case', 'cooler', 'fan'];
  private const DEFAULT_AMOUNT = 1;
  protected string $type;
  protected string $name;
  protected int $amount;

  private function __construct($type, $name, $amount) {
    $this->_set($type, $name, $amount);
  }

  public static function create($type, $name, $amount = self::DEFAULT_AMOUNT) {
    if (! self::_validate($type, $amount)) return null;
    return new self($type, $name, $amount);
  }

  public function update($type, $name, $amount = self::DEFAULT_AMOUNT) {
    if (! self::_validate($type, $amount)) return false;
    $this->_set($type, $name, $amount);
    return true;
  }

  // public function show() {
  //   echo $this->type.': '.$this->name;
  //   if ($this->amount > 1) {
  //     echo " (x{$this->amount})";
  //   }
  //   echo "\n";
  // }

  public function show() {
    echo $this->__toString();
  }

  public function __toString() {
    $str = $this->type.': '.$this->name;
    if ($this->amount > 1) {
      $str .= " (x{$this->amount})";
    }
    return $str."\n";
  }

  // do zrobienia, funkcja ma zwracać tablicę komponentów z pliku
  public static function createFromFile($file) {
    $components = [];

    if (! file_exists($file)) return false;
    if (mime_content_type($file) != 'text/json') return false;

    $array = json_decode(file_get_contents($file));

    foreach ($array as $c) {
      $components;
    }

    return $components;
  }

  private function _set($type, $name, $amount) {
    $this->type = $type;
    $this->name = $name;
    $this->amount = $amount;
  }

  private static function _validate($type, $amount) {
    if (! in_array($type, self::$types)) return false;
    if ($amount < 1 || $amount > 99) return false;
    return true;
  }

  public function __destruct() {

  }
}
?>