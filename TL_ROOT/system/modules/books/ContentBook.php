<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Books Extension for Contao
 * Copyright (c) 2012, Falko Schumann <http://www.muspellheim.de>
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
 * PHP version 5
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 * @filesource
 */


/**
 * Class ContentBook
 *
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class ContentBook extends ContentElement
{

	/**
	 * Parse the template
	 * @return string
	 */
	public function generate()
	{
		if (isset($_GET['items']))
		{
			$this->strTemplate = 'ce_book_chapter';
		}
		else
		{
			$this->strTemplate = 'ce_book';
		}		
		return parent::generate();
	}
	
	/**
	 * Compile the current element
	 */
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
		$bookId = $this->book;
		$objBooks = $this->Database->prepare('SELECT title, subtitle, author, text FROM tl_book WHERE (id=?) AND published=1')->execute($bookId);
		$objBooks->next();
		$objBook = (object) $objBooks->row();
		$this->Template->title = $objBook->title;
		$this->Template->subtitle = $objBook->subtitle;
		$this->Template->author = $objBook->author;
		$this->Template->text = $objBook->text;
		
		$objChapters = $this->Database->prepare('SELECT id, title, alias, show_in_toc FROM tl_book_chapter WHERE (pid=?) AND published=1 ORDER BY sorting')->execute($bookId);
		$chapters = array();
		if (TL_MODE == 'FE')
		{
			while ($objChapters->next())
			{
				$objChapter = (object) $objChapters->row();
				$arrHeadline = deserialize($objChapter->title);
				$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
				$url = $this->getChapterUrl($objChapter);
				$level = $this->getChapterLevel($objChapter);
				$show_in_toc = $objChapter->show_in_toc;
				$chapters[] = array( 'title' => $headline, 'url' => $url , 'level' => $level, 'show_in_toc' => $show_in_toc);
			}
		}
		$this->Template->chapters = $chapters;
	}
		
	private function getChapterUrl($objChapter)
	{
		$itemPrefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ?  '/' : '/items/';
		$item = $this->isAliasSetAndEnabled($objChapter) ? $objChapter->alias : $objChapter->id;
		return $this->generateFrontendUrl($GLOBALS['objPage']->row(), $itemPrefix . $item);
	}
	
	private function isAliasSetAndEnabled($objChapter)
	{
		return $objChapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
	}
	
	private function getChapterLevel($objChapter)
	{
		$arrHeadline = deserialize($objChapter->title);
		$hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
		switch ($hl) {
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
		$bookId = $this->book;
		$chapterId = is_numeric($this->Input->get('items')) ? $this->Input->get('items') : 0;
		$chapterAlias = $this->Input->get('items');
		$objChapters = $this->Database->prepare('SELECT id, pid, alias, sorting, title, text FROM tl_book_chapter WHERE pid=? AND (id=? OR alias=?) AND published=1')->execute($bookId, $chapterId, $chapterAlias);
		$objChapters->next();
		$objChapter = (object) $objChapters->row();
		
		$arrHeadline = deserialize($objChapter->title);
		$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
		$hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
		
		$this->Template->title = $headline;
		$this->Template->hl = $hl;
		$this->Template->text = $objChapter->text;

		$this->Template->bookUrl = $this->getBookUrl();
		$bookId = $objChapter->pid;
		$chapterSorting = $objChapter->sorting;
		$objChapters = $this->Database->prepare('SELECT id, alias FROM tl_book_chapter WHERE pid=? AND published=1 AND sorting<? ORDER BY sorting DESC LIMIT 1')->execute($bookId, $chapterSorting);
		if ($objChapters->next())
		{
			$objChapter = (object) $objChapters->row();
			$this->Template->previousUrl = $this->getChapterUrl($objChapter);
		}
		
		$objChapters = $this->Database->prepare('SELECT id, alias FROM tl_book_chapter WHERE pid=? AND published=1 AND sorting>? ORDER BY sorting LIMIT 1')->execute($bookId, $chapterSorting);
		if ($objChapters->next())
		{
			$objChapter = (object) $objChapters->row();
			$this->Template->nextUrl = $this->getChapterUrl($objChapter);
		}
	}

	private function getBookUrl()
	{
		return $this->generateFrontendUrl($GLOBALS['objPage']->row());
	}

};

?>