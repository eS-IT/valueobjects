# Databsse

Bei diesem Objekt handelt es sich um ein Wertobjekt für Datenbank-, Tabellen- und Feldnamen. Es ist dazu gedacht,
dass diese Daten nicht immer als String angegeben werden müssen. Beim Erstellen eines Objekts, wird geprüft,
ob es eine entsprechende Ressource gibt. Es können also keine Objekte mit Namen erstellt werden, die es in
der verwendeten Datenbank nicht gibt.


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `DatabasenameValue`, ein `TabelnameValue`-
oder ein `Fieldname`-Objekt erstellt werden.

```php
<?php

use Esit\Valueobjects\Classes\Database\Services\Factories\DatabasenameFactory;

class myClass
{
    private UrlFactory $factory;

    public function __constructor(DatabasenameFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $dbName     = $this->factroy->createDatabasenameFromString('contao_test_database');
        $tableName  = $this->factroy->createTablenameFromString('contao_test_table');
        $fiedName   = $this->factroy->createFieldnameFromString('contao_test_field', $tableName);
    }
}
```

_(Der Methode `createFieldnameFromString` kann als zweiter Parameter sowohl ein String als auch ein `TablenameValue` übergeben werden.)_


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php

use Esit\Valueobjects\Classes\Database\Services\Factories\DatabasenameFactory;

class myClass
{
    private IbanFactory $factory;

    public function __constructor(DatabasenameFactory $factory)
    {
        $this->factroy = $factory;
    }

    public function myTestFunction(): void
    {
        $dbName     = $this->factroy->createDatabasenameFromString('contao_test_database');
        $tableName  = $this->factroy->createTablenameFromString('contao_test_table');
        $fiedName   = $this->factroy->createFieldnameFromString('contao_test_field', $tableName);

        echo $dbName;               // gibt "contao_test_database" aus
        echo $dbName->value();      // gibt "contao_test_database" aus

        echo $tableName;            // gibt "contao_test_table" aus
        echo $tableName->value();   // gibt "contao_test_table" aus

        echo $fiedName;             // gibt "contao_test_field" aus
        echo $fiedName->value();    // gibt "contao_test_field" aus
    }
}
```