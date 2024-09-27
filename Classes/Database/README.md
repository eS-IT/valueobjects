# Databsse

Bei diesem Objekt handelt es sich um ein Wertobjekt für Datenbank-, Tabellen- und Feldnamen. Es ist dazu gedacht,
dass diese Daten nicht immer als String angegeben werden müssen. Beim Erstellen eines Objekts, wird geprüft,
ob es eine entsprechende Ressource gibt. Es können also keine Objekte mit Namen erstellt werden, die es in
der verwendeten Datenbank nicht gibt.


## NameInterfaces

Für die Namen der Datenbanken, Tabellen und Felder müssen in der Zielanwendung Aufzählungen (Enumeration) erstellt
werden. Diese diehnen dem Erstellen der Value-Objekte und sollten überall statt Strings für die Namen der Datenbanken,
Tabellen und Felder verwendet werden.

### DatabasenamesInterface

Die Aufzählung, die das DatabasenamesInterface implementiert, muss die Namen aller Datenbanken enthalten.
Aiw wird nur benötigt, wenn es mehr als eine Datenbank im Projekt gibt.

```php
use Esit\Valueobjects\Classes\Database\Enums\DatabasenamesInterface;

enum Databasenames implements DatabasenamesInterface
{
    case dev_test_db;
}
```

### TablenamesInterface

Die Aufzählung, die das TablenamesInterface implementiert, enthält die Namen aller relevanten Tabellen im Projekt.

```php
use Esit\Valueobjects\Classes\Database\Enums\TablenamesInterface;

enum Tablenames implements TablenamesInterface
{
    case tl_content;
    case tl_test_data;
}
```

### FieldnamesInterface

Die Aufzählungen, die die das FieldnamesInterface implementieren, enthalten die Namen aller Felder einer Tabelle. Es
muss für jede Tabelle eine Aufzählung mit den entsprechenden Feldern geben.


```php
use Esit\Valueobjects\Classes\Database\Enums\FieldnamesInterface;

enum TlContent implements FieldnamesInterface
{
    case id;
    case tstamp;
    case headline;
}

enum TlTestData implements FieldnamesInterface
{
    case id;
    case tstamp;
    case specialdata;
}
```


## Erstellung

Für die Erstellung des Objekts ist eine Factory vorhanden. Diese kann per Dependency Injection der eigenen
Klasse übergeben werden. Dann kann ganz einfach aus einem String ein `DatabasenameValue`, ein `TabelnameValue`-
oder ein `Fieldname`-Objekt erstellt werden.

```php
<?php

use Esit\Valueobjects\Classes\Database\Services\Factories\DatabasenameFactory;

class myClass
{
    public function __constructor(private readonly DatabasenameFactory $factory)
    {
    }

    public function myTestFunction(): void
    {
        // @deprecated Es sollten keine Strings verwendet werden!
        $dbName     = $this->factroy->createDatabasenameFromString('contao_test_database');         // @deprecated
        $tableName  = $this->factroy->createTablenameFromString('contao_test_table');               // @deprecated
        $fiedName   = $this->factroy->createFieldnameFromString('contao_test_field', $tableName);   // @deprecated

        $dbName     = $this->factroy->createDatabasenameFromInterface(Databasenames::dev_test_db);
        $tableName  = $this->factroy->createTablenameFromInterface(Tablenames::tl_test_data);
        $fiedName   = $this->factroy->createFieldnameFromInterface(TlTestData::id, $tableName);
    }
}
```

_(~~Der Methode `createFieldnameFromString` kann als zweiter Parameter sowohl ein String als auch ein `TablenameValue` übergeben werden.~~)_

_(Der Methode `createFieldnameFromInterface` kann als zweiter Parameter sowohl ein `TablenamesInterface` als auch ein `TablenameValue` übergeben werden.)_


## Verwendung

Will man den Wert ausgeben, ist die einfachste Form ein `echo`. Alternativ kann man auch die `value()`-Methode
verwenden.

```php
<?php

use Esit\Valueobjects\Classes\Database\Services\Factories\DatabasenameFactory;

class myClass
{
    public function __constructor(private readonly DatabasenameFactory $factory)
    {
    }

    public function myTestFunction(): void
    {
        $dbName     = $this->factroy->createDatabasenameFromInterface(Databasenames::dev_test_db);
        $tableName  = $this->factroy->createTablenameFromInterface(Tablenames::tl_test_data);
        $fiedName   = $this->factroy->createFieldnameFromInterface(TlTestData::id, $tableName);

        echo $dbName;               // gibt "contao_test_database" aus
        echo $dbName->value();      // gibt "contao_test_database" aus

        echo $tableName;            // gibt "contao_test_table" aus
        echo $tableName->value();   // gibt "contao_test_table" aus

        echo $fiedName;             // gibt "contao_test_field" aus
        echo $fiedName->value();    // gibt "contao_test_field" aus
    }
}
```