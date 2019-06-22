<?php

/**
 * Violación del principio
 * 
 * $patas = new CalculateBase(
 *  [
 *      new CowAnimal(),
 *      new ChickenAnimal(),
 *      new CowAnimal()
 *  ]
 * );
 * $orejas = new CalculateOrejas(
 *  [
 *      new CowAnimal(),
 *      new ChickenAnimal(),
 *      new CowAnimal()
 *  ]
 * );
 * 
 * $outputPatas = new OutputCalculator($patas);
 * $outputOrejas = new OutputCalculator($orejas);
 * 
 * $outputPatas->toText();
 * $outputOrejas->toText(); // Mostrará un error
 * 
 */

interface AnimalInterface
{
    public function patas();
    public function orejas();
}

class CowAnimal implements AnimalInterface
{
    protected $patas;
    protected $orejas;

    public function __construct()
    {
        $this->patas = 4;
        $this->orejas = 2;
    }
    public function patas()
    {
        return $this->patas;
    }

    public function orejas()
    {
        return $this->orejas;
    }
}

class ChickenAnimal implements AnimalInterface
{
    protected $patas;
    protected $orejas;

    public function __construct()
    {
        $this->patas = 2;
        $this->orejas = 0;
    }
    public function patas()
    {
        return $this->patas;
    }

    public function orejas()
    {
        return $this->orejas;
    }
}


class CalculateBase
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
            if ($animal instanceof AnimalInterface) {
                $patas[] = $animal->patas();
                continue;
            }
            throw new CalculatorPatasInvalidAnimalException;
        }
        $this->sum = array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}

class CalculateOrejas extends CalculateBase
{
    public function sum()
    {
        $orejas = [];
        foreach ($this->animals as $animal) {
            if ($animal instanceof AnimalInterface) {
                $orejas[] = $animal->orejas();
                continue;
            }
            throw new CalculateOrejasInvalidAnimalException;
        }
        /**
         * No es una suma, es un array. 
         * Aquí se produce la violación del principio
         */
        $this->sum = $orejas;
    }
}


class OutputCalculator
{

    protected $calculator;

    public function __construct(CalculateBase $calculator)
    {
        $this->calculator = $calculator;
    }

    public function toText()
    {
        return "Calculo ejecutado: " . $this->calculator->sum();
    }

    public function toJson()
    {
        return json_encode(['counter' => $this->calculator->sum()]);
    }
}