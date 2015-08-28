Books Extension für Contao
==========================

Contao bietet die Möglichkeit mit Hilfe des Moduls *Buchnavigation* innerhalb
der Seitenstruktur wie durch ein Buch zu navigieren. Diese Erweiterung geht
einen Schritt weiter und erlaubt es eigenständige Bücher zu definieren, die sich
in Artikeln als Inhaltselement einfügen lassen.

Die Erweiterung kann über das
[Contao Extension Repository](https://contao.org/extension-list/view/books.html)
installiert werden.

Verwendung
----------

Hinter dem neuen Menüpunkt *Bücher* werden im Backend die Bücher verwaltet.
Jedes Buch kann beliebig viele Kapitel und Unterkapitel enthalten. Der Inhalt
der Kapitel wird wie bei Artikeln durch Inhaltselemente definiert. 

Innerhalb eines Buches kann mit den folgenden Insertags zwischen den Kapiteln
eines Buches verlinkt werden.

* `{{bookchapter::*}}` Fügt einen Link zu einem Kapitel dieses Buches ein. Der
  Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.
* `{{bookchapter_open::*}}Click here{{link_close}}` Fügt einen Link zu einem
  anderen Kapitel dieses Buches ein. Der Stern * muss durch die ID oder den
  Alias des Kapitels ersetzt werden.
* `{{bookchapter_url::*}}` Fügt die URL zu einem Kapitel dieses Buches ein. Der
  Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.
* `{{bookchapter_title::*}}` Fügt den Titel eines Kapitels dieses Buches ein.
  Der Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.
