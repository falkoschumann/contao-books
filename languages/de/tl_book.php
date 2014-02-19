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
$GLOBALS['TL_LANG']['tl_book']['title']     = array('Titel', 'Bitte geben Sie den Buchtitel ein.');
$GLOBALS['TL_LANG']['tl_book']['subtitle']  = array('Untertitel', 'Geben Sie dem Buch optional einen Untertitel.');
$GLOBALS['TL_LANG']['tl_book']['alias']     = array('Buchalias', 'Der Buchalias ist eine eindeutige Referenz, die anstelle der numerischen Buch-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book']['author']    = array('Autor', 'Hier können Sie den Autor des Buches angeben.');
$GLOBALS['TL_LANG']['tl_book']['language']  = array('Sprache', 'Bitte geben Sie die Sprache des Buches gemäß des ISO-639-1 Standards ein (z.B. "de" für Deutsch).');
$GLOBALS['TL_LANG']['tl_book']['category']  = array('Kategorie', 'Kategorie oder Kategorien des Buches, z.B. "Buch", "Satsang" oder "Sat Sandesh"');
$GLOBALS['TL_LANG']['tl_book']['note']      = array('Notiz', '');
$GLOBALS['TL_LANG']['tl_book']['text']      = array('Vorwort', 'Sie können HTML-Tags verwenden, um den Text zu formatieren.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Buch veröffentlichen', 'Das Buch auf der Webseite anzeigen.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend']    = 'Buch';
$GLOBALS['TL_LANG']['tl_book']['meta_legend']    = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_book']['text_legend']    = 'Vorwort';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new']        = array('Neues Buch', 'Ein neues Buch anlegen');
$GLOBALS['TL_LANG']['tl_book']['edit']       = array('Buch bearbeiten', 'Buch ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['editheader'] = array('Buch-Einstellungen bearbeiten', 'Einstellungen des Buches ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book']['copy']       = array('Buch duplizieren', 'Buch ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book']['delete']     = array('Buch löschen', 'Buch ID %s löschen');
$GLOBALS['TL_LANG']['tl_book']['toggle']     = array('Buch veröffentlichen/unveröffentlichen', 'Buch ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book']['show']       = array('Buchdetails', 'Details des Buches ID %s anzeigen');
