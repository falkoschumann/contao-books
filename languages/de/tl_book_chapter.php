<?php

/**
 * Books Extension for Contao
 * Copyright (c) 2015 Falko Schumann
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
 *
 * @package Books
 * @license MIT
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['tstamp'] = array('Änderungsdatum', 'Datum und Uhrzeit der letzten Änderung.');
$GLOBALS['TL_LANG']['tl_book_chapter']['title'] = array('Titel', 'Bitte geben Sie den Kapiteltitel ein.');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias'] = array('Kapitelalias', 'Der Kapitelalias ist eine eindeutige Referenz, die anstelle der numerischen Kapitel-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Kapitel veröffentlichen', 'Das Kapitel auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_book_chapter']['book_id'] = array('Buch', 'Das Kapitel gehört zu diesem Buch.');
$GLOBALS['TL_LANG']['tl_book_chapter']['show_in_toc'] = array('Kapitel im Inhaltsverzeichnis anzeigen', 'Ist das Häckchen nicht gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');



/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Kapitel';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['new'] = array('Neues Kapitel', 'Ein neues Kapitel anlegen');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit'] = array('Kapitel bearbeiten', 'Kapitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'] = array('Kapiteleinstellungen bearbeiten', 'Einstellungen des Kapitels ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy'] = array('Kapitel duplizieren', 'Kapitel ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['copyChilds'] = array('Kapitel mit Unterkapitel duplizieren', 'Kapitel ID %s inklusive Unterkapitel duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['cut'] = array('Kapitel verschieben', 'Kapitel ID %s verschieben');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete'] = array('Kapitel löschen', 'Kapitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle'] = array('Kapitel veröffentlichen/unveröffentlichen', 'Kapitel ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book_chapter']['show'] = array('Kapiteldetails', 'Details des Kapitels ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteafter'] = array('Einfügen nach', 'Nach dem Kapitel ID %s einfügen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteinto'] = array('Einfügen in', 'In das Kapitel ID %s einfügen');
