# Duration

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine Zeitangabe oder Dauer (Anzahl an Stunden, Minuten und Sekunden).


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem Integer ein `Duration`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;

class myClass
{
    private DurationFactory $factory;

    public function __constructor(DurationFactory $factory)
    {
        $this->factory = $factory;
    }

    public function myTestFunction(): DurationValue
    {
        $time = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden

        return $this->factory->createDurationFromInt($time);
    }
}
```


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `getFormated()`-Methode
verwenden.

```php
<?php

use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;

class myClass
{
    private DurationFactory $factory;

    public function __constructor(DurationFactory $factory)
    {
        $this->factory = $factory;
    }

    public function myTestFunction(): void
    {
        // Erstellung
        $time   = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        // Ausgabe
        echo $value;            // gibt "12:34:56" aus
        echo $value->parse();   // gibt "12:34:56" aus
    }
}
```

### Format

Bei der formatierten Ausgabe kann das Format angegeben werden. Für die Anzahl der Stunden wird `H` verwendet,
für die Anzahl der Minuten `i` und für die Anzahl der Sekunden `s`. Bei negativen Zahlen kann zudem das Vorzeichen
bestimmt werden (Vorgaben: `-`).

```php
<?php

use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;

class myClass
{
    private IpFactory $factory;

    public function __constructor(IpFactory $factory)
    {
        $this->factory = $factory;
    }

    public function myTestFunction(): void
    {
        // Erstellung
        $time   = 45296 * -1; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        // Format
        echo $value->parse();               // gibt "12:34:56" aus
        echo $value->parse('H_i_s');        // gibt "-12_35_56" aus
        echo $value->parse('H_i_s', '<');   // gibt "<12_35_56" aus
    }
}
```

| Token   | Bendeutung                | Beispiel                                                                                             |
|---------|---------------------------|------------------------------------------------------------------------------------------------------|
| `s`     | Rest der Sekunden         | Bei 62 Sekunden wird ein Rest von 2 zurückgegeben, da die eine Minute nicht enthalten ist.           |
| `S`     | Gesamtzahl der Sekunden   | Bei 62 Sekunden wird 62 zurückgegeben, da die eine Minute enthalten ist.                             |
| `i`     | Rest der Minuten          | Bei 62 Minuten wird ein Rest von 2 zurückgegeben, da die eine Stunde nicht enthalten ist.            |
| `I`     | Gesamtzahl der Minuten    | Bei 62 Minuten wird 62 zurückgegeben, da die eine Stunden enthalten ist.                             |
| `h`     | Rest der Stunden          | Bei 26 Stunden wird ein Rest von 2 zurückgegeben, da der eine Tag nicht enthalten ist.               |
| `H`     | Gesamtzahl der Stunden    | Bei 26 Stunden wird 26 zurückgegeben, da der eine Tag enthalten ist.                                 |
| `d`     | Rest der Tage             | Bei 9 Tagen wird ein Rest von 2 zurückgegeben, da die eine Woche nicht enthalten ist.                |
| `D`     | Gesamtzahl der Tage       | Bei 9 Tagen wird 9 zurückgegeben, da die eine Woche enthalten ist.                                   |
| ~~`w`~~ | ~~Rest der Wochen~~       | _Da die Länge eines Montas nicht festgelegt ist, kann dieser Wert nicht pauschal berechnet werden!_ |
| `W`     | Gesamtzahl der Wochen     | Bein 15 Tagen werden 2 Wochen zurückgegeben.                                                         |
| ~~`m`~~ | ~~Rest der Monate~~       | _Da die Länge eines Montas nicht festgelegt ist, kann dieser Wert nicht pauschal berechnet werden!_ |
| ~~`M`~~ | ~~Gesamtzahl der Monate~~ | _Da die Länge eines Montas nicht festgelegt ist, kann dieser Wert nicht pauschal berechnet werden!_ |
| ~~`Y`~~ | ~~Gesamtzahl der Jahre~~  | _Da die Länge eines Jahres nicht festgelegt ist, kann dieser Wert nicht pauschal berechnet werden!_ |

### Rechnen

Um mit den Zeiten zu rechnen, stehen die Grundrechenarten zur Verfügung.

```php
<?php

use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;

class myClass
{
    private DurationFactory $factory;

    public function __constructor(DurationFactory $factory)
    {
        $this->factory = $factory;
    }

    public function myTestFunction(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $operand    = 2;

        // Addition
        $value = $valueOne->add($valueTwo);
        echo $value; // gibt "25:09:52" aus

        // Substraktion
        $value = $valueOne->subtract($valueTwo);
        echo $value; // gibt "00:00:00" aus

        // Multiplikation
        $value = $valueOne->multiply($operand);
        echo $value; // gibt "25:09:52" aus

        // Division
        $value = $valueOne->divide($operand);
        echo $value; // gibt "06:17:28" aus
    }
}
```
