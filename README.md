# svgchord-php
Drawing SVG guitar chords with PHP.  
Svgchord allow you to provide some svg chords renderer to display in HTML web page.

## Usage
```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Svgchord\Driver;
use Svgchord\GuitarGrid as Grid;
use Svgchord\Chord;
$driver = new Driver();
$grid   = new Grid($driver);
$chord  = new Chord('Cmaj');
$chord->put('0:o', '1:1', '0:o', '2:2', '3:3', '0:x');
$grid->addChord($chord);
echo $grid->render();
 ?>
```
The put method is setting each guitar string starting E acute to E grave with case number and finger number by grouping parameter with this format :

```
0:o // the E1 string is void
1:1 // the B string first case and the first finger
0:o // the G string  is void
2:2 // the D string second case and second finger
etc...
```
The case parameter only accept integer form 0 to 17  
The finger parameter only accept :  
 * 1 = first finger
 * 2 = 2nd finger
 * 3 = 3rd finger
 * 4 = 4th finger
 * o = void chord,
 * x = not play chord
 * h = half barred (not yet implemented)
 * f = full barred

![Cmaj](https://github.com/franckysolo/svgchord-php/assets/Cmaj.svg)
<img src="https://github.com/franckysolo/svgchord-php/assets/Cmaj.svg">

## Full barred chord
The create full barred chord you must user the f parameter for finger, an examle :

```php
<?php
$chord  = new Chord('Fmaj');
// f for full barred
$chord->put('1:f', '1:f', '2:2', '3:4', '3:3', '1:f');
$grid->addChord($chord);
echo $grid->render();
?>
```
## Starting over first case
By default svgchord start at the first case of the guitar grid, but you ca use the second parameter of Chord classes like this :
```php
<?php
$chord  = new Chord('Emin7', 5); // we start at 5th case
$chord->put('4:4', '2:2', '1:f', '3:3', '1:f', '1:f');
$grid->addChord($chord);
echo $grid->render();
 ```
