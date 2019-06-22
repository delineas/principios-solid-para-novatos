<?php

/**
 * Violación del principio
 * 
 * $patas = new CalculatePatas(
 *  ['cow','chicken','cow']
 * );
 * $patas->sum();
 * 
 */

class CalculatePatas {

    protected $sum;
    protected $animals;

    public function __construct($animals = [])
    {
        $this->sum = 0;
        $this->animals = $animals;
    }

    public function sum()
    {
        foreach($this->animals as $animal) {
            if($animal == 'cow') {
                $this->sum += 4;
            }
            if($animal == 'chicken') {
                $this->sum += 2;
            }
        }
    }

    public function getSum()
    {
        return $this->sum;
    }
}

/**
 * Primer refactor
 * 
 * $patas = new CalculatePatasRefactorOne(
 *  [
 *      new Cow(),
 *      new Chicken(),
 *      new Cow()
 *  ]
 * );
 * $patas->sum();
 * 
 */


/**
 * Clases de referencia
 */
class Cow
{
    protected $patas;

    public function __construct()
    {
        $this->patas = 4;
    }
    public function patas()
    {
        return $this->patas;
    }
}

class Chicken
{
    protected $patas;

    public function __construct()
    {
        $this->patas = 2;
    }
    public function patas()
    {
        return $this->patas;
    }
}


class CalculatePatasRefactorOne
{

    protected $sum;
    protected $animals;

    public function __construct($animals = [])
    {
        $this->sum = 0;
        $this->animals = $animals;
    }

    public function sum()
    {
        $patas = [];
        foreach ($this->animals as $animal) {
            $patas[] = $animal->patas();
        }
        $this->sum = array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}


/**
 * Segundo refactor
 * 
 * $patas = new CalculatePatasRefactorTwo(
 *  [
 *      new CowAnimal(),
 *      new ChickenAnimal(),
 *      new CowAnimal()
 *  ]
 * );
 * $patas->sum();
 * 
 */

 interface AnimalInterface 
 {
     public function patas();
 }

 class CowAnimal implements AnimalInterface
{
    protected $patas;

    public function __construct()
    {
        $this->patas = 4;
    }
    public function patas()
    {
        return $this->patas;
    }
}

class ChickenAnimal implements AnimalInterface
{
    protected $patas;

    public function __construct()
    {
        $this->patas = 2;
    }
    public function patas()
    {
        return $this->patas;
    }
}


class CalculatePatasRefactorTwo
{

    protected $sum;
    protected $animals;

    public function __construct($animals = [])
    {
        $this->sum = 0;
        $this->animals = $animals;
    }

    public function sum()
    {
        $patas = [];
        foreach ($this->animals as $animal) {
            if($animal instanceof AnimalInterface){
                $patas[] = $animal->patas();
                continue;
            }
            throw new CalculatePatasInvalidAnimalException;
            
        }
        $this->sum = array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}