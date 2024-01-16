<?php
/* class Car
{
    private $color = "red";
    public $speed = 0;
    public function showColor()
    {
        return $this->color;
    }
    public function paint($co) {
        $this->color = $co;
    }
    public function setSpeed() {
        $this->speed = rand(0, 100);
    }
    public function getSpeed() {
        return $this->speed;
    }
}
$ka = new Car(); // Instance of class car
$ka ->paint("blue");
echo $ka->showColor();
$ka ->setSpeed();
echo $ka->getSpeed();

class Car
{
    private $color;
    private $speed;
    public function __construct($co='red', $sp='0') {
        $this->color = "red";
        $this->speed = 0;
    }
    public function setSpeed()
    {
        $this->speed++;
    }
    public function getSpeed()
    {
        return $this->speed;
    }
}
$ka = new Car();

echo $ka->getSpeed();
*/