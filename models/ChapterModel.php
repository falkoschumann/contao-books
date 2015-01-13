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
 * The model for chapter.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Models
 * @property int     $id             Die ID des Kapitels
 * @property int     $pid            Die ID des übergeordneten Kapitels
 * @property int     $sorting        Der Sortierindex des Kapitels
 * @property int     $tstamp         Das Änderungsdatum der Metainformationen des Kapitels
 * @property string  $title          Der Titel des Kapitels
 * @property string  $alias          Der Kapitelalias
 * @property boolean $published      Flag ob das Kapitel veröffentlicht ist
 * @property boolean $book_id        Die ID des Buches zu dem das Kapitel gehört
 * @property boolean $show_in_toc    Das Kapitel im Inhaltsverzeichnis anzeigen
 */
class ChapterModel extends \Model
{

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected static $strTable = 'tl_book_chapter';


	public function __get($key)
	{
		switch ($key)
		{
			case 'relatedBook':
				return $this->getRelated('pid');
			default:
				return parent::__get($key);
		}
	}


	/**
	 * @param int $pid
	 * @return ChapterModel|Collection|null
	 */
	public static function findPublishedByPid($pid)
	{
		$t = static::$strTable;
		$columns = array("$t.pid=?");
		$options['order'] = "$t.pid, $t.sorting";

		if (!BE_USER_LOGGED_IN)
		{
			$columns[] = "$t.published=1";
		}
		return static::findBy($columns, $pid, $options);
	}


	/**
	 * @param int $id
	 * @return ChapterModel|null
	 */
	public static function findPublishedById($id)
	{
		$t = static::$strTable;
		$columns = array("$t.id=?");

		if (!BE_USER_LOGGED_IN)
		{
			$columns[] = "$t.published=1";
		}
		return static::findOneBy($columns, $id);
	}


	/**
	 * @param ChapterModel $chapter
	 * @return ChapterModel|null
	 */
	public static function findPreviousPublishedFor($chapter)
	{
		$t = static::$strTable;
		$columns = array("$t.pid=?", "$t.sorting<?");

		if (!BE_USER_LOGGED_IN)
		{
			$columns[] = "$t.published=1";
		}
		$options = array
		(
			'order' => 'sorting DESC'
		);
		return static::findOneBy($columns, array($chapter->pid, $chapter->sorting), $options);

	}


	/**
	 * @param ChapterModel $chapter
	 * @return ChapterModel|null
	 */
	public static function findNextPublishedFor($chapter)
	{
		$t = static::$strTable;
		$columns = array("$t.pid=?", "$t.sorting>?");

		if (!BE_USER_LOGGED_IN)
		{
			$columns[] = "$t.published=1";
		}
		$options = array
		(
			'order' => 'sorting'
		);
		return static::findOneBy($columns, array($chapter->pid, $chapter->sorting), $options);
	}


	/**
	 * @param int book_id
	 * @return array
	 */
	public static function findChapterIdsByBookIds($book_id)
	{
		$books = static::findBy('book_id', $book_id);
		$arrIds = array();
		if ($books)
		{
			foreach ($books as $book)
			{
				$arrIds[] = $book->id;
			}
		}
		return $arrIds;
	}

}
