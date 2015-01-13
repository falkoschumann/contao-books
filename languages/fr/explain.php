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
 * Insert tags
 */
$GLOBALS['TL_LANG']['XPL']['bookchapter_text'] = array
(
	array('{{bookchapter::*}}', 'Insère un lien vers un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_open::*}}Cliquez ici{{link_close}}', 'Insère un lien vers un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_url::*}}', 'Insère l\'URL d\'un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.'),
	array('{{bookchapter_title::*}}', 'Insère le titre d\'un chapitre de ce livre. L\'étoile * doit être remplacée par l\'ID ou l\'alias du chapitre.')
);
