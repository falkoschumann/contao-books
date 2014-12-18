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
		$this->import('Database');
	}


	public function run()
	{
		// upgrade tl_book
		if ($this->Database->tableExists('tl_book')) {
			if ($this->Database->fieldExists('category', 'tl_book') && !$this->Database->fieldExists('tags', 'tl_book')) {
				$this->Database->execute("ALTER TABLE tl_book CHANGE category tags varchar(255) NOT NULL default ''");
			}
			if ($this->Database->fieldExists('text', 'tl_book') && !$this->Database->fieldExists('abstract', 'tl_book')) {
				$this->Database->execute("ALTER TABLE tl_book CHANGE text abstract mediumtext NOT NULL");
			}
		}

		// upgrade tl_book_chapter
		if ($this->Database->tableExists('tl_book_chapter')) {
			if (!$this->Database->fieldExists('book_id', 'tl_book_chapter')) {
				$this->Database->execute("ALTER TABLE tl_book_chapter ADD book_id int(10) unsigned NOT NULL default '0'");
				$chapter = $this->Database->execute("SELECT * FROM tl_book_chapter ORDER BY pid, sorting");
				while ($chapter->next()) {
					$arrHeadline = deserialize($chapter->title);
					$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
					$hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
					$this->Database->prepare("UPDATE tl_book_chapter SET title=?, book_id=?  WHERE id=?")->execute($headline, $chapter->pid, $chapter->id);

					// create text element in tl_content
					$this->Database->prepare("INSERT INTO tl_content (pid, ptable, tstamp, type, headline, text) VALUES (?, ?, ?, ?, ?, ?)")->execute($chapter->id, 'tl_book_chapter', $chapter->tstamp, 'text', $chapter->title, $chapter->text);
				}

				// FIXME: workaround until chapter tree is ported
				$this->Database->execute("UPDATE tl_book_chapter SET pid=0");
			}
		}
	}

}

$objBooksRunonceJob = new BooksRunonceJob();
$objBooksRunonceJob->run();
