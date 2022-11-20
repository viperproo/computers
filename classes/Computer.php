<?php
  namespace Computer;

  use BaseClass;

  class Computer extends BaseClass implements ComputerInterface {
    protected static $required_components_types = ['psu', 'mobo', 'cpu', 'ram'];
    protected $components = [];
    protected $components_amount = 0;
    public const COMPONENTS_AMOUNT_LIMIT = 50;

    public function __construct(
      protected string $name = 'My PC',
      $components = null
    ) {
      $this->addComponents($components);
    }

    public function show() {
      echo $this;
      return $this;
    }

    public function getComponentsAmount() {
      return $this->components_amount;
    }

    public function setName(string $name) {
      $this->name = $name;
      return $this;
    }

    public function searchComponent(Component $component) {
      // if (! $component instanceof Component) return false;
      // return array_search($component, $this->components);
      $i = 0;
      foreach ($this->components as &$c) {
        if ($c['component'] == $component) return $i;
        $i++;
      }
      return false;
    }

    // public function addComponent(Component $component, $amount) {
      // if ($component instanceof Component && $this->components_amount < self::COMPONENTS_AMOUNT_LIMIT && $amount >= 1 && $amount <= 99) {
    public function addComponent(Component $component, int $amount = 1) {
      if ($this->components_amount < self::COMPONENTS_AMOUNT_LIMIT && $amount >= 1 && $amount <= 99) {
        $this->components[] = [
          'component' => $component,
          'amount' => $amount,
        ];
        $this->components_amount++;
        return true;
      }
      return false;
    }

    public function removeComponent(Component|int $component) {
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
      if (! is_array($components)) return 0;
      $i = 0;
      foreach ($components as &$c) {
        if (is_array($c)) {
          if ($this->addComponent($c[0], $c[1])) $i++;
        } else {
          if ($this->addComponent($c)) $i++;
        }
      }
      return $i;
    }

    public function removeComponents($components) {
      if (! is_array($components)) return 0;
      $i = 0;
      foreach ($components as &$c) {
        if ($this->removeComponent($c)) $i++;
      }
      return $i;
    }

    public function removeComponentsInType(string $type) {
      $i = 0;
      foreach ($this->components as &$c) {
        if ($c->type == $type) {
          unset($c);
          $i++;
        }
      }
      return $i;
    }

    public function clearComponents() {
      $this->components = [];
      return $this;
    }

    public function isValid() {
      // to do
      foreach ($this->components as &$c) {
      }

      return true;
    }

    public function __toString() {
      $str = $this->name.": {\n";
        foreach ($this->components as &$c) {
          $str .= "\t".$c['component'];
          if ($c['amount'] > 1) {
            $str .= " (x".$c['amount'].")";
          }
          $str .= "\n";
        }
        return $str."}\n";
    }

    public function __destruct() {
      echo "Computer destruct ({$this->name})\n";
    }
  }

  // public function addComponents($components) {
  //   return $this->addOrRemoveComponents('add', $components);
  // }

  // public function removeComponents($components) {
  //   return $this->addOrRemoveComponents('remove', $components);
  // }

  // private function addOrRemoveComponents($action, &$components) {
  //   if (! is_array($components)) return 0;
  //   $i = 0;
  //   foreach ($components as &$c) {
  //     if ($this->{$action.'Component'}($c)) $i++;
  //   }
  //   return $i;
  // }

?>