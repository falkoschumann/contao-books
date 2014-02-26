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
 * Renders the cover page and table of contents of a book.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BookParser extends Books
{

	/**
	 * @var BookModel $book
	 */
	private $book;


	/**
	 * @param BookModel $chapter
	 */
	public function __construct($chapter)
	{
		parent::__construct();
		$this->book = $chapter;
	}


	/**
	 * @return string
	 */
	public function parse()
	{
		$template           = new \FrontendTemplate('books_book');
		$template->title    = $this->book->title;
		$template->subtitle = $this->book->subtitle;
		$template->author   = $this->book->author;
		$template->text     = $this->book->text;

		$chapters    = ChapterModel::findPublishedByPid($this->book->id);
		$arrChapters = array();
		foreach ($chapters as $chapter)
		{
			$arrHeadline   = deserialize($chapter->title);
			$headline      = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
			$url           = $this->getChapterUrl($chapter);
			$level         = $this->getChapterLevel($chapter);
			$show_in_toc   = $chapter->show_in_toc;
			$arrChapters[] = array(
				'title'       => $headline,
				'url'         => $url,
				'level'       => $level,
				'show_in_toc' => $show_in_toc
			);
		}
		$template->chapters = $arrChapters;

		return $template->parse();
	}


	/**
	 * @param ChapterModel $chapter
	 * @return int
	 */
	private function getChapterLevel($chapter)
	{
		$arrHeadline = deserialize($chapter->title);
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

}
