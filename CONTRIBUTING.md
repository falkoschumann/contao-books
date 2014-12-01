Contributing Guidelines
=======================

**Common field order:** id, pid, sorting, tstamp, title, alias, ...


Code Style
----------

**File Header:**

    /*
     * Books Extension for Contao
     * Copyright (c) 2014, Falko Schumann <http://www.muspellheim.de>
     * All rights reserved.
     *
     * Redistribution and use in source and binary forms, with or without
     * modification, are permitted provided that the following conditions are met:
     *
     *  - Redistributions of source code must retain the above copyright notice,
     *    this list of conditions and the following disclaimer.
     *  - Redistributions in binary form must reproduce the above copyright notice,
     *    this list of conditions and the following disclaimer in the documentation
     *    and/or other materials  provided with the distribution.
     *
     * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
     * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
     * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
     * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
     * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
     * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
     * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
     * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
     * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
     * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
     * POSSIBILITY OF SUCH DAMAGE.
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
