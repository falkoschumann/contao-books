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
$GLOBALS['TL_LANG']['tl_chapter']['title']     = array('Titel', 'Bitte geben Sie den Kapiteltitel ein.');
$GLOBALS['TL_LANG']['tl_chapter']['alias']     = array('Kapitelalias', 'Der Kapitelalias ist eine eindeutige Referenz, die anstelle der numerischen Kapitel-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_chapter']['type']      = array('Kapiteltyp');
$GLOBALS['TL_LANG']['tl_chapter']['tags']      = array('Tags', 'Kommagetrennte Liste von Tags für das Kapitel; z.B. "Geprüft", "Unvollständig" oder "in Bearbeitung"');
$GLOBALS['TL_LANG']['tl_chapter']['cssID']     = array('CSS-ID/Klasse', 'Hier können Sie eine ID und beliebig viele Klassen eingeben.');
$GLOBALS['TL_LANG']['tl_chapter']['hide']      = array('Kapitel im Inhaltsverzeichnis verstecken', 'Ist das Häckchen gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');
$GLOBALS['TL_LANG']['tl_chapter']['published'] = array('Kapitel veröffentlichen', 'Das Kapitel auf der Webseite anzeigen.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_chapter']['chapter_legend'] = 'Kapitel';
$GLOBALS['TL_LANG']['tl_chapter']['meta_legend']    = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_chapter']['expert_legend']  = 'Experten-Einstellungen';
$GLOBALS['TL_LANG']['tl_chapter']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_chapter']['editbookheader'] = array('Bucheinstellungen bearbeiten', 'Einstellungen des Buches ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_chapter']['new']            = array('Neues Kapitel', 'Ein neues Kapitel anlegen');
$GLOBALS['TL_LANG']['tl_chapter']['edit']           = array('Kapitel bearbeiten', 'Kapitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_chapter']['editheader']     = array('Kapiteleinstellungen bearbeiten', 'Einstellungen des Kapitels ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_chapter']['copy']           = array('Kapitel duplizieren', 'Kapitel ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_chapter']['copyChilds']     = array('Kapitel mit Unterkapitel duplizieren', 'Kapitel ID %s inklusive Unterkapitel duplizieren');
$GLOBALS['TL_LANG']['tl_chapter']['cut']            = array('Kapitel verschieben', 'Kapitel ID %s verschieben');
$GLOBALS['TL_LANG']['tl_chapter']['delete']         = array('Kapitel löschen', 'Kapitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_chapter']['toggle']         = array('Kapitel veröffentlichen/unveröffentlichen', 'Kapitel ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_chapter']['show']           = array('Kapiteldetails', 'Details des Kapitels ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_chapter']['pasteafter']     = array('Einfügen nach', 'Nach dem Kapitel ID %s einfügen');
$GLOBALS['TL_LANG']['tl_chapter']['pasteinto']      = array('Einfügen in', 'In das Kapitel ID %s einfügen');
