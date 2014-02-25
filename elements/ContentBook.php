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


// FIXME Auto_item funktioniert nicht mehr: Wird ein Kapitel ohne "items" in der URL aufgerufen, wird die Seite nicht gefunden.

/**
 * The content element book.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ContentBook extends \ContentElement
{

	/**
	 * @var BookModel
	 */
	var $objBook;

	/**
	 * @var ChapterModel
	 */
	var $objChapter;


	public function generate()
	{
		$this->objBook = BookModel::findPublishedById($this->book);

		if (TL_MODE == 'BE') return $this->displayWildcard();

		if (isset($_GET['items']))
		{
			$chapter = \Input::get('items');
		}
		else
		{
			if ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
			{
				$chapter = \Input::get('auto_item');
			}
		}

		if ($chapter)
		{
			$this->objChapter  = ChapterModel::findByIdOrAlias($chapter);
			$this->strTemplate = 'ce_book_chapter';
		}
		else
		{
			$this->strTemplate = 'ce_book';
		}
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
		if ($this->objBook->subtitle) $objTemplate->title .= ' - ' . $this->objBook->subtitle;
		if ($this->objBook->author) $objTemplate->title .= ' (' . $this->objBook->author . ')';
		$objTemplate->id   = $this->objBook->id;
		$objTemplate->link = $this->objBook->title;
		$objTemplate->href = 'contao/main.php?do=books&table=tl_book_chapter&amp;id=' . $this->objBook->id;
		return $objTemplate->parse();
	}


	protected function compile()
	{
		if ($this->strTemplate == 'ce_book')
		{
			$this->compileBook();
		}
		else
		{
			$this->compileChapter();
		}
	}


	private function compileBook()
	{
		// TODO Check if book exists
		$this->Template->title    = $this->objBook->title;
		$this->Template->subtitle = $this->objBook->subtitle;
		$this->Template->author   = $this->objBook->author;
		$this->Template->text     = $this->objBook->text;

		$chapters    = ChapterModel::findPublishedByPid($this->objBook->id);
		$arrChapters = array();
		if (TL_MODE == 'FE')
		{
			foreach ($chapters as $chapter)
			{
				$arrHeadline   = deserialize($chapter->title);
				$headline      = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
				$url           = $this->getChapterUrl($chapter);
				$level         = $this->getChapterLevel($chapter);
				$show_in_toc   = $chapter->show_in_toc;
				$arrChapters[] = array('title' => $headline, 'url' => $url, 'level' => $level, 'show_in_toc' => $show_in_toc);
			}
		}
		$this->Template->chapters = $arrChapters;
	}


	private function getChapterUrl($objChapter)
	{
		$itemPrefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/';
		$item       = $this->isAliasSetAndEnabled($objChapter) ? $objChapter->alias : $objChapter->id;
		return $this->generateFrontendUrl($GLOBALS['objPage']->row(), $itemPrefix . $item);
	}


	private function isAliasSetAndEnabled($objChapter)
	{
		return $objChapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
	}


	private function getChapterLevel($objChapter)
	{
		$arrHeadline = deserialize($objChapter->title);
		$hl          = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
		switch ($hl)
		{
			case 'h1':
				return 1;
			case 'h2':
				return 2;
			case 'h3':
				return 3;
			case 'h4':
				return 4;
			case 'h5':
				return 5;
			case 'h6':
				return 6;
		}
	}


	private function compileChapter()
	{
		$objChapter  = ChapterModel::findPublishedById($this->objChapter->id);
		$arrHeadline = deserialize($objChapter->title);
		$headline    = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
		$hl          = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';

		$this->Template->title   = $headline;
		$this->Template->hl      = $hl;
		$this->Template->text    = $objChapter->text;
		$this->Template->bookUrl = $this->getBookUrl();

		$objPreviousChapter = ChapterModel::findPreviousPublishedFor($objChapter);
		if ($objPreviousChapter !== null) $this->Template->previousUrl = $this->getChapterUrl($objPreviousChapter);

		$objNextChapter = ChapterModel::findNextPublishedFor($objChapter);
		if ($objNextChapter !== null) $this->Template->nextUrl = $this->getChapterUrl($objNextChapter);
	}


	private function getBookUrl()
	{
		return $this->generateFrontendUrl($GLOBALS['objPage']->row());
	}

}
