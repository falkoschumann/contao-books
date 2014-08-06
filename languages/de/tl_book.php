<?php

/**
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
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book']['title'] = array('Titel', 'Bitte geben Sie den Buchtitel ein.');
$GLOBALS['TL_LANG']['tl_book']['alias'] = array('Buchalias', 'Der Buchalias ist eine eindeutige Referenz, die anstelle der numerischen Buch-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book']['subtitle'] = array('Untertitel', 'Geben Sie dem Buch optional einen Untertitel.');
$GLOBALS['TL_LANG']['tl_book']['author'] = array('Autor', 'Hier können Sie den Autor des Buches angeben.');
$GLOBALS['TL_LANG']['tl_book']['language'] = array('Sprache', 'Bitte geben Sie die Sprache des Buches gemäß des ISO-639-1 Standards ein (z.B. "de" für Deutsch).');
$GLOBALS['TL_LANG']['tl_book']['tags'] = array('Tags', 'Kommagetrennte Liste von Tags für das Buch; z.B. "Buch", "Satsang" oder "Sat Sandesh"');
$GLOBALS['TL_LANG']['tl_book']['abstract'] = array('Zusammenfassung', 'Sie können HTML-Tags verwenden, um den Text zu formatieren.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Buch veröffentlichen', 'Das Buch auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_book']['show_in_toc'] = array('Kapitel im Inhaltsverzeichnis anzeigen', 'Ist das Häckchen nicht gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');

$GLOBALS['TL_LANG']['tl_book_chapter']['title'] = array('Titel', 'Bitte geben Sie den Kapiteltitel ein.');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias'] = array('Kapitelalias', 'Der Kapitelalias ist eine eindeutige Referenz, die anstelle der numerischen Kapitel-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Kapitel veröffentlichen', 'Das Kapitel auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_book_chapter']['show_in_toc'] = array('Kapitel im Inhaltsverzeichnis anzeigen', 'Ist das Häckchen nicht gesetzt, erscheint kein Link zum Kapitel im Inhaltsverzeichnis.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend'] = 'Buch';
$GLOBALS['TL_LANG']['tl_book']['meta_legend'] = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_book']['abstract_legend'] = 'Zusammenfassung';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Veröffentlichung';

$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Kapitel';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new'] = array('Neues Buch', 'Ein neues Buch anlegen');
$GLOBALS['TL_LANG']['tl_book']['edit'] = array('Buch bearbeiten', 'Buch ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['editheader'] = array('Buch-Einstellungen bearbeiten', 'Einstellungen des Buches ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['copy'] = array('Buch duplizieren', 'Buch ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book']['delete'] = array('Buch löschen', 'Buch ID %s löschen');
$GLOBALS['TL_LANG']['tl_book']['toggle'] = array('Buch veröffentlichen/unveröffentlichen', 'Buch ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book']['show'] = array('Buchdetails', 'Details des Buches ID %s anzeigen');

$GLOBALS['TL_LANG']['tl_book_chapter']['new'] = array('Neues Kapitel', 'Ein neues Kapitel anlegen');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit'] = array('Kapitel bearbeiten', 'Kapitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'] = array('Kapitel bearbeiten', 'Kapiteleinstellungen bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy'] = array('Kapitel duplizieren', 'Kapitel ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete'] = array('Kapitel löschen', 'Kapitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle'] = array('Kapitel veröffentlichen/unveröffentlichen', 'Kapitel ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book_chapter']['show'] = array('Kapiteldetails', 'Details des Kapitels ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteafter'] = array('Einfügen nach', 'Nach dem Kapitel ID %s einfügen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pasteinto'] = array('Einfügen in', 'In das Kapitel ID %s einfügen');
