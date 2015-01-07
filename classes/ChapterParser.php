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
 * Renders a chapter of book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ChapterParser extends Books
{

	/**
	 * @var ChapterModel $book
	 */
	private $chapter;


	/**
	 * @param ChapterModel $chapter
	 */
	public function __construct($chapter)
	{
		parent::__construct();
		$this->chapter = $chapter;
	}


	/**
	 * @return string
	 */
	public function parse()
	{
		$arrHeadline = deserialize($this->chapter->title);
		$headline    = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
		$hl          = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';

		$template          = new \FrontendTemplate('books_chapter');
		$template->title   = $headline;
		$template->hl      = $hl;
		$template->text    = $this->chapter->text;
		$template->bookUrl = $this->getBookUrl();

		$objPreviousChapter = ChapterModel::findPreviousPublishedFor($this->chapter);
		if ($objPreviousChapter !== null) $template->previousUrl = $this->getChapterUrl($objPreviousChapter);

		$objNextChapter = ChapterModel::findNextPublishedFor($this->chapter);
		if ($objNextChapter !== null) $template->nextUrl = $this->getChapterUrl($objNextChapter);

		return $template->parse();
	}


	/**
	 * @return string
	 */
	private function getBookUrl()
	{
		return $this->generateFrontendUrl($GLOBALS['objPage']->row());
	}

}
