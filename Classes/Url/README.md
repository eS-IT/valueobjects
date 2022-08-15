# Url

Bei diesem Objekt handelt es sich um ein Wertobjekt für eine Url.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `Url`-Objekt erstellt werden.


```php
<?php
use Esit\Valueobjects\Classes\Url\Valueobjects\UrlValue;
use Esit\Valueobjects\Classes\Url\Services\Factories\UrlFactory;

class myClass
{
    private UrlFactory $factory;

    public function __constructor(UrlFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): UrlValue
    {
        return $this->factroy->createFromString('https://example.org/');
    }
}
```

Das Schema (http, https, ssh, ...) muss nicht angegeben werden. Will man die Angabe des Schemas erzwingen, übergibt
man als zweiten Parameter `true`:

```php
<?php
use Esit\Valueobjects\Classes\Url\Valueobjects\UrlValue;
use Esit\Valueobjects\Classes\Url\Services\Factories\UrlFactory;

class myClass
{
    private UrlFactory $factory;

    public function __constructor(UrlFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): UrlValue
    {
        return $this->factroy->createFromString('www.example.org', true);
    }
}
```

Dieser Aufruf würde einen Fehler erzeugen, da das Schema nicht angegeben wurde.

Als Schema sind folgende Protokolle erlaubt: http|https|ftp|ssh|sftp|smb. Wird ein anderes Schema benötigt, kann dies
als dritter Parameter übergeben werden:

```php
<?php
use Esit\Valueobjects\Classes\Url\Valueobjects\UrlValue;
use Esit\Valueobjects\Classes\Url\Services\Factories\UrlFactory;

class myClass
{
    private UrlFactory $factory;

    public function __constructor(UrlFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): UrlValue
    {
        return $this->factroy->createFromString('dav://www.example.org', true, 'dav');
    }
}
```

Es bietet sich an, in diesem Fall die Standardliste zu erweitern, um die anderen Protokolle weiter nutzen zu können:
`https?|ftp|ssh|sftp|smb|dav`


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php
use Esit\Valueobjects\Classes\Url\Services\Factories\UrlFactory;

class myClass
{
    private UrlFactory $factory;

    public function __constructor(UrlFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $value = $this->factroy->createFromString('https://example.org/');

        echo $value;            // gibt "https://example.org/" aus
        echo $value->value();   // gibt "https://example.org/" aus
    }
}
```