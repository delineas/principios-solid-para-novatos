<?php

/**
 * Violación del principio
 * 
 * $cowSpeed = new CowSpeed(10, 60);
 * $cowSpeed->airSpeed(); // Las vacas no vuelan
 * $DuckSpeed = new DuckSpeed(10, 60);
 * $DuckSpeed->airSpeed();
 * 
 */

interface AnimalSpeedInterface
{
    public function groundSpeed();
    public function airSpeed();
}

class CowSpeed implements AnimalSpeedInterface
{
    protected $meters;
    protected $seconds;
    protected $groundFactor;
    protected $airFactor;

    public function __construct($meters, $seconds)
    {
        $this->meters = $meters;
        $this->seconds = $seconds;
        $this->groundFactor = 1;
        $this->airFactor = null;
    }
    public function groundSpeed()
    {
        return $this->groundFactor * ($this->meters / $this->seconds);
    }

    public function airSpeed()
    {
        return null;
    }
}


class DuckSpeed implements AnimalSpeedInterface
{
    protected $meters;
    protected $seconds;
    protected $groundFactor;
    protected $airFactor;

    public function __construct($meters, $seconds)
    {
        $this->meters = $meters;
        $this->seconds = $seconds;
        $this->groundFactor = 0.01;
        $this->airFactor = 1.2;
    }
    public function groundSpeed()
    {
        return $this->groundFactor * ($this->meters / $this->seconds);
    }

    public function airSpeed()
    {
        return $this->airFactor * ($this->meters / $this->seconds);
    }
}


/**
 * Una interfaz intermedia que discrimine el cáclulo
 * 
 * $cowSpeed = new CowSpeedRefactor(10, 60);
 * $cowSpeed->calculateSpeed(); // Las vacas no vuelan
 * $DuckSpeed = new DuckSpeedRefactor(10, 60);
 * $DuckSpeed->calculateSpeed();
 */

interface AnimalSpeedInterfaceRefactor
{
    public function calculateSpeed();
}

class CowSpeedRefactor implements AnimalSpeedInterfaceRefactor
{
    protected $meters;
    protected $seconds;
    protected $groundFactor;

    public function __construct($meters, $seconds)
    {
        $this->meters = $meters;
        $this->seconds = $seconds;
        $this->groundFactor = 1;
    }
    public function calculateSpeed()
    {
        return $this->groundFactor * ($this->meters / $this->seconds);
    }

}

class DuckSpeedRefactor implements AnimalSpeedInterfaceRefactor
{
    protected $meters;
    protected $seconds;
    protected $airFactor;

    public function __construct($meters, $seconds)
    {
        $this->meters = $meters;
        $this->seconds = $seconds;
        $this->groundFactor = 0.01;
        $this->airFactor = 1.2;
    }
    public function calculateSpeed()
    {
        return $this->airFactor * ($this->meters / $this->seconds);
    }
}