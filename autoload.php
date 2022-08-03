<?php
spl_autoload_register(function ($class_name) {
  $arr = explode('\\', $class_name);
  $dir = strpos($class_name, 'Interface') !== false ? 'interfaces' : 'classes';
  require_once $dir.'/'.end($arr).'.php';
});
?>