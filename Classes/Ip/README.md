# Ip

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine IPv4.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `Ip`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Ip\Valueobjects\IpValue;
use Esit\Valueobjects\Classes\Ip\Services\Factories\IpFactory;

class myClass
{
    public function __constructor(private readonly IpFactory $factory)
    {
    }

    public function myTestFunction(): IpValue
    {
        return $this->factroy->createIpFromString('127.0.0.1');
    }
}
```


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php
use Esit\Valueobjects\Classes\Ip\Valueobjects\IpValue;
use Esit\Valueobjects\Classes\Ip\Services\Factories\IpFactory;

class myClass
{
    public function __constructor(private readonly IpFactory $factory)
    {
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createIpFromString('127.0.0.1');

        echo $value;            // gibt "127.0.0.1" aus
        echo $value->value();   // gibt "'127.0.0.1" aus
    }
}
```
