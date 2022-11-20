<?php
abstract class BaseClass {
  public function __get($property) {
    if (property_exists(static::class, $property)) {
      return $this->$property;
    }
    return null;
  }
}
?>