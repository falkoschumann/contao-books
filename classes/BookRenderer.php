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
 * Renders the cover page and table of contents of a book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BookRenderer extends Renderer
{

	/**
	 * @var string
	 */
	protected $strTemplate = 'books_book';


	protected function compileTemplate()
	{
		$this->Template->toc = $this->getTableOfContents();
	}


	/**
	 * @return string
	 */
	private function getTableOfContents()
	{
		return $this->getHtmlListForChapters(ChapterModel::findPublishedByPid(0, $this->id));
	}


	/**
	 * @param ChapterModel
	 * @return string
	 */
	private function getHtmlListForChapters($chapters)
	{
		if ($chapters === null)
		{
			return '';
		}

		$html = "<ul>\n";
		foreach ($chapters as $chapter)
		{
			if ($chapter->show_in_toc)
			{
				$html .= '<li><a href="' . $this->getUrlForChapter($chapter) . '">' . $chapter->title . '</a>';
				$html .= $this->getHtmlListForChapters(ChapterModel::findPublishedByPid($chapter->id));
				$html .= "</li>\n";
			}
		}
		$html .= "</ul>\n";
		return $html;
	}

}
