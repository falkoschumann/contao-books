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
 * The content element book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ContentBook extends \ContentElement
{

	protected $strTemplate = 'ce_book';

	/**
	 * @var BookModel
	 */
	var $objBook;

	/**
	 * @var ChapterModel
	 */
	var $objChapter;


	public function generate()
	{
		$this->objBook = BookModel::findPublishedById($this->book);
		// TODO Check if book exists
		$this->objChapter = ChapterModel::findByIdOrAlias($this->getChapterIdOrAliasFromHttpParameter());
		// TODO Check if chapter exists

		if (TL_MODE == 'BE') return $this->displayWildcard();
		return parent::generate();
	}


	/**
	 * @return int|string|null
	 */
	private function getChapterIdOrAliasFromHttpParameter()
	{
		if (isset($_GET['items']))
		{
			return \Input::get('items');
		}
		elseif ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			return \Input::get('auto_item');
		}
	}


	/**
	 * @return string
	 */
	private function displayWildcard()
	{
		$objTemplate           = new \BackendTemplate('be_wildcard');
		$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['MOD']['books'][0]) . ' ###';
		$objTemplate->title    = $this->generateWildcardTitle();
		$objTemplate->id       = $this->objBook->id;
		$objTemplate->link     = $this->objBook->title;
		$objTemplate->href     = 'contao/main.php?do=books&table=tl_book_chapter&amp;id=' . $this->objBook->id;
		return $objTemplate->parse();
	}


	/**
	 * @return string
	 */
	private function generateWildcardTitle()
	{
		$result = $this->objBook->title;
		$result .= $this->objBook->subtitle ? ' - ' . $this->objBook->subtitle : '';
		$result .= $this->objBook->author ? ' (' . $this->objBook->author . ')' : '';
		return $result;
	}


	protected function compile()
	{
		if ($this->objChapter === null)
		{
			$bookParser              = new BookParser($this->objBook);
			$this->Template->content = $bookParser->parse();
		}
		else
		{
			$chapterParser           = new ChapterParser($this->objChapter);
			$this->Template->content = $chapterParser->parse();
		}
	}

}
