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
 * Class BookInsertTags
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BookInsertTags extends \Frontend
{

	public function replaceInsertTags($strTag)
	{
		$arrSplit = explode('::', $strTag);
		$insertTag = $arrSplit[0];
		
		if ($this->beginsWith($insertTag, 'bookchapter'))
		{
			$idOrAlias = $arrSplit[1];
			$objChapter = $this->getChapter($idOrAlias);
			if ($objChapter)
			{
				$title = $this->getChapterTitle($objChapter);
				$url = $this->getChapterUrl($objChapter);
				if ($insertTag == 'bookchapter_open')
				{
					return '<a href="' . $url . '" class="bookchapter">';
				}
				else if ($insertTag == 'bookchapter_url')
				{
					return $this->getChapterUrl($objChapter);
				}
				else if ($insertTag == 'bookchapter_title')
				{
					return $this->getChapterTitle($objChapter);
				}
				else
				{
					return '<a href="' . $url . '" class="bookchapter">' . $title . '</a>';
				}
			}
			else if ($insertTag == 'bookchapter_close')
			{
				return '</a>';
			}
			else
			{
				return '{Unbekanntens Kapitel: ' . $idOrAlias . '}';
			}
		}
		
		return false;
	}

	function beginsWith($str, $sub) {
		return (substr($str, 0, strlen($sub)) == $sub);
	}
	
	private function getChapter($idOrAlias)
	{
		$objChapters = $this->Database->prepare('SELECT id, title, alias FROM tl_book_chapter WHERE (id=? || alias=?) AND published=1')->execute($idOrAlias, $idOrAlias);
		return $objChapters->next();
	}
	
	private function getChapterTitle($objChapter)
	{
		$arrHeadline = deserialize($objChapter->title);
		return is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
	}
	
	private function getChapterUrl($objChapter)
	{
		global $objPage;
		$page = array(
				'id' => $objPage->id,
				'alias' => $objPage->alias
		);
		
		$itemPrefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ?  '/' : '/items/';
		$item = $this->isAliasSetAndEnabled($objChapter) ? $objChapter->alias : $objChapter->id;
		return $this->generateFrontendUrl($page, $itemPrefix . $item);
	}
	
	private function isAliasSetAndEnabled($objChapter)
	{
		return $objChapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
	}
	
}
