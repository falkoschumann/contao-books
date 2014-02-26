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
 * The content element book.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ContentBook extends \ContentElement
{

	protected $strTemplate = 'ce_book';

	/**
	 * @var BookModel
	 */
	var $objBook;


	public function generate()
	{
		$this->objBook = BookModel::findPublishedById($this->book);
		// TODO Check if book exists

		if (TL_MODE == 'BE') return $this->displayWildcard();
		return parent::generate();
	}


	/**
	 * @return string
	 */
	private function displayWildcard()
	{
		$objTemplate           = new \BackendTemplate('be_wildcard');
		$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['MOD']['books'][0]) . ' ###';
		$objTemplate->title    = $this->objBook->title;
		$objTemplate->title    = $this->objBook->subtitle ? $objTemplate->title . ' - ' . $this->objBook->subtitle : $objTemplate->title;
		$objTemplate->title    = $this->objBook->author ? $objTemplate->title . ' (' . $this->objBook->author . ')' : $objTemplate->title;
		$objTemplate->id       = $this->objBook->id;
		$objTemplate->link     = $this->objBook->title;
		$objTemplate->href     = 'contao/main.php?do=books&table=tl_book_chapter&amp;id=' . $this->objBook->id;
		return $objTemplate->parse();
	}


	protected function compile()
	{
		if (isset($_GET['items']))
		{
			$chapter = \Input::get('items');
		}
		elseif ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			$chapter = \Input::get('auto_item');
		}

		if ($chapter === null)
		{
			$bookParser              = new BookParser($this->objBook);
			$this->Template->content = $bookParser->parse();
		}
		else
		{
			$objChapter = ChapterModel::findByIdOrAlias($chapter);
			// TODO Check if chapter exists

			$chapterParser           = new ChapterParser($objChapter);
			$this->Template->content = $chapterParser->parse();
		}
	}

}
