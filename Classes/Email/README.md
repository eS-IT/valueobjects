# Email

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine E-Mail-Adresse.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `Email`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Email\Valueobjects\EmailValue;
use Esit\Valueobjects\Classes\Email\Services\Factories\EmailFactory;

class myClass
{
    private MoneyFactory $factory;

    public function __constructor(EmailFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): EmailValue
    {
        return $this->factroy->createEmailFromString('info@example.org');
    }
}
```


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php
use Esit\Valueobjects\Classes\Email\Services\Factories\EmailFactory;

class myClass
{
    private EmailFactory $factory;

    public function __constructor(EmailFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createEmailFromString('info@example.org');

        echo $value;            // gibt "info@example.org" aus
        echo $value->value();   // gibt "info@example.org" aus
    }
}
```
