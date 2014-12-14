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
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book']['title'] = array('Title', 'Please enter the book title.');
$GLOBALS['TL_LANG']['tl_book']['subtitle'] = array('Sub title', 'Optional enter a sub title for the book.');
$GLOBALS['TL_LANG']['tl_book']['alias'] = array('Book alias', 'The book alias is an unique reference to the book which can be called instead of its numeric ID.');
$GLOBALS['TL_LANG']['tl_book']['author'] = array('Author', 'Here you can enter the author of the book.');
$GLOBALS['TL_LANG']['tl_book']['language'] = array('Language', 'Please enter the page language according to the ISO-639-1 standard (e.g. "en" for English)');
$GLOBALS['TL_LANG']['tl_book']['category'] = array('Category', 'Category or categories of the book, e.g. "Book", "Satsang" or "Sat Sandesh"');
$GLOBALS['TL_LANG']['tl_book']['abstract'] = array('Abstract', 'You can use HTML tags to format the text.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Publish book', 'Make the book publicly visible on the website.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend'] = 'Book';
$GLOBALS['TL_LANG']['tl_book']['meta_legend'] = 'Meta information';
$GLOBALS['TL_LANG']['tl_book']['abstract_legend'] = 'Abstract';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Publish settings';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new'] = array('New book', 'Create a new book');
$GLOBALS['TL_LANG']['tl_book']['edit'] = array('Edit book', 'Edit book ID %s');
$GLOBALS['TL_LANG']['tl_book']['editheader'] = array('Edit book settings', 'Edit the settings of book ID %s');
$GLOBALS['TL_LANG']['tl_book']['copy'] = array('Duplicate book', 'Duplicate book ID %s');
$GLOBALS['TL_LANG']['tl_book']['delete'] = array('Delete book', 'Delete book ID %s');
$GLOBALS['TL_LANG']['tl_book']['toggle'] = array('Publish/unpublish book', 'Publish/unpublish book ID %s');
$GLOBALS['TL_LANG']['tl_book']['show'] = array('Book details', 'Show the details of book ID %s');
