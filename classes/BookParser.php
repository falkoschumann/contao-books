<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * Renders the cover page and table of contents of a book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BookParser extends BaseBooks
{

	/**
	 * @var BookModel $book the book to render.
	 */
	private $book;


	/**
	 * Initialize the book  to render.
	 *
	 * @param BookModel $book the book to render.
	 */
	public function __construct($book)
	{
		parent::__construct();
		$this->book = $book;
	}


	/**
	 * Parse the book template and and return the rendered HTML.
	 *
	 * @return string the rendered HTML.
	 */

	public function parse()
	{
		$template = new \FrontendTemplate('books_book');
		$template->title = $this->book->title;
		$template->subtitle = $this->book->subtitle;
		$template->author = $this->book->author;
		$template->abstract = $this->book->abstract;
		$template->toc = $this->getChapterList(ChapterModel::findPublishedByPid(0, $this->book->id));
		return $template->parse();
	}


	/**
	 * Get HTML list of chapters and sub chapters.
	 *
	 * @param ChapterModel $chapters chapter list as model.
	 * @return string chapters as HTML list.
	 */
	private function getChapterList($chapters)
	{
		if ($chapters)
		{
			$html = "<ul>\n";
			foreach ($chapters as $chapter)
			{
				if ($chapter->show_in_toc)
				{
					$html .= '<li><a href="' . $this->getChapterUrl($chapter) . '">' . $chapter->title . '</a>';
					$html .= $this->getChapterList(ChapterModel::findPublishedByPid($chapter->id));
					$html .= "</li>\n";
				}
			}
			$html .= "</ul>\n";
			return $html;
		}

		// fallback: empty chapter list
		return '';
	}

}
