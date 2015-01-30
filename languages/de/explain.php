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
	array('{{bookchapter::*}}', 'Fügt einen Link zu einem Kapitel dieses Buches ein. Der Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.'),
	array('{{bookchapter_open::*}}Click here{{link_close}}', 'Fügt einen Link zu einem anderen Kapitel dieses Buches ein. Der Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.'),
	array('{{bookchapter_url::*}}', 'Fügt die URL zu einem Kapitel dieses Buches ein. Der Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.'),
	array('{{bookchapter_title::*}}', 'Fügt den Titel eines Kapitels dieses Buches ein. Der Stern * muss durch die ID oder den Alias des Kapitels ersetzt werden.')
);
