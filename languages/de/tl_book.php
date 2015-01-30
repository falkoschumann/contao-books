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
$GLOBALS['TL_LANG']['tl_book']['title'] = array('Titel', 'Bitte geben Sie den Buchtitel ein.');
$GLOBALS['TL_LANG']['tl_book']['alias'] = array('Buchalias', 'Der Buchalias ist eine eindeutige Referenz, die anstelle der numerischen Buch-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book']['subtitle'] = array('Untertitel', 'Geben Sie dem Buch optional einen Untertitel.');
$GLOBALS['TL_LANG']['tl_book']['author'] = array('Autor', 'Hier können Sie den Autor des Buches angeben.');
$GLOBALS['TL_LANG']['tl_book']['year'] = array('Jahr', 'Bitte geben Sie das Erscheinungsjahr des Buches ein.');
$GLOBALS['TL_LANG']['tl_book']['place'] = array('Ort', 'Bitte geben Sie den Erscheingsort des Buches ein.');
$GLOBALS['TL_LANG']['tl_book']['language'] = array('Sprache', 'Bitte geben Sie die Sprache des Buches gemäß des ISO-639-1 Standards ein (z.B. "de" für Deutsch).');
$GLOBALS['TL_LANG']['tl_book']['tags'] = array('Tags', 'Kommagetrennte Liste von Tags für das Buch; z.B. "Buch", "Satsang" oder "Sat Sandesh"');
$GLOBALS['TL_LANG']['tl_book']['abstract'] = array('Zusammenfassung', 'Sie können HTML-Tags verwenden, um den Text zu formatieren.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Buch veröffentlichen', 'Das Buch auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_book']['show_in_toc'] = array('Kapitel im Inhaltsverzeichnis anzeigen', 'Ist das Häckchen nicht gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend'] = 'Buch';
$GLOBALS['TL_LANG']['tl_book']['meta_legend'] = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_book']['abstract_legend'] = 'Zusammenfassung';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new'] = array('Neues Buch', 'Ein neues Buch anlegen');
$GLOBALS['TL_LANG']['tl_book']['edit'] = array('Buch bearbeiten', 'Buch ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['editheader'] = array('Bucheinstellungen bearbeiten', 'Einstellungen des Buches ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['copy'] = array('Buch duplizieren', 'Buch ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book']['delete'] = array('Buch löschen', 'Buch ID %s löschen');
$GLOBALS['TL_LANG']['tl_book']['toggle'] = array('Buch veröffentlichen/unveröffentlichen', 'Buch ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book']['show'] = array('Buchdetails', 'Details des Buches ID %s anzeigen');
