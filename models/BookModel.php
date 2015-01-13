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
