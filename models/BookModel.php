<?php

/*
 * Books Extension for Contao
 * Copyright (c) 2015, Falko Schumann <http://www.muspellheim.de>
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
 * The model for book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
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
