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
 * Renders a chapter of book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ChapterParser extends BaseBooks
{

	/**
	 * @var ChapterModel $chapter the chapter to render.
	 */
	private $chapter;


	/**
	 * Initialize the chapter to render.
	 *
	 * @param ChapterModel $chapter the chapter to render.
	 */
	public function __construct($chapter)
	{
		parent::__construct();
		$this->chapter = $chapter;
	}


	/**
	 * Parse the chapter template and and return the rendered HTML.
	 *
	 * @return string the rendered HTML.
	 */
	public function parse()
	{
		$template = new \FrontendTemplate('books_chapter');
		$template->content = $this->getContent();
		$template->bookUrl = $this->getBookUrl();

		$objPreviousChapter = $this->findPreviousPublishedFor($this->chapter);
		if ($objPreviousChapter !== null) $template->previousUrl = $this->getChapterUrl($objPreviousChapter);

		$objNextChapter = $this->findNextPublishedFor($this->chapter);
		if ($objNextChapter !== null) $template->nextUrl = $this->getChapterUrl($objNextChapter);

		return $template->parse();
	}


	/**
	 * Get the rendered content elements of the chapters.
	 *
	 * @return string HTML of content elements.
	 */
	private function getContent()
	{
		$result = '';
		$objElements = \ContentModel::findPublishedByPidAndTable($this->chapter->id, 'tl_book_chapter');
		if ($objElements !== null)
		{
			while ($objElements->next())
			{
				$result .= $this->getContentElement($objElements->id);
			}
		}
		return $result;
	}


	/**
	 * Get the URL of the book page.
	 *
	 * @return string the URL as string.
	 */
	private function getBookUrl()
	{
		return $this->generateFrontendUrl($GLOBALS['objPage']->row());
	}


	/**
	 * Try to find the previous published chapter to an given chapter.
	 *
	 * @param ChapterModel $chapter a chapter.
	 * @return ChapterModel|null the previous chapter or null if there is none.
	 */
	private function findPreviousPublishedFor($chapter)
	{
	}


	/**
	 * Try to find the next published chapter to an given chapter.
	 *
	 * @param ChapterModel $chapter a chapter.
	 * @return ChapterModel|null the next chapter or null if there is none.
	 */
	private function findNextPublishedFor($chapter)
	{
	}


	/**
	 * Get the list of chapters in sequence in sequence in the book.
	 *
	 * @return array array of ChapterModel.
	 */
	private function getChapters()
	{

	}

}
