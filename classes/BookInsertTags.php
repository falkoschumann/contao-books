<?php

/**
 * Books Extension for Contao
 * Copyright (c) 2012, Falko Schumann <http://www.muspellheim.de>
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
 * PHP version 5
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 * @filesource
 */


/**
 * Class BookInsertTags
 *
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class BookInsertTags extends Frontend
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
	
};
