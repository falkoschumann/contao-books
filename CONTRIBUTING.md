Contributing Guidelines
=======================

**Common field order:** id, pid, sorting, tstamp, title, alias, type, ...

Die Übersetzungen aller Texte dieser Contao-Erweiterung werden auf
[Transifex][1] gepflegt.

Code Style
----------

**File Header:**

    /**
     * Books Extension for Contao
     *
     * Copyright (c) 2012-2015 Falko Schumann
     *
     * @package Books
     * @link https://github.com/falkoschumann/contao-books
     * @license http://opensource.org/licenses/MIT MIT
     */

  - Eingerückt wird mit Tabulator.
  - Die Zeilenlänge sollte 120 Zeichen nicht überschreiten.
  - Geschweifte Klammern stehen jeweils auf einer eigenen Zeile.
  - Felder in Klassen werden durch eine Leerzeile getrennt.
  - Methoden in Klassen werden durch zwei Leerzeilen getrennt.
  - In assoziativen Arrays werden Schlüssel und Wert als Spalten formatiert.

**Beispiel:**

    class Foo
    {

        public funtion foo($bar)
        {
            if ($bar)
            {
                $sql = array
                (
                    'keys' => array
                    (
                        'id'    => 'primary',
                        'pid'   => 'index',
                        'alias' => 'index',
                    )
                );
            }
        }

    }

[1]: https://www.transifex.com/falkoschumann/contao-books/
