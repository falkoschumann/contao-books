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
	array('{{bookchapter::*}}', 'Insère un lien vers un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_open::*}}Cliquez ici{{link_close}}', 'Insère un lien vers un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_url::*}}', 'Insère l\'URL d\'un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_title::*}}', 'Insère le titre d\'un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.')
);
