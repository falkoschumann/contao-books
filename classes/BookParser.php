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
 * Renders the cover page and table of contents of a book.
 *
 * @copyright  Falko Schumann 2015
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
		if ($chapters)
		{
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
		}
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
