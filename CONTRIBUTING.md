Contributing Guidelines
=======================

**Common field order:** id, pid, sorting, tstamp, title, alias, ...


Code Style
----------

**File Header:**

    /*
     * Books Extension for Contao
     * Copyright (c) 2015 Falko Schumann <falko.schumann@muspellheim.de>
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in all
     * copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
     * SOFTWARE.
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
