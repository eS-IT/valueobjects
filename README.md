# Valueobjects


## Beschreibung

Bei diesem Paket handelt es sich um eine Sammlung an [Wertobjekten](https://de.wikipedia.org/wiki/Value_Object).
Mit den Wertobjekten kann primitiven Datentypen eine Bedeutung verliehen werden. Es kann so sichergestellt werden,
dass es sich z.B. bei einem String um einen Geldbetrag, eine E-Mail-Adresse, IBAN, ISBN, ... handelt.
Wertobjekte zeichnen sich u.a. dadurch aus, dass sie beim Erstellen den Wert validieren. Kann ein Objekt erstellt
werden, ist es immer ein gültiges Objekt (also ein Objekt mit einem gültigen Wert). Außerdem sind Wertobjekte
unveränderbar. Es wird bei jeder Änderung des Werts ein neues Objekt erzeugt.

Da es unmöglich ist auf Anhieb eine Sammlung aller möglichen Wertobjekte zu erstellen,
kann die Sammlung bei Bedarf stätig erweitert werden.

(__Das Paket richtet sich an Entwickler, die es in ihren Projekten einsetzen möchten, nicht an Endanwender!__)


## Autor

__e@sy Solutions IT:__ Patrick Froch <info@easySolutionsIT.de>


## Voraussetzungen

- php: ^8.0
- symfony/symfony:~5.0


## Installation

Das Paket kann einfach mit Composer installiert werden:

```shell
composer require esit/valueobjects
```


## Usage

Die Verwendung der einzelnen Wertobjekte wird im jeweiligen Ordner unter `Classes` beschrieben:

- [`Classes/Email`](Classes/Email/README.md)
- [`Classes/Ip`](Classes/Ip/README.md)
- [`Classes/Isbn`](Classes/Isbn/README.md)
- [`Classes/Money`](Classes/Money/README.md)
- [`Classes/Url`](Classes/Url/README.md)