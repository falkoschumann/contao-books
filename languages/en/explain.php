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
 * Insert tags
 */
$GLOBALS['TL_LANG']['XPL']['bookchapter_text'] = array
(
	array('{{bookchapter::*}}', 'Insert a link to a chapter of this book. The star * must be replaced by id or alias of the chapter.'),
	array('{{bookchapter_open::*}}Click here{{link_close}}', 'Insert a link to a chapter of this book. The star * must be replaced by id or alias of the chapter.'),
	array('{{bookchapter_url::*}}', 'Insert the url to a chapter of this book. The star * must be replaced by id or alias of the chapter.'),
	array('{{bookchapter_title::*}}', 'Insert the title of a chapter of this book. The star * must be replaced by id or alias of the chapter.')
);
