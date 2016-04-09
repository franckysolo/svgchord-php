<?php
namespace Svgchord;

class Chord {
    /**
     * The name of the chord
     *
     * @var string
     */
    protected $name;
    
    /**
     * The starting fret
     *
     * @var int
     */
    protected $start;
    
    /**
     * The parameters of the current chord
     *
     * @var array
     */
    protected $chord = array (
        'E6'    => 'x', // Mi grave
        'A'     => 'x',
        'D'     => 'x',
        'G'     => 'x',
        'B'     => 'x',
        'E1'    => 'x', // Mi aigue
    );
    
    /**
     *
     * @param string $name
     * @param int $start
     */
    public function __construct($name, $start = 1) {
        $this->name  = (string) $name;
        $this->start = (int) $start;
    }
    
    /**
     * Returns the name of the chord
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Returns the number of the starting fret
     *
     * @return int
     */
    public function getStart() {
        return $this->start;
    }
    
    /**
     * Each finger for chord is set by 'case-number:finger-number'
     *
     * o = void chord,
     * x = not play chord
     * h = half barred
     * f = full barred
     *
     * @param string $c1 E1
     * @param string $c2 B
     * @param string $c3 G
     * @param string $c4 D
     * @param string $c5 A
     * @param string $c6 E6
     * 
     * @return \Svgchord\Chord
     */
    public function put($c1, $c2, $c3, $c4, $c5, $c6) {
        $this->chord = array (
            'E6'    => $c6, // E grave
            'A'     => $c5,
            'D'     => $c4,
            'G'     => $c3,
            'B'     => $c2,
            'E1'    => $c1, // E acute
        );
    
        return $this;
    }
    
    /**
     * Get a chord  string parameter
     *
     * @param string $index
     * @return mixed
     */
    public function get($index) {
        if (isset($this->chord[$index])) {
            return $this->chord[$index];
        }
    }
    
    /**
     * Returns the chord parameter array
     *
     * @return array
     */
    public function getChord() {
        return $this->chord;
    }
}