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
class ChapterRenderer extends TemplateRenderer
{

	/**
	 * @var string
	 */
	protected $strTemplate = 'books_chapter';

	/**
	 * @var array
	 */
	private $chapterList = null;


	protected function compileTemplate()
	{
		$this->Template->content = $this->getHtmlForContentElements();
		$this->Template->bookUrl = $this->getBookUrl();

		$objPreviousChapter = $this->findPreviousChapterFor(ChapterModel::findPublishedById($this->id));
		if ($objPreviousChapter !== null) $this->Template->previousUrl = $this->getUrlForChapter($objPreviousChapter);

		$objNextChapter = $this->findNextChapterFor(ChapterModel::findPublishedById($this->id));
		if ($objNextChapter !== null) $this->Template->nextUrl = $this->getUrlForChapter($objNextChapter);
	}


	/**
	 * @return string
	 */
	private function getHtmlForContentElements()
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
	 * @return string
	 */
	private function getBookUrl()
	{
		return $this->generateFrontendUrl($GLOBALS['objPage']->row());
	}


	/**
	 * @param ChapterModel
	 * @return ChapterModel|null
	 */
	private function findPreviousChapterFor($chapter)
	{
		$chapterList = $this->getChapterList();
		$chapterCount = count($chapterList);
		for ($i = 0; $i < $chapterCount; $i++)
		{
			if ($chapterList[$i]->id == $chapter->id)
			{
				if ($i > 0)
					return $chapterList[$i - 1];
			}
		}

		// fallback
		return null;
	}


	/**
	 * @param ChapterModel
	 * @return ChapterModel|null
	 */
	private function findNextChapterFor($chapter)
	{
		$chapterList = $this->getChapterList();
		$chapterCount = count($chapterList);
		for ($i = 0; $i < $chapterCount; $i++)
		{
			if ($chapterList[$i]->id == $chapter->id)
			{
				if ($i < $chapterCount - 2)
					return $chapterList[$i + 1];
			}
		}

		// fallback
		return null;
	}


	/**
	 * @param ChapterModel
	 * @return array
	 */
	private function getChapterList()
	{
		if ($this->chapterList === null)
		{
			$this->chapterList = static::getChapterListFor(ChapterModel::findPublishedByPid(0, $this->book_id));
		}
		return $this->chapterList;
	}


	/**
	 * @param ChapterModel
	 * @return array
	 */
	private static function getChapterListFor($chapters)
	{
		if ($chapters === null)
		{
			return array();
		}

		$chapterList = array();
		foreach ($chapters as $e)
		{
			if ($e->show_in_toc)
			{
				$chapterList[] = $e;
				$chapterList = array_merge($chapterList, static::getChapterListFor(ChapterModel::findPublishedByPid($e->id)));
			}
		}
		return $chapterList;
	}

}
