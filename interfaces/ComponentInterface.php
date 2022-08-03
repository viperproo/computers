<?php
namespace Computer;

interface ComponentInterface {
  public static function create($type, $name, $amount);
  public function update($type, $name, $amount);
  public function show();
}
?>