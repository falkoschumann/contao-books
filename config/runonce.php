<?php

/*
 * Books Extension for Contao
 * Copyright (c) 2014, Falko Schumann <http://www.muspellheim.de>
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
 */


namespace Muspellheim\Books;


/**
 * Convert books from v1.x to v2.x table format.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 */
class BooksRunonceJob extends \Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function run()
	{
		$bookRunonce = new BookRunonce();
		$bookRunonce->run();

		$chapterRunonce = new ChapterRunonce();
		$chapterRunonce->run();

	}
}


class BookRunonce extends \Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}


	public function  run()
	{
		if ($this->Database->tableExists('tl_book'))
		{
			$this->renameFieldCategoryToTags();
			$this->renameFieldTextToAbstract();
		}
	}


	private function renameFieldCategoryToTags()
	{
		if ($this->Database->fieldExists('category', 'tl_book') && !$this->Database->fieldExists('tags', 'tl_book'))
		{
			$this->Database->execute("ALTER TABLE tl_book CHANGE category tags varchar(255) NOT NULL default ''");
		}
	}


	private function renameFieldTextToAbstract()
	{
		if ($this->Database->fieldExists('text', 'tl_book') && !$this->Database->fieldExists('abstract', 'tl_book'))
		{
			$this->Database->execute("ALTER TABLE tl_book CHANGE text abstract mediumtext NOT NULL");
		}
	}

}


class ChapterRunonce extends \Controller
{

	private $pidPath = array();

	private $chapter;


	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}


	public function run()
	{
		if ($this->Database->tableExists('tl_book_chapter'))
		{
			if ($this->addFieldBookId())
			{
				$this->chapter = $this->Database->execute("SELECT * FROM tl_book_chapter ORDER BY pid, sorting");
				while ($this->chapter->next())
				{
					$this->updateChapter();
					$this->createContentElement();
				}
			}
		}
	}


	/**
	 * @return bool
	 */
	private function addFieldBookId()
	{
		if (!$this->Database->fieldExists('book_id', 'tl_book_chapter'))
		{
			$this->Database->execute("ALTER TABLE tl_book_chapter ADD book_id int(10) unsigned NOT NULL default '0'");
			return true;
		}
		else
		{
			return false;
		}
	}


	private function updateChapter()
	{
		$this->Database->prepare("UPDATE tl_book_chapter SET title=?, book_id=?, pid=? WHERE id=?")
			->execute($this->getChapterTitle(), $this->chapter->pid, $this->updatePathAndGetPid(), $this->chapter->id);
	}


	private function createContentElement()
	{
		$this->Database->prepare("INSERT INTO tl_content (pid, ptable, tstamp, type, headline, text) VALUES (?, ?, ?, ?, ?, ?)")
			->execute($this->chapter->id, 'tl_book_chapter', $this->chapter->tstamp, 'text', $this->chapter->title, $this->chapter->text);
	}


	/**
	 * @return string
	 */
	private function getChapterTitle()
	{
		$arrHeadline = deserialize($this->chapter->title);
		$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
		return $headline;
	}


	/**
	 * @return int
	 */
	private function updatePathAndGetPid()
	{
		$level = static::getChapterLevel($this->chapter);
		$pathLength = count($this->pidPath);
		if ($level > $pathLength)
		{
			$action = 'increment';
			$this->pidPath[] = $this->chapter->id;
		}
		else if ($level < $pathLength)
		{
			$action = 'decrement';
			array_pop($this->pidPath);
			$this->pidPath[$pathLength - 2] = $this->chapter->id;
		}
		else // $level == $pathLength
		{
			$action = 'none';
			$this->pidPath[$pathLength - 1] = $this->chapter->id;
		}
		return $this->getPid();
	}


	/**
	 * @return int
	 */
	private function getPid()
	{
		$pathLength = count($this->pidPath);
		if ($pathLength > 1)
		{
			return $this->pidPath[$pathLength - 2];
		}
		else
		{
			return 0;
		}
	}


	/**
	 * @return int
	 */
	private function getChapterLevel()
	{
		$arrHeadline = deserialize($this->chapter->title);
		$hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
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


$objBooksRunonceJob = new BooksRunonceJob();
$objBooksRunonceJob->run();
