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
