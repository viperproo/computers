<?php
  namespace Computer;

  interface ComputerInterface {
    public function show();
    public function getComponentsAmount();
    public function setName(string $name);
    public function searchComponent($component);
    public function addComponent($component);
    public function addComponents($components);
    public function removeComponent($component);
    public function removeComponents($components);
    public function removeComponentsInType($type);
    public function clearComputer();
  }
?>