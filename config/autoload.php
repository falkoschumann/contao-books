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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Muspellheim\Books',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Muspellheim\Books\BaseBooks'      => 'system/modules/books/classes/BaseBooks.php',
	'Muspellheim\Books\BookInsertTags' => 'system/modules/books/classes/BookInsertTags.php',
	'Muspellheim\Books\BookParser'     => 'system/modules/books/classes/BookParser.php',
	'Muspellheim\Books\ChapterParser'  => 'system/modules/books/classes/ChapterParser.php',

	// Elements
	'Muspellheim\Books\ContentBook'    => 'system/modules/books/elements/ContentBook.php',

	// Models
	'Muspellheim\Books\BookModel'      => 'system/modules/books/models/BookModel.php',
	'Muspellheim\Books\ChapterModel'   => 'system/modules/books/models/ChapterModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_book'       => 'system/modules/books/templates',
	'books_book'    => 'system/modules/books/templates',
	'books_chapter' => 'system/modules/books/templates',
));
