<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['tstamp']    = array('Änderungsdatum', 'Datum und Uhrzeit der letzten Änderung.');
$GLOBALS['TL_LANG']['tl_book_chapter']['title']     = array('Titel', 'Bitte geben Sie den Kapiteltitel ein.');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias']     = array('Kapitelalias', 'Der Kapitelalias ist eine eindeutige Referenz, die anstelle der numerischen Kapitel-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Kapitel veröffentlichen', 'Das Kapitel auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_book_chapter']['tags']      = array('Tags', 'Kommagetrennte Liste von Tags für das Kapitel; z.B. "Geprüft", "Unvollständig" oder "in Bearbeitung"');
$GLOBALS['TL_LANG']['tl_book_chapter']['book_id']   = array('Buch', 'Das Kapitel gehört zu diesem Buch.');
$GLOBALS['TL_LANG']['tl_book_chapter']['hide']      = array('Kapitel im Inhaltsverzeichnis anzeigen', 'Ist das Häckchen nicht gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');
// TODO type ergänzen


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Kapitel';
$GLOBALS['TL_LANG']['tl_book_chapter']['meta_legend']    = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['editbookheader'] = array('Bucheinstellungen bearbeiten', 'Einstellungen des Buches ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['new']            = array('Neues Kapitel', 'Ein neues Kapitel anlegen');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit']           = array('Kapitel bearbeiten', 'Kapitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader']     = array('Kapiteleinstellungen bearbeiten', 'Einstellungen des Kapitels ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy']           = array('Kapitel duplizieren', 'Kapitel ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['copyChilds']     = array('Kapitel mit Unterkapitel duplizieren', 'Kapitel ID %s inklusive Unterkapitel duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['cut']            = array('Kapitel verschieben', 'Kapitel ID %s verschieben');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete']         = array('Kapitel löschen', 'Kapitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle']         = array('Kapitel veröffentlichen/unveröffentlichen', 'Kapitel ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book_chapter']['show']           = array('Kapiteldetails', 'Details des Kapitels ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteafter']     = array('Einfügen nach', 'Nach dem Kapitel ID %s einfügen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteinto']      = array('Einfügen in', 'In das Kapitel ID %s einfügen');
