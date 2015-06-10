<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Muspellheim',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'Muspellheim\ContentBook' => 'system/modules/books/elements/ContentBook.php',

	// Models
	'Muspellheim\BookModel'   => 'system/modules/books/models/BookModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_book' => 'system/modules/books/templates',
));
