<?php
  namespace Computer;

  use BaseClass;

  class Computer extends BaseClass implements ComputerInterface {
    protected $components = [];
    protected $components_amount = 0;
    public const COMPONENTS_AMOUNT_LIMIT = 50;

    public function __construct(
      protected $name = 'My PC'
    ) {

    }

    public function show() {
      echo $this->name.": {\n";
      foreach ($this->components as &$c) {
        echo "\t".$c;
      }
      echo "}\n";
    }

    public function getComponentsAmount() {
      return $this->components_amount;
    }

    public function setName(string $name) {
      $this->name = $name;
    }

    public function searchComponent($component) {
      if (! $component instanceof Component) return false;
      return array_search($component, $this->components);
    }

    // public function addComponent(Component $component) {
    public function addComponent($component) {
      if ($component instanceof Component && $this->components_amount < self::COMPONENTS_AMOUNT_LIMIT) {
        $this->components[] = $component;
        $this->components_amount++;
        return true;
      }

      return false;
    }

    public function removeComponent($component) {
      if (gettype($component) == 'integer') {
        if (! array_key_exists($component, $this->components)) return false;
        $index = $component;
      } else {
        $index = $this->searchComponent($component);
        if (! $index) return false;
      }

      unset($this->components[$index]);
      $this->components_amount--;
      return true;
    }

    public function addComponents($components) {
      return $this->addOrRemoveComponents('add', $components);
    }

    public function removeComponents($components) {
      return $this->addOrRemoveComponents('remove', $components);
    }

    private function addOrRemoveComponents($action, &$components) {
      if (! is_array($components)) return 0;
      $i = 0;
      foreach ($components as &$c) {
        if ($this->{$action.'Component'}($c)) $i++;
      }
      return $i;
    }

    public function removeComponentsInType($type) {
      $i = 0;
      foreach ($this->components as &$c) {
        if ($c->type == $type) {
          unset($c);
          $i++;
        }
      }
      return $i;
    }

    public function clearComputer() {
      $this->components = [];
    }

    public function __destruct() {
      echo "Computer destruct ({$this->name})\n";
    }
  }

?>