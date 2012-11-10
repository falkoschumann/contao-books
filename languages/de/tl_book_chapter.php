<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Books Extension for Contao
 * Copyright (c) 2012, Falko Schumann <http://www.muspellheim.de>
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
 *  - Neither the name of the Muspellheim.de nor the names of its contributors
 *    may be used to endorse or promote products derived from this software
 *    without specific prior written  permission.
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
 * PHP version 5
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-3-clause
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['title']     = array('Titel', 'Bitte geben Sie den Kapiteltitel ein.');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias']     = array('Kapitelalias', 'Der Kapitelalias ist eine eindeutige Referenz, die anstelle der numerischen Kapitel-ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_book_chapter']['note']      = array('Notiz', '');
$GLOBALS['TL_LANG']['tl_book_chapter']['text']      = array('Text', 'Sie können HTML-Tags verwenden, um den Text zu formatieren.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Kapitel veröffentlichen', 'Das Kapitel auf der Webseite anzeigen.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Kapitel';
$GLOBALS['TL_LANG']['tl_book_chapter']['meta_legend']    = 'Meta-Informationen';
$GLOBALS['TL_LANG']['tl_book_chapter']['text_legend']    = 'Text';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['new']        = array('Neues Kapitel', 'Ein neues Kapitel anlegen');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit']       = array('Kapitel bearbeiten', 'Kapitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'] = array('Kapitel bearbeiten', 'Die Kapiteleinstellungen bearbeiten');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy']       = array('Kapitel duplizieren', 'Kapitel ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete']     = array('Kapitel löschen', 'Kapitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle']     = array('Kapitel veröffentlichen/unveröffentlichen', 'Kapitel ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_book_chapter']['show']       = array('Kapiteldetails', 'Details des Kapitels ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_book_chapter']['pastenew']   = array('Neues Kapitel oben erstellen', 'Neues Kapitel nach dem Kapitel ID %s erstellen');

?>