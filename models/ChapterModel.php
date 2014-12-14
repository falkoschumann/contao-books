<?php

/*
 * Books Extension for Contao
 * Copyright (c) 2014, Falko Schumann <http://www.muspellheim.de>
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
 */


namespace Muspellheim\Books;


/**
 * The model for chapter.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 * @property int     $id             Die ID des Kapitels
 * @property int     $pid            Die ID des Buches oder des übergeordneten Kapitels
 * @property int     $sorting        Der Sortierindex des Kapitels
 * @property int     $tstamp         Das Änderungsdatum der Metainformationen des Kapitels
 * @property string  $title          Der Titel des Kapitels
 * @property string  $alias          Der Kapitelalias
 * @property boolean $published      Flag ob das Kapitel veröffentlicht ist
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
		switch ($key) {
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

		if (!BE_USER_LOGGED_IN) {
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

		if (!BE_USER_LOGGED_IN) {
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

		if (!BE_USER_LOGGED_IN) {
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

		if (!BE_USER_LOGGED_IN) {
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
		if ($books) {
			foreach ($books as $book) {
				$arrIds[] = $book->id;
			}
		}
		return $arrIds;
	}

}
