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
 * @filesource  DriverInterface.php
 */
interface DriverInterface
{
    /**
     * Drawing svg tag
     * 
     * @return string
     */
    public function draw();
}