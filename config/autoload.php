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
	'Muspellheim\Books\Books'          => 'system/modules/books/classes/Books.php',
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
