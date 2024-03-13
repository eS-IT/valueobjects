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

### Arbeiten mit Besteandteilen der Dauer

Die einzelnen Bestandteile (Stunden, Mininuten und Sekunden) können als Wertobjekt bezogen werden, um mit ihren Zahlen
zu arbeiten.

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
        $time   = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        // Stunden
        $hours  = $value->getHoursValue();
        echo $hours->count();   // gibt 12 aus
        echo $hours->value();   // gibt 43200 aus
        echo $hours->parse();   // gibt "12" aus

        // Minuten
        $minutes = $value->getMinutesValue();
        echo $minutes->count(); // gibt 34 aus
        echo $minutes->value(); // gibt 2040 aus
        echo $minutes->parse(); // gibt "34" aus

        // Sekunden
        $seconds = $value->getSecondsValue();
        echo $seconds->count(); // gibt 56 aus
        echo $seconds->parse(); // gibt "56" aus
    }
}
```
