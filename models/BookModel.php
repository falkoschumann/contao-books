<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Models
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * The model for book.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Models
 * @property int     $id             book id
 * @property int     $tstamp         timestamp of last edit
 * @property string  $title          book title
 * @property string  $alias          URL alias
 * @property int     $root_chapter   id of the root chapter
 * @property string  $subtitle       book subtitle
 * @property string  $author         book author
 * @property string  $year           year of publication
 * @property string  $place          place of publication
 * @property string  $language       books language
 * @property string  $tags           comma seperated list of tags
 * @property boolean $published      show book in frontend?
 */
class BookModel extends \Model
{

	// TODO call root chapter by reference, instead of id

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected static $strTable = 'tl_book';


	/**
	 * @param int id
	 * @return BookModel|null
	 */
	public static function findPublishedById($id)
	{
		$t = static::$strTable;
		$arrColumns = array("$t.id=?");

		if (!BE_USER_LOGGED_IN)
		{
			$arrColumns[] = "$t.published=1";
		}
		return static::findOneBy($arrColumns, $id);
	}

}
