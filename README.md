# ⚒️ S.O.L.I.D para novatos

## Introducción

Explicación de los principios S.O.L.I.D. Este es el código que complementa el episodio 93 de Web Reactiva que puedes escuchar aquí:

https://www.danielprimo.io/podcast/93

En este README.md podrás encontrar una historia que acompaña la explicación. Prentende que paso por paso puedas enteder de una manera sencilla por que se deben aplicar estos principios. 

## Capítulo 1. La granja.

Un buen día, los granjeros más motivados que trabajan en la cooperativa Web Reactiva, pensaron en crear un programa para contar patas. Daba la casualidad que además de ser unos magníficos granjeros, eran programadores en su tiempo libre. Después de algunas discursiones decidieron usar PHP como lenguaje de programación para crear su calculadora de patas. Y así, a lo loco, empezaron a crear un programa para contar las patas de todos los animales de su espléndida granja. 

## Capítulo 2. S de Single Responsability.

Los ultra motivados granjeros crearon su primera versión de la calculadora.

```
💪 Ejercicio 1. 
Primero échale un ojo o dos al primer programa del archivo: 1-single-responsability.php

Pregunta:

¿Cuantas cosas crees que hace esta clase? 🤔🤔🤔
```
```php  
Respuesta:

❌ Una. Nooop!! Granjero busca pata.
✅ Más de una. Siiii!!! Fíjate bien en lo que hace el programa.

// Instanciamos la calculadora con las patas 

$patas = new CalculatePatas([4,2,4]);
$patas->sum(); // Acción 1
$patas->print(); // Acción 2

    ¿y cúal es el problema? a continuación ...
    
    Una pista: La misma clase contiene funcionalidad para hacer dos acciones de diferente naturaleza (calcula e imprime).
```

Los granjeros ultra motivados enseñan su calculadora a toda la cooperativa. Uno de los cooperativistas propone la idea de conectar la calculadora con una web donde mostrar el número total de las patas de la granja y acceder al record Guiness de la granja con más patas del mundo. La web es una página desacoplada y solo acepta json como formato de datos. 

Los granjeros tienen un dilema: 

```
💪 Ejercicio 2. 

¿Cómo cambiamos la calculadora para que como salida del total de patas, también tenga la posibilidad de tener como salida json? 🤔🤔🤔
```

```php 
Respuestas:

❌ Modificar el código actual para que devuelva un json. 

    $patas->toJson();

    Un granjero argumenta acertádamente, que si hacemos eso, corremos el riesgo de: 1. Afectar al código que realizar la suma, introduciendo efectos colaterales y ¿qué pasará cuando nos pidan otros formatos?. ¿Usar la misma clase para todo no sonaba correcto?.

✅ Crear una clase que se encargue de la impresión y salida del resultado. Biennn!!!! 

    Principio de Responsabilidad único al rescate (Single Responsability)
```
El principio de responsabilidad nos dice:

> Una clase debería tener sólo una razón para cambiar

Es decir, cuando nuestras clases hacen una cosa, pero la hacen bien, los motivos por los puedan cambiar siempre estarán relacionados con su función principal. 

Los granjeros se emocionan al conocer este principio y empiezan a refactorizar el código. 

Puedes ver el resultado en la segunda parte del código: 1-single-responsability.php

```php
$patas = new CalculatePatasRefactor([4,2,4]);
$patas->sum(); // Acción 1: Calculamos

$output = new OutputPatas($patas->getSum());
$output->toText(); // Acción 1: Imprime
$output->toJson(); // Acción 2: Imprime
```

Cómo podeis observar cada clase tiene una única responsabilidad. Ahora los granjeros pueden crear más tipos de salida sin afectar al cálculo de las patas y cambiar el cálculo sin afectar a su representación. Han creado un sistema ultra robusto. 🎉🎉🎉🎉
