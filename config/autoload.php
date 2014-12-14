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
