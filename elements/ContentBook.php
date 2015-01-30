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
 * The content element book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ContentBook extends \ContentElement
{

	/**
	 * @var string the name of the template to be parsed.
	 */
	protected $strTemplate = 'ce_book';

	/**
	 * @var BookModel the book to display.
	 */
	private $objBook;

	/**
	 * @var ChapterModel the chapter to display or null when display table of contents.
	 */
	private $objChapter;


	/**
	 * Display a wildcard in the backend and nothing if book does not exist.
	 *
	 * @return string a wildcard at backend and the book or chapter at frontend.
	 */
	public function generate()
	{
		$this->objBook = BookModel::findPublishedById($this->book);
		// TODO Check if book exists

		if (TL_MODE == 'BE') return $this->displayWildcard();
		return parent::generate();
	}


	/**
	 * Parse the template.
	 */
	protected function compile()
	{
		$this->objChapter = ChapterModel::findByIdOrAlias($this->getChapterIdOrAliasFromHttpParameter());
		// TODO Check if chapter exists

		if ($this->objChapter === null)
		{
			$bookParser = new BookRenderer($this->objBook);
			$this->Template->content = $bookParser->generateHtml();
		}
		else
		{
			$chapterParser = new ChapterRenderer($this->objChapter);
			$this->Template->content = $chapterParser->generateHtml();
		}
	}


	/**
	 * Get the ID or chapter given as HTTP parameter.
	 *
	 * @return int|string|null the ID as int, the alias as string or null if no chapter is specified.
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
	 * Create an wildcard for the book dislaying in the backend.
	 *
	 * @return string the books wildcard.
	 */
	private function displayWildcard()
	{
		$objTemplate = new \BackendTemplate('be_wildcard');
		$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['MOD']['books'][0]) . ' ###';
		$objTemplate->title = $this->generateWildcardTitle();
		$objTemplate->id = $this->objBook->id;
		$objTemplate->link = $this->objBook->title;
		$objTemplate->href = 'contao/main.php?do=books&table=tl_book_chapter&book_id=' . $this->objBook->id;
		return $objTemplate->parse();
	}


	/**
	 * Create the title of the wildcard displaying in the backend.
	 *
	 * @return string the wildcard title.
	 */
	private function generateWildcardTitle()
	{
		$result = $this->objBook->title;
		$result .= $this->objBook->subtitle ? '. ' . $this->objBook->subtitle : '';
		$result .= $this->objBook->author ? ' (' . $this->objBook->author . ')' : '';
		return $result;
	}

}
