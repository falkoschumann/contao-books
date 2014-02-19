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
$GLOBALS['TL_LANG']['tl_book_chapter']['title']     = array('Title', 'Please enter the chapter title');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias']     = array('Chapter alias', 'The chapter alias is an unique reference to the chapter which can be called instead of its numeric id.');
$GLOBALS['TL_LANG']['tl_book_chapter']['note']      = array('Note', '');
$GLOBALS['TL_LANG']['tl_book_chapter']['text']      = array('Text', 'You can use HTML tags to format the text.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Publish chapter', 'Make the chapter publicly visible on the website.');
$GLOBALS['TL_LANG']['tl_book_chapter']['show_in_toc'] = array('Show chapter in table of content', 'If this checkbox is unchecked there is no link to chapter in table of content.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Chapter';
$GLOBALS['TL_LANG']['tl_book_chapter']['meta_legend']    = 'Meta information';
$GLOBALS['TL_LANG']['tl_book_chapter']['text_legend']    = 'Text';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Publish settings';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['new']        = array('New chapter', 'Create a new chapter');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit']       = array('Edit chapter', 'Edit chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'] = array('Edit chapter settings', 'Edit the settings of the chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy']       = array('Duplicate chapter', 'Duplicate chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete']     = array('Delete chapter', 'Delete chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle']     = array('Publish/unpublish chapter', 'Publish/unpublish chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['show']       = array('Chapter details', 'Show the details of chapter ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['pastenew']   = array('Add new at the top', 'Add new after chapter ID %s');
