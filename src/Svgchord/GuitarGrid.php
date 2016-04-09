<?php
/**
 * Svgchord (Drawing SVG guitar chords with PHP)
 *
 * @version 1.0.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Svgchord;
/**
 * @category Svgchord - Drawing SVG guitar chords with PHP
 * @version 1.0.0
 * @author franckysolo <franckysolo@gmail.com>
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @package Svgchord
 * @filesource  GuitarGrid.php
 */
class GuitarGrid {

    /**
     * le tableaux de stockage des lignes svg à afficher
     *
     * @var array
     */
    protected $svg          = array();
    protected $id;
    protected $driver;
    protected $background   = '#ffffff';
    protected $width        = 240;
    protected $height       = 110;
    
    /**
     * 
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver) {
        $this->driver = $driver;
        // @todo will be moved from contructor
        $this->grid();
    }
    
    /**
     * Dessine le manche de la guitare avec 5 cases
     * @prototype
     */
    public function grid() {
        // Dession du cadre
        //<rect x="0" y="0" width="240" height="110"  fill="#ffffff" />
        $svg = $this->driver->rect(0, 0, $this->width, $this->height)
                    ->fill($this->background)
                    ->draw()
        ;
        array_push($this->svg, $svg);
        // Le manche
        //<rect x="20" y="20" width="200" height="70"  stroke="maroon" fill="transparent" stroke-width="0.5" />
        $svg = $this->driver->rect(20, 20, 200, 60)
                    ->fill($this->background)
                    ->stroke('maroon', 0.5)
                    ->draw()
        ;
        array_push($this->svg, $svg);
        //<line x1="19" x2="19" y1="20" y2="90" stroke="maroon" fill="transparent" stroke-width="1"/>
        $svg = $this->driver->line(19, 20, 19, 80)
                    ->fill('transparent')
                    ->stroke('maroon', 1)
                    ->draw()
        ;
        array_push($this->svg, $svg);
        // Frettes de 60 à 180 par pas de 40
        //<line x1="60" x2="60" y1="20" y2="90" stroke="black" fill="transparent" stroke-width="0.5"/>
        for ($i = 60; $i <= 180; $i+= 40) {
            $svg = $this->driver->line($i, 20, $i, 80)
                        ->fill('transparent')
                        ->stroke('black', 0.5)
                        ->draw();
            array_push($this->svg, $svg);
        }
        // Cordes
        for ($i = 25; $i < 85; $i+= 10) {
            $svg = $this->driver->line(20, $i, 220, $i)
                        ->fill('transparent')
                        ->stroke('black', $i / 100)
                        ->draw();
            array_push($this->svg, $svg);
        }      
    }
    
    /**
     * 
     * @param string $finger
     * @param float $cx
     * @param float $cy
     * @return void
     */
    public function drawFinger($finger, $cx, $cy) {
        $svg = $this->driver->circle($cx, $cy, 5)
                    ->fill('orange')
                    ->title($finger)
                    ->draw();
        array_push($this->svg, $svg);
        $svg = $this->driver->text($finger, $cx - 1, $cy + 1, "Verdana", 4)->draw();
        array_push($this->svg, $svg);
    }
    
    /**
     *
     * @param float $cx
     * @param float $cy
     * @return void
     */
    public function drawVoid($cx, $cy) {
        $svg = $this->driver->circle($cx, $cy, 2)
                    ->stroke('green')
                    ->fill('transparent')
                    ->draw();
        array_push($this->svg, $svg);
    }
    
    /**
     *
     * @param float $cx
     * @param float $cy
     * @return void
     */
    public function drawMute($cx, $cy) {
        $svg = $this->driver->circle($cx, $cy, 2)
                    ->stroke('black')
                    ->fill('transparent')
                    ->draw();
        array_push($this->svg, $svg);
    }
    
    /**
     *
     * @param string $finger
     * @param unknown $x
     * @return void
     */
    public function drawFullBarred($finger, $x) {
       $svg = $this->driver->rect($x - 5, 20, 10, 60)
                    ->fill('orange')
                    ->rounded(5, 5)
                    ->title('1')
                    ->draw();
       array_push($this->svg, $svg);
       $svg = $this->driver->text("1", $x - 1, 50, "Verdana", 4)->draw();
       array_push($this->svg, $svg);
    }
    
    // not use for now
    public function drawHalfBarred($finger, $x, $y) {
      //@todo
    }
    
    /**
     * 
     * @param Chord $chord
     * 
     * @return void
     */
    public function drawLegend(Chord $chord) {
        // Cases
        $start = $chord->getStart();
        for ($i = 33; $i <= 193; $i+=40) {
            $txt = sprintf ('Case n°%d', $start);
            $svg = $this->driver
                        ->text($txt, $i, 10, "Verdana", 4)
                        ->fill('#999999')
                        ->draw();
            array_push($this->svg, $svg);
            $start += 1;
        }
        
        $svg = $this->driver->text($this->id, 100, 100, "Verdana", 8)
                    ->draw();
        array_push($this->svg, $svg);
    }
      
    /**
     * 
     * @param Chord $chord
     * 
     * @return void
     */
    public function addChord(Chord $chord) {
        // Draw chord name
        $this->id = $chord->getName();
        //<text x="100" y="100"  font-size="8">Do maj</text>
        $this->drawLegend($chord);
        // boucler sur les parametres
        $cy = 25;
        $array = array_reverse($chord->getChord(), true);
        $countFull = 0;
        foreach ($array as $p) {
            $map = explode(':', $p);
            list($case, $finger) = $map;
            $case = (int) $case;
            $cx = $case * 40;
            if ($case == 0) {
                $cx = 10;
            }
            if ($finger == 'o') { // corde à vide
                $this->drawVoid($cx, $cy);
            } else if ($finger == 'x') { // corde mute
                $this->drawMute($cx, $cy);
            } else if ($finger == 'f') { // corde barré full
                $countFull++;
                if ($countFull == 1) {
                    $this->drawFullBarred($finger, $cx);                   
                }
            } else if ($finger == 'h') { // corde barré half @FIXME : notation may be h[2,4], find a solution!
                $this->drawHalfBarred($finger, $cx, $cy);
            } else { // Finger
                $this->drawFinger($finger, $cx, $cy);
            }
             
            $cy+=10;
        }
    }
     
    /**
     * Render svg tag
     * 
     * @return string
     */
    public function render() {
        $content = implode(PHP_EOL, $this->svg);
        return <<<SVG
<svg id="$this->id" class="chords" viewBox="0 0 $this->width $this->height" preserveAspectRatio="xMidYMid slice">
$content
</svg>
SVG;
    }
}