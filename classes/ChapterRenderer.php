<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link    https://github.com/falkoschumann/contao-books
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
class ChapterRenderer extends Renderer
{

	/**
	 * @var string
	 */
	protected $strTemplate = 'books_chapter';


	protected function compileTemplate()
	{
		$this->Template->content = $this->getContent();
		$this->Template->bookUrl = $this->getBookUrl();

		$objPreviousChapter = $this->findPreviousPublishedFor($this->chapter);
		if ($objPreviousChapter !== null) $this->Template->previousUrl = $this->getUrlForChapter($objPreviousChapter);

		$objNextChapter = $this->findNextPublishedFor($this->chapter);
		if ($objNextChapter !== null) $this->Template->nextUrl = $this->getUrlForChapter($objNextChapter);
	}


	/**
	 * Get the rendered content elements of the chapters.
	 *
	 * @return string HTML of content elements.
	 */
	private function getContent()
	{
		$result = '';
		$objElements = \ContentModel::findPublishedByPidAndTable($this->id, 'tl_book_chapter');
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
