<?php

/**
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
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 */


namespace Muspellheim\Books;


/**
 * The model for book.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @property int     id
 * @property int     tstamp
 * @property string  title
 * @property string  alias
 * @property string  subtitle
 * @property string  author
 * @property string  category
 * @property string  language
 * @property boolean published
 * @property string  note  TODO Check if note is needed.
 * @property string  text
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
		$t          = static::$strTable;
		$arrColumns = array("$t.id=?");

		if (!BE_USER_LOGGED_IN)
		{
			$arrColumns[] = "$t.published=1";
		}
		return static::findOneBy($arrColumns, $id);
	}

}
