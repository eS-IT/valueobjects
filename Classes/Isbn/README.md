# Isbn

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine ISBN. Es werden ISBN10 und ISBN13 unterstützt.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `Isbn`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Isbn\Services\Factories\IsbnFactory;

class myClass
{
    public function __constructor(private readonly IsbnFactory $factory)
    {
     }

    public function myTestFunction(): void
    {
        $value13 = $this->factroy->createIsbn13FromString('978-3-8273-3014-7');
        $value10 = $this->factroy->createIsbn10FromString('3827330149');
    }
}
```

### Prüfsumme

Bei der Erstellung des Objekts wird eine Validierung durchgeführt. Bei dieser wird auch die
[Prüfsumme](https://de.wikipedia.org/wiki/Internationale_Standardbuchnummer#Formeln_zur_Berechnung_der_Pr%C3%BCfziffer)
kontrolliert. __Es können also nur gültige ISBN erstellt werden, bei denen die Prüfsumme korekkt ist.__


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php
use Esit\Valueobjects\Classes\Isbn\Services\Factories\IsbnFactory;

class myClass
{
    public function __constructor(private readonly IsbnFactory $factory)
    {
    }

    public function myTestFunction(): void
    {
        $value13 = $this->factroy->createIsbn13FromString('978-3-8273-3014-7');
        $value10 = $this->factroy->createIsbn10FromString('3827330149');

        echo $value13;          // gibt "978-3-8273-3014-7" aus
        echo $value13->value(); // gibt "978-3-8273-3014-7" aus

        echo $value10;          // gibt "3827330149" aus
        echo $value10->value(); // gibt "3827330149" aus
    }
}
```