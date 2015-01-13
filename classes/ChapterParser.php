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
