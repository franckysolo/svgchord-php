<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Svgchord\Driver;
use Svgchord\GuitarGrid as Grid;
use Svgchord\Chord;
$driver = new Driver();

// Test d'un Fmaj avec barrer full
$grid  = new Grid($driver);
$chord  = new Chord('Fmaj');
// put case:finger on each string guitar from E acute to E grave
// f for full barred
// number is the number of the finger start to index
$chord->put('1:f', '1:f', '2:2', '3:4', '3:3', '1:f');
$grid->addChord($chord);
echo $grid->render();

// Test Amin 3rd case
$grid   = new Grid($driver);
$chord  = new Chord('Amin');
$chord->put('3:f', '3:f', '3:f', '5:4', '5:3', '3:f');
$grid->addChord($chord);
echo $grid->render();

// Test Emin7 5th case
$grid   = new Grid($driver);
$chord  = new Chord('Emin7', 5); // we start at 5th case
$chord->put('4:4', '2:2', '1:f', '3:3', '1:f', '1:f');
$grid->addChord($chord);
echo $grid->render();