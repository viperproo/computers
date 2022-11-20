<?php
  namespace Computer;

  interface ComputerInterface {
    public function show();
    public function getComponentsAmount();
    public function setName(string $name);
    public function searchComponent(Component $component);
    public function addComponent(Component $component, int $amount);
    public function addComponents($components);
    public function removeComponent(Component|int $component);
    public function removeComponents($components);
    public function removeComponentsInType(string $type);
    public function clearComponents();
  }
?>