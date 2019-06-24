<?php

/**
 * Clases de referencia
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

/**
 * Violación del principio: modificación de precondiciones, postcondiciones
 */

class CalculateConditionsPatas
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
            if($animal->patas() > 4) {
                throw new CalculateInvalidPatasException;
            }
            $patas[] = $animal->patas();
        }
        $this->sum = array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}


class CalculateConditionsOrejas extends CalculateConditionsPatas
{

    public function sum()
    {
        $orejas = [];
        foreach ($this->animals as $animal) {
            // Cambiamos una precondición
            if ($animal->patas() > 6) {
                throw new CalculateInvalidPatasException;
            }
            $orejas[] = $animal->orejas();
        }
        // Debilitamos la poscondicion, añadiendo un caso que ponemos a 0
        if(count($orejas) == 2) {
            $orejas[1] = 0;
        }
        $this->sum = array_sum($orejas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}


/**
 * Violación del principio: modificación de invariante
 */

class CalculateFactorPatas
{

    protected $sum;
    protected $animals;
    protected $factor;

    public function __construct($animals = [])
    {
        $this->sum = 0;
        $this->animals = $animals;
    }

    public function sum()
    {
        $patas = [];
        $this->factor = 3;
        foreach ($this->animals as $animal) {
            $patas[] = $animal->patas();
        }
        $this->sum = $this->factor * array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}


class CalculateFactorOrejas extends CalculateFactorPatas
{

    public function sum()
    {
        $orejas = [];
        $this->factor = 30;
        foreach ($this->animals as $animal) {
            $orejas[] = $animal->orejas();
        }
        $this->sum = $this->factor * array_sum($orejas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}


/**
 * Violación del principio: restricción histórica
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
            $patas[] = $animal->patas();
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
                $orejas[] = $animal->orejas();
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