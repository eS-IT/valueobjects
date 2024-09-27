# Ip

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine IBAN.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `IBAN`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Iban\Valueobjects\IbanValue;
use Esit\Valueobjects\Classes\Iban\Services\Factories\IbanFactory;

class myClass
{
    public function __constructor(private readonly IbanFactory $factory)
    {
    }

    public function myTestFunction(): IbanValue
    {
        return $this->factroy->createFromString('DE79 3456 7890 1234 5678 90');
    }
}
```

_Die `IBAN` kann mit und ohne Leerzeichen eingegeben werden._

__Bei der Erstellung des `IBAN`-Objekts, wird die Prüfsumme kontrolliert! Es können nur gültige `IBAN` erstellt werden!__


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php
use Esit\Valueobjects\Classes\Iban\Valueobjects\IbanValue;
use Esit\Valueobjects\Classes\Iban\Services\Factories\IbanFactory;

class myClass
{
    public function __constructor(private readonly IbanFactory $factory)
    {
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createIbanFromString('DE79 3456 7890 1234 5678 90');

        echo $value;                    // gibt "DE79345678901234567890" aus
        echo $value->value();           // gibt "DE79345678901234567890" aus
        echo $value->getFormatedValue();// gibt "DE79 3456 7890 1234 5678 90" aus
    }
}
```

_`getFormatedValue()` fügt zur besseren Lesbarkeit alle 4 Zeichen ein Leerzeichen ein._