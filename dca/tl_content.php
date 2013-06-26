<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Books Extension for Contao
 * Copyright (c) 2012, Falko Schumann <http://www.muspellheim.de>
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
 * PHP version 5
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 * @filesource
 */


/**
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['book'] = '{type_legend},type;{include_legend},book;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['book'] = array
(
		'label' => &$GLOBALS['TL_LANG']['tl_content']['book'],
		'exclude' => true,
		'inputType' => 'select',
		'options_callback' => array('tl_content_book', 'getBooks'),
		'eval' => array('mandatory'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'long')
);

/**
 * Class tl_content_book
 *
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
*/
class tl_content_book extends Backend
{

	/**
	 * Get all books and return them as array
	 * @return array
	 */
	public function getBooks()
	{
		$arrBooks = array();
		$objBooks = $this->Database->execute("SELECT id, title, author, language FROM tl_book ORDER BY title");

		while ($objBooks->next())
		{
			$arrBooks[$objBooks->author][$objBooks->id] = $objBooks->title . ' (ID ' . $objBooks->id . ', ' . $objBooks->language . ')';
		}

		return $arrBooks;
	}

}

?>