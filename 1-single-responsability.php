<?php

/**
 * Violación del principio
 * 
 * $patas = new CalculatePatas(
 *  [4,2,4]
 * );
 * $patas->pint();
 * 
 */

class CalculatePatas {

    protected $sum;
    protected $animals;

    public function __construct($animals = []) 
    {
        $this->animals = $animals;
        $this->sum = 0;
    }

    public function sum() 
    {
        $this->sum = array_sum($this->animals);
    }

    public function print() 
    {
        return "Calculo ejecutado \n\n Los animales suman  " . $this->sum . " patas." ;
    }
}


/**
 * Principio corregido
 * 
 * $patas = new CalculatePatasRefactor(
 *  [4,2,4]
 * );
 * $output = new OutputPatas($patas->sum());
 * $output->toText();
 * $output->toJson();
 * 
 */

class CalculatePatasRefactor {

    protected $sum;
    protected $animals;

    public function __construct($animals = []) 
    {
        $this->animals = $animals;
        $this->sum = 0;
    }

    public function sum() 
    {
        $this->sum = array_sum($this->animals);
    }

    public function getSum() 
    {
        return $this->sum;
    }
}

class OutputPatas {

    protected $patas;

    public function __construct($patas = 0)
    {
        $this->patas = $patas;
    }

    public function toText() 
    {
        return "Calculo ejecutado \n\n Los animales suman  " . $this->patas . " patas.";
    }

    public function toJson()
    {
        return json_encode(['patas' => $this->patas]);
    }
}




