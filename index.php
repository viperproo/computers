<?php
require_once 'autoload.php';

use Computer\Computer;
use Computer\Component;

$computer = new Computer('Uzurpator');

$computer->addComponents([
  Component::create('mobo', 'MSI X570 Unify'),
  Component::create('cpu', 'AMD Ryzen 7 5800X'),
  Component::create('cooler', 'Be Quiet Dark Rock Pro 4'),
  Component::create('ram', 'Patriot Viper Steel 8GB 4400 CL18', 2),
  Component::create('disc', 'Samsung 980 Pro 1TB'),
  Component::create('disc', 'Samsung 970 Pro 1TB'),
  Component::create('gpu', 'Nvidia GeForce GTX 1080 Ti'),
  Component::create('psu', 'Be Quiet Dark Power Pro 12 1200W'),
  Component::create('case', 'Fractal Design Define 7'),
  Component::create('fan', 'Be Quiet Silent Wings 3 140 PWM', 5)
]);

$computer->show();
?>