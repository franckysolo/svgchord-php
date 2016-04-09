<?php
// The demo file implemented with bootstrap css
require_once __DIR__ . '/../vendor/autoload.php';
use Svgchord\Driver;
use Svgchord\GuitarGrid as Grid;
use Svgchord\Chord;
$driver = new Driver();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SVG Chords Démo</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>SVG Chords Démo</h1>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<?php 
$grid  = new Grid($driver);
$chord  = new Chord('Cmaj');
$chord->put('0:o', '1:1', '0:o', '2:2', '3:3', '0:x');
$grid->addChord($chord);
echo $grid->render();
?>
</div>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<?php 
$grid  = new Grid($driver);
$chord  = new Chord('Dmaj');
$chord->put('2:2', '3:3', '2:1', '0:o', '0:o', '0:x');
$grid->addChord($chord);
echo $grid->render();
?>
</div>
</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<?php 
$grid  = new Grid($driver);
$chord  = new Chord('Emaj');
$chord->put('0:o', '0:o', '1:1', '2:3', '2:2', '0:o');
$grid->addChord($chord);
echo $grid->render();
?>
</div>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<?php 
$grid   = new Grid($driver);
$chord  = new Chord('Emin7', 5); // we start at 5th case
$chord->put('4:4', '2:2', '1:f', '3:3', '1:f', '1:f');
$grid->addChord($chord);
echo $grid->render();
?>
</div>
</div>
</div>
</body>
</html>


