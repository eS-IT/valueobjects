# Money

Bei diesem Objekt handelt es sich um ein grundlegendes Geldobjekt. In der Regel wird man in der Applikation
ein Währungsobjekt erstellen, welches das `Money`-Objekt benutzt oder beerbt.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem Integer ein `Money`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Money\Valueobjects\MoneyValue;
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): MoneyValue
    {
        return $this->factroy->createFromInt(1200);
    }
}
```

Sollte eine abweichende Anzahl an Nachkommastellen benötigt werden, kann diese als zweiter Parameter mit angegeben
werden: `$this->factroy->createFromInt(12000, 3)`

Es ist außerdem möglich ein `Money`-Objekt aus einem formatierten String zu erstellen:

```php
<?php
use Esit\Valueobjects\Classes\Money\Valueobjects\MoneyValue;
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): MoneyValue
    {
        return $this->factroy->createFromString('1.200,00', '.', ',', 2);
    }
}
```

Hier ist darauf zu achten, dass das Tausendertrennzeichen (Standard: '.'), das Dezimaltrennzeichen (Standard: ',')
und die Nachkommastellen (Standard: 2) zum übergebenen String passen. Der Aufruf
`$this->factroy->createFromString('1.200,00', '', ',', 2)` würde fehlschlagen, da der String in diesem Fall kein
Tausendertrennzeichen enthalten soll.


## Formatierung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`.

```php
<?php
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createFromInt(120000);

        echo $value; // gibt "1.200,00" aus
    }
}
```

Will man die Formatierung beeinflussen, verwendet mann die `formatedValue()`-Methode und gibt das
Tausendertrennzeichen und die Dezimaltrennzeichen an:

```php
<?php
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createFromString('1|200-000', '|', '-', 3);

        echo $value->formatedValue('|', '-'); // gibt "1|200-000" aus
    }
}
```

Benötigt man der Wert, verwendet man die `value`-Methode:

```php
<?php
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createFromString('1.200,00', '.', ',', 2);

        echo $value->value(); // gibt 120000 aus
    }
}
```

## Rechnen

Gerade bei Geldbeträgen will man oft Berechnungen durchführen. Dies kann dierekt mit dem MonyValue geschehen, da es
einen `Calculator` enthält. Dieser kann natürlich auch separat injiziert und von außen genutzt werden, in dem man zwei
MoneyValues oder ein MoneyValue und ein Integer (je nach Rechenart) übergibt.

__Bitte beachten:__

- __Werteobjekte sind immer unveränderlich.__
- __Es wird bei jeder Berechnungen ein neues Wertobjekt zurückgegeben.__
- __Es können nur Wertobjekte mit der gleichen Anzahl an Nachkommastellen addiert oder subtrahiert werden.__

```php
<?php
use Esit\Valueobjects\Classes\Money\Services\Factories\MoneyFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(MoneyFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $valueOne  = $this->factroy->createFromInt(1200);
        $valueTwo  = $this->factroy->createFromInt(2400);

        $resultAdd = $valueOne->add($valueTwo);         // $resultAdd hat den Wert 3600
        $resultSub = $valueTwo->substract($valueOne);   // $resultSub hat den Wert 1200
        $resultMul = $valueOne->multiply(4);            // $resultMul hat den Wert 4800
        $resultDiv = $valueTwo->divide(2);              // $resultDiv hat den Wert 1200
    }
}
```

Da die neuen Obejkte ebenfalls MoneyValues sind, kann mit ihnen genauso verfahren werden, wie mit den Ausgangsobjekten.