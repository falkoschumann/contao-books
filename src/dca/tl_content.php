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
 * Extension of data container array for table `tl_content`
 *
 * There are two extensions. Content elements used to define chapters content.
 * Introduce a new content element to insert a book.
 */

/**
 * Add parent to tl_content.
 */
if (\Input::get('do') == 'books')
{
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_chapter';
}

/**
 * Add palettes to tl_content.
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['book'] = '{type_legend},type;{include_legend},book;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';


/**
 * Add fields to tl_content.
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['book'] = array
(
	'label'            => &$GLOBALS['TL_LANG']['tl_content']['book'],
	'exclude'          => true,
	'inputType'        => 'select',
	'options_callback' => array('tl_content_book', 'getBooks'),
	'eval'             => array('mandatory' => true, 'chosen' => true, 'submitOnChange' => true, 'tl_class' => 'long'),
	'sql'              => "int(10) unsigned NOT NULL default '0'"
);

/**
 * Class tl_content_book
 *
 * @author Falko Schumann <falko.schumann@muspellheim.de>
 */
class tl_content_book extends Backend
{

	/**
	 * Get all books and return them as array
	 *
	 * @return array
	 */
	public function getBooks()
	{
		$arrBooks = array();
		$objBooks = $this->Database->execute("SELECT id, title, subtitle, author, language FROM tl_book ORDER BY title, subtitle");

		while ($objBooks->next())
		{
			$item = $objBooks->title;
			//$item .= $objBooks->subtitle ? '. ' . $objBooks->subtitle : '';
			$item .= ' (';
			//$item .= $objBooks->language ?  $this->getLanguages()[$objBooks->language] . ', ' : '';
			$item .= $objBooks->language ? $objBooks->language . ', ' : '';
			$item .= 'ID ' . $objBooks->id;
			$item .= ')';
			$arrBooks[$objBooks->author][$objBooks->id] = $item;
		}

		return $arrBooks;
	}

}
