<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2016 Falko Schumann
 *
 * @link 	https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'books' => array
	(
		'tables' => array('tl_book', 'tl_chapter', 'tl_content'),
		'icon'   => 'system/modules/books/assets/book.png'
	)
));


/**
 * Content elements
 */
array_insert($GLOBALS['TL_CTE']['includes'], 0, array('book' => '\Muspellheim\Books\ContentBook'));


/**
 * Insert tags
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\Muspellheim\Books\BookInsertTags', 'replaceBookInsertTags');


/**
 * Model mappings
 */
$GLOBALS['TL_MODELS'][\Muspellheim\Books\BookModel::getTable()]    = '\Muspellheim\Books\BookModel';
$GLOBALS['TL_MODELS'][\Muspellheim\Books\ChapterModel::getTable()] = '\Muspellheim\Books\ChapterModel';
