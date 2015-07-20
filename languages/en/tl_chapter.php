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
$GLOBALS['TL_LANG']['tl_chapter']['title']     = array('Title', 'Please enter the chapter title');
$GLOBALS['TL_LANG']['tl_chapter']['alias']     = array('Chapter alias', 'The chapter alias is an unique reference to the chapter which can be called instead of its numeric id.');
$GLOBALS['TL_LANG']['tl_chapter']['note']      = array('Note', '');
$GLOBALS['TL_LANG']['tl_chapter']['text']      = array('Text', 'You can use HTML tags to format the text.');
$GLOBALS['TL_LANG']['tl_chapter']['published'] = array('Publish chapter', 'Make the chapter publicly visible on the website.');
$GLOBALS['TL_LANG']['tl_chapter']['hide']      = array('Show chapter in table of content', 'If this checkbox is unchecked there is no link to chapter in table of content.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_chapter']['chapter_legend'] = 'Chapter';
$GLOBALS['TL_LANG']['tl_chapter']['meta_legend']    = 'Meta information';
$GLOBALS['TL_LANG']['tl_chapter']['text_legend']    = 'Text';
$GLOBALS['TL_LANG']['tl_chapter']['publish_legend'] = 'Publish settings';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_chapter']['new']        = array('New chapter', 'Create a new chapter');
$GLOBALS['TL_LANG']['tl_chapter']['edit']       = array('Edit chapter', 'Edit chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['editheader'] = array('Edit chapter settings', 'Edit the settings of the chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['copy']       = array('Duplicate chapter', 'Duplicate chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['delete']     = array('Delete chapter', 'Delete chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['toggle']     = array('Publish/unpublish chapter', 'Publish/unpublish chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['show']       = array('Chapter details', 'Show the details of chapter ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['pastenew']   = array('Add new at the top', 'Add new after chapter ID %s');
