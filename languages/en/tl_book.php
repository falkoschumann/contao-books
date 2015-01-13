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
