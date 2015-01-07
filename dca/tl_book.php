<?php

/*
 * Books Extension for Contao
 * Copyright (c) 2015, Falko Schumann <http://www.muspellheim.de>
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


/**
 * Data container array for table `tl_book`.
 *
 * Store books meta data like title and author. The books chapters are stored in
 * `tl_book_chapter`. The chapter table is not a child table because pid column
 * is used for the chapter tree.
 *
 * The books are shown as list view.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 */


/**
 * Table tl_book
 */
$GLOBALS['TL_DCA']['tl_book'] = array
(

	// Config
	'config'   => array
	(
		'dataContainer'     => 'Table',
		'enableVersioning'  => true,
		'sql'               => array
		(
			'keys' => array
			(
				'id'    => 'primary',
				'alias' => 'index'
			)
		),
		'ondelete_callback' => array
		(
			array('tl_book', 'deleteChapters')
		),
		'oncopy_callback'   => array
		(
			array('tl_book', 'copyChapters')
		)
	),

	// List
	'list'     => array
	(
		'sorting'           => array
		(
			'mode'        => 2,
			'flag'        => 1,
			'panelLayout' => 'sort,filter;search,limit',
			'fields'      => array('title')
		),
		'label'             => array
		(
			'fields'         => array('title'),
			'label_callback' => array('tl_book', 'bookLabel')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations'        => array
		(
			'edit'        => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_book']['edit'],
				'icon'            => 'edit.gif',
				'button_callback' => array('tl_book', 'editChapters')
			),
			'editheaders' => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book']['editheader'],
				'href'  => 'act=edit',
				'icon'  => 'header.gif'
			),
			'copy'        => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book']['copy'],
				'href'  => 'act=copy&amp;childs=1',
				'icon'  => 'copy.gif'
			),
			'delete'      => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
			),
			'toggle'      => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_book']['toggle'],
				'icon'            => 'visible.gif',
				'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback' => array('tl_book', 'toggleIcon')
			),
			'show'        => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array(''),
		'default'      => '{book_legend},title,subtitle,alias,author;{meta_legend:hide},year,place,language,tags;{abstract_legend},abstract;{publish_legend},published'
	),

	// Fields
	'fields'   => array
	(
		'id'        => array
		(
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp'    => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'title'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['title'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'inputType' => 'text',
			'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'alias'     => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_book']['alias'],
			'exclude'       => true,
			'search'        => true,
			'inputType'     => 'text',
			'eval'          => array('rgxp' => 'alnum', 'unique' => true, 'doNotCopy' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
			'sql'           => "varbinary(128) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_book', 'generateAlias')
			)
		),
		'subtitle'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'author'    => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['author'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'filter'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'year'      => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['year'],
			'exclude'   => true,
			'sorting'   => true,
			'filter'    => true,
			'inputType' => 'text',
			'eval'      => array('minlength' => 4, 'maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
			'sql'       => "varchar(4) NOT NULL default ''"
		),
		'place'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['place'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'filter'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'language'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['language'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'text',
			'eval'      => array('minlength' => 2, 'maxlength' => 2, 'rgxp' => 'alpha', 'tl_class' => 'w50'),
			'sql'       => "varchar(2) NOT NULL default ''"
		),
		'tags'      => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['tags'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'abstract'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['abstract'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'textarea',
			'eval'      => array('allowHtml' => true, 'rte' => 'tinyMCE', 'doNotShow' => true),
			'sql'       => "mediumtext NOT NULL"

		),
		'published' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['published'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50'),
			'sql'       => "char(1) NOT NULL default ''"
		),
	)
);


/**
 * Provide miscellaneous methods that are used by the data container array of
 * table `tl_book`.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class tl_book extends Backend
{

	/**
	 * This `label_callback` add subtitle and author if present to the default
	 * label.
	 *
	 * @param array  $row   a books data row.
	 * @param string $label the default label, usually the books title.
	 * @return string the new label.
	 */
	public function bookLabel($row, $label)
	{
		$result = $label;
		$book_id = Input::get('book_id');
		if (!$book_id) {
			if ($row['subtitle']) {
				$result .= '. ' . $row['subtitle'];
			}
			if ($row['author']) {
				$result .= ' <span style="color:#b3b3b3;padding-left:3px">[' . $row['author'] . ']</span>';
			}
		}

		return $result;
	}


	/**
	 * This `button_callback` returns the link to edit the chapters of an book.
	 *
	 * @param array  $row   a books data row.
	 * @param string $href  the base URL for the link.
	 * @param string $label the link label.
	 * @param string $title the link title.
	 * @param string $icon  the link icon.
	 * @return string the HTML link to edit chapters of selected book.
	 */
	public function editChapters($row, $href, $label, $title, $icon)
	{
		return '<a href="' . $this->addToUrl($href . '&amp;table=tl_book_chapter&amp;book_id=' . $row['id']) . '" title="' . specialchars($title) . '">' . Image::getHtml($icon, $label) . '</a> ';
	}


	/**
	 * This `button_callback` returns the link to toggle book visibility.
	 *
	 * @param array  $row        a books data row.
	 * @param string $href       the base URL for the link.
	 * @param string $label      the link label.
	 * @param string $title      the link title.
	 * @param string $icon       the link icon.
	 * @param string $attributes additional anchor attributes.
	 * @return string the HTML link to toggle books visibility.
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid'))) {
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

		if (!$row['published']) {
			$icon = 'invisible.gif';
		}

		return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
	}


	/**
	 * Toggle the visibility of the book with given id.
	 *
	 * @param integer the books id.
	 * @param boolean the current visibility.
	 */
	public function toggleVisibility($id, $visible)
	{
		$objVersions = new Versions('tl_book', $id);
		$objVersions->initialize();
		$this->Database->prepare("UPDATE tl_book SET tstamp=" . time() . ", published='" . ($visible ? 1 : '') . "' WHERE id=?")->execute($id);
		$objVersions->create();
		$this->log('A new version of record "tl_book.id=' . $id . '" has been created', __METHOD__, TL_GENERAL);
	}


	/**
	 * This `save_callback` generate the book alias if it does not exist.
	 *
	 * @param mixed         $value current alias, can maybe be empty.
	 * @param DataContainer $dc    the current data container.
	 * @return mixed the new alias.
	 * @throws Exception if alias ist not auto generated and already exists.
	 */
	public function generateAlias($value, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($value)) {
			$autoAlias = true;
			$value = standardize(String::restoreBasicEntities($dc->activeRecord->title));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_book WHERE alias=?")->execute($value);

		// Check whether the books alias exists
		if ($objAlias->numRows > 1 && !$autoAlias) {
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $value));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias) {
			$value .= '-' . $dc->id;
		}

		return $value;
	}


	/**
	 * Delete chapters from book.
	 *
	 * @param \DataContainer $dc
	 */
	public function deleteChapters(DataContainer $dc)
	{
		if (!$dc->id) {
			return;
		}

		$chapterIds = \Muspellheim\Books\ChapterModel::findChapterIdsByBookIds($dc->id);
		$chapterTable = new DC_Table('tl_book_chapter');
		foreach ($chapterIds as $id) {
			$chapterTable->intId = $id;
			$chapterTable->delete(true);
		}
	}


	/**
	 * Copy chapters from book.
	 *
	 * @param integer   $newBookId
	 * @param \DC_Table $table
	 */
	public function copyChapters($newBookId, DC_Table $bookTable)
	{
		$this->log('Copy ' . $bookTable->table . ' ' . $bookTable->id . ' to ' . $newBookId, __METHOD__, TL_GENERAL);
		$chapterIds = \Muspellheim\Books\ChapterModel::findChapterIdsByBookIds($bookTable->id);
		$chapterTable = new DC_Table('tl_book_chapter');
		foreach ($chapterIds as $id) {
			$this->log('Copy chapter ' . $id, __METHOD__, TL_GENERAL);
			$chapterTable->intId = $id;
			$newChapterId = $chapterTable->copy(true);
			$chapter = \Muspellheim\Books\ChapterModel::findByPk($newChapterId);
			$chapter->book_id = $newBookId;
			$chapter->save();
		}
	}

}
