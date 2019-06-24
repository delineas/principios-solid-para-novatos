<?php

/**
 * Violación del principio: las capas más altas dependen de la más baja (persistencia en MySQL)
 * $patas = new CalculatePatas(
 *  [
 *      new CowAnimal(),
 *      new ChickenAnimal(),
 *      new CowAnimal()
 *  ]
 * );
 * $mySqlConnection = new MySqlConnection($connectionData);
 * $persist = new AnimalPersist($mySqlConnection, $patas);
 */

/**
 * Clases de referencia
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


class CalculatePatas
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
            throw new CalculatePatasInvalidAnimalException;
        }
        $this->sum = array_sum($patas);
    }

    public function getSum()
    {
        return $this->sum;
    }
}

/**
 * Vamos a persistir los datos
 * 
 * $patas = new CalculatePatas(
 *  [
 *      new CowAnimal(),
 *      new ChickenAnimal(),
 *      new CowAnimal()
 *  ]
 * );
 * $redisConnection = new RedisConnection($connectionData);
 * $persist = new AnimalPersistRefactor($mySqlConnection, $patas);
 */
class MySqlConnection 
{
    public function  __construct($connectionData)
    {
        // connect data
    }
    public function save($data)
    {
        // save lines
    }

}

class AnimalPersist
{

    private $dbConnection;
    public function __construct(MySqlConnection $mySqlConnection, CalculatePatas $calculator)
    {
        $this->dbConnection = $mySqlConnection;
    }

}

/**
 * Corrección para que cumpla el principio
 */

interface PersistConnectionInterface
{
    public function save();
}

class MySqlConnectionRefactor implements PersistConnectionInterface
{
    public function  __construct($connectionData)
    {
        // connect data
    }
    public function save($data)
    {
        // save lines
    }
}

class RedisConnection implements PersistConnectionInterface
{
    public function  __construct($connectionData)
    {
        // connect data
    }
    public function save($data)
    {
        // save lines
    }
}

class AnimalPersistReactor
{
    private $connection;

    public function __construct(PersistConnectionInterface $connection, CalculatePatas $calculator)
    {
        $this->connection = $connection;
    }
}