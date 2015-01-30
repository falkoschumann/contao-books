<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Models
 * @link https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * The model for book.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Models
 * @property int     $id             Die ID des Buches
 * @property int     $tstamp         Das Änderungsdatum der Metainformationen des Buches
 * @property string  $title          Der Titel des Buches
 * @property string  $alias          Der Buchalias
 * @property string  $subtitle       Der Untertitel des Buches
 * @property string  $author         Der Autor des Buches
 * @property string  $year           Das Erscheinungsjahr des Buches
 * @property string  $palce          Der Erscheinungsort des Buches
 * @property string  $language       Die Sprache des Buches
 * @property string  $tags           Kommagetrennte Liste von Tags zur Katalogisierung von Büchern
 * @property string  $abstract       Abstract oder Einleitung zum Buch
 * @property boolean $published      Flag ob das Buch veröffentlicht ist
 */
class BookModel extends \Model
{

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

		if (!BE_USER_LOGGED_IN) {
			$arrColumns[] = "$t.published=1";
		}
		return static::findOneBy($arrColumns, $id);
	}

}
