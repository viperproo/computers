<?php
namespace Computer;

interface ComponentInterface {
  public static function create($type, $name);
  public function update($type, $name);
  public function show();
}
?>