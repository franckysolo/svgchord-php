<?php
namespace Svgchord;

class Driver implements DriverInterface {
    
    /**
     * The drawing shape
     * 
     * @var string
     */
    protected $shape;
    
    /**
     * The drawing svg attributes
     * 
     * @var array
     */
    protected $attributes   = array();
     
    /**
     * Setting a svg rect
     * 
     * @param float $x
     * @param float $y
     * @param float $w
     * @param float $h
     * @return \Svgchord\Driver
     */
    public function rect($x, $y, $w, $h) {
        unset($this->attributes);
        $this->shape      = 'rect';
        $this->attributes = array (
            'x'         => $x,
            'y'         => $y,
            'width'     => $w,
            'height'    => $h,
        );
        return $this;
    }
    
    /**
     * Setting a svg line
     * 
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @return \Svgchord\Driver
     */
    public function line($x1, $y1, $x2, $y2) {
        unset($this->attributes);
        $this->shape                = 'line';
        $this->attributes = array (
            'x1'   => $x1,
            'y1'   => $y1,
            'x2'   => $x2,
            'y2'   => $y2,
        );
        return $this;
    }
    
    /**
     * Setting a svg circle
     * 
     * @param float $cx
     * @param float $cy
     * @param float $radius
     * @return \Svgchord\Driver
     */
    public function circle($cx, $cy, $radius) {
        unset($this->attributes);
        $this->shape = 'circle';
        $this->attributes = array (
            'cx'   => $cx,
            'cy'   => $cy,
            'r'   => $radius,
        );
        return $this;
    }
    
    /**
     * Setting svg text
     * 
     * @param string $text
     * @param float $x
     * @param float $y
     * @param string $fontfamily
     * @param int $fontsize
     * @return \Svgchord\Driver
     */
    public function text($text, $x, $y, $fontfamily, $fontsize) {
        unset($this->attributes);
        $this->shape = 'text';
        $this->attributes = array (
            'x'            => $x,
            'y'            => $y,
            'font-family'  => $fontfamily,
            'font-size'    => $fontsize,
            'text'         => $text,
        );
        return $this;
    }
    
    /**
     * Setting fill color
     * 
     * @param string $color
     * @return \Svgchord\Driver
     */
    public function fill($color) {
        $this->attributes['fill'] = $color;
        return $this;
    }
    
    /**
     * Setting title tooltip
     * 
     * @param string $title
     * @return \Svgchord\Driver
     */
    public function title($title) {
        $this->attributes['title'] = $title;
        return $this;
    }
    
    /**
     * Setting color stroke & width
     * 
     * @param string $color
     * @param int $size
     * @return \Svgchord\Driver
     */
    public function stroke($color, $size = null) {
        $this->attributes['stroke'] = $color;
        if (null !== $size) {
            $this->attributes['stroke-width'] = $size;
        }
    
        return $this;
    }
    
    /**
     * Setting rounded corner
     * 
     * @param float $rx
     * @param float $ry
     * @return \Svgchord\Driver
     */
    public function rounded($rx, $ry) {
        $this->attributes['rx'] = $rx;
        $this->attributes['ry'] = $ry;
               
        return $this;
    }
    
    /**
     * Format the attibutes value for svg tag
     * 
     * @param string $key
     * @param string $value
     * @return string
     */
    public function map($key, $value) {
        return $key . '="' . $value . '"';
    }
    
    /**
     * Returns the svg string tag
     * 
     * @return string
     */
    public function draw () {
        // if empty $this->group
        $text = null;
        if (isset($this->attributes['text'])) {
            $text = $this->attributes['text'];
            unset($this->attributes['text']);
        }
    
        $keys   = array_keys($this->attributes);
        $values = array_values($this->attributes);
        $result = array_map(array($this, 'map'), $keys, $values);
        $attrs  = implode(' ', $result);
         
        if ($text == null) {
    
            return <<<SVG
<$this->shape $attrs/>
SVG;
        } else {
            return <<<SVG
<text $attrs>$text</text>
SVG;
        }
    }
}