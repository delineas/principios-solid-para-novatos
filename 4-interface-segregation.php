<?php

/**
 * Violación del principio
 * 
 * $cowSpeed = new CowSpeed(60);
 * $cowSpeed->airSpeed(); // Las vacas no vuelan
 * $chickenSpeed = new ChickenSpeed(60);
 * $chickenSpeed->airSpeed();
 * 
 */

interface AnimalSpeedInterface
{
    public function groundSpeed($seconds);
    public function airSpeed( $seconds);
}

class CowSpeed implements AnimalSpeedInterface
{
    protected $seconds;
    protected $groundSpeed;
    protected $airSpeed;

    public function __construct($seconds)
    {
        $this->seconds = $seconds;
        $this->groundSpeed = 100;
        $this->airSpeed = null;
    }
    public function groundSpeed()
    {
        return $this->groundSpeed * $this->seconds;
    }

    public function airSpeed()
    {
        return $this->airSpeed;
    }
}


class ChickenSpeed implements AnimalSpeedInterface
{
    protected $seconds;
    protected $groundSpeed;
    protected $airSpeed;

    public function __construct($seconds)
    {
        $this->seconds = $seconds;
        $this->groundSpeed = 10;
        $this->airSpeed = 10;
    }
    public function groundSpeed()
    {
        return $this->groundSpeed * $this->seconds;
    }

    public function airSpeed()
    {
        return $this->airSpeed * $this->seconds;
    }
}


/**
 * Una interfaz intermedia que discrimine el cáclulo
 * 
 * $cowSpeed = new CowSpeedRefactor(60);
 * $cowSpeed->calculateSpeed(); // Las vacas no vuelan
 * $chickenSpeed = new ChickenSpeedRefactor(60);
 * $chickenSpeed->calculateSpeed();
 */

interface AnimalSpeedInterfaceRefactor
{
    public function calculateSpeed($seconds);
}

class CowSpeedRefactor implements AnimalSpeedInterfaceRefactor
{
    protected $seconds;
    protected $groundSpeed;

    public function __construct($seconds)
    {
        $this->seconds = $seconds;
        $this->groundSpeed = 100;
    }
    public function calculateSpeed()
    {
        return $this->groundSpeed * $this->seconds;
    }

}

class ChickenSpeedRefactor implements AnimalSpeedInterfaceRefactor
{
    protected $seconds;
    protected $airSpeed;

    public function __construct($seconds)
    {
        $this->seconds = $seconds;
        $this->airSpeed = 10;
    }
    public function calculateSpeed()
    {
        return $this->airSpeed * $this->seconds;
    }
}