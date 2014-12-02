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


/**
 * Data container array for table `tl_book_chapter`.
 *
 * Store chapters meta data like title and publishing state. The chapters text
 * is stored in child table `tl_content`.
 *
 * The chapters are shown as tree view.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause http://opensource.org/licenses/BSD-2-Clause
 */


/**
 * Table tl_book_chapter
 */
$GLOBALS['TL_DCA']['tl_book_chapter'] = array
(

	// Config
	'config'   => array
	(
		'ctable'            => array('tl_content'),
		'dataContainer'     => 'Table',
		'enableVersioning'  => true,
		'onload_callback'   => array
		(
			array('tl_book_chapter', 'addBreadcrumb'),
		),

		'onsubmit_callback' => array(array('tl_book_chapter', 'setBook')),
		'sql'               => array
		(
			'keys' => array
			(
				'id'      => 'primary',
				'pid'     => 'index',
				'alias'   => 'index',
				'book_id' => 'index'
			)
		),
		'backlink'          => 'do=books'
	),

	// List
	'list'     => array
	(
		'sorting'           => array
		(
			'mode'        => 5,
			'panelLayout' => 'search,limit',
			'icon'        => 'system/modules/books/assets/book.png',
			'rootPaste'   => true
		),
		'label'             => array
		(
			'fields'         => array('title'),
			'label_callback' => array('tl_book_chapter', 'addIcon')
		),
		'global_operations' => array
		(
			'all'         => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			),
			'toggleNodes' => array
			(
				'label' => &$GLOBALS['TL_LANG']['MSC']['toggleAll'],
				'href'  => 'ptg=all',
				'class' => 'header_toggle'
			)
		),
		'operations'        => array
		(
			'edit'        => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book_chapter']['edit'],
				'href'  => 'table=tl_content',
				'icon'  => 'edit.gif'
			),
			'editheaders' => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'],
				'href'  => 'act=edit',
				'icon'  => 'header.gif'
			),
			'copy'        => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book_chapter']['copy'],
				'href'       => 'act=paste&amp;mode=copy',
				'icon'       => 'copy.gif',
				'attributes' => 'onclick="Backend.getScrollOffset()"'
			),
			'copyChilds'  => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book_chapter']['copyChilds'],
				'href'       => 'act=paste&amp;mode=copy&amp;childs=1',
				'icon'       => 'copychilds.gif',
				'attributes' => 'onclick="Backend.getScrollOffset()"'
			),
			'cut'         => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book_chapter']['cut'],
				'href'       => 'act=paste&amp;mode=cut',
				'icon'       => 'cut.gif',
				'attributes' => 'onclick="Backend.getScrollOffset()"'
			),
			'delete'      => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book_chapter']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle'      => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_book_chapter']['toggle'],
				'icon'            => 'visible.gif',
				'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback' => array('tl_book_chapter', 'toggleIcon')
			),
			'show'        => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book_chapter']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array(''),
		'default'      => '{chapter_legend},title,alias;{publish_legend},published,show_in_toc'
	),

	// Fields
	'fields'   => array
	(
		'id'          => array
		(
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid'         => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting'     => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp'      => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'title'       => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book_chapter']['title'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'alias'       => array
		(
			'label'         => $GLOBALS['TL_LANG']['tl_book_chapter']['alias'],
			'exclude'       => true,
			'search'        => true,
			'inputType'     => 'text',
			'eval'          => array('rgxp' => 'alnum', 'unique' => true, 'doNotCopy' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
			'sql'           => "varbinary(128) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_book_chapter', 'generateAlias')
			)
		),
		'published'   => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book_chapter']['published'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50'),
			'sql'       => "char(1) NOT NULL default ''"
		),
		'book_id'     => array
		(
			'label' => &$GLOBALS['TL_LANG']['tl_book_chapter']['book_id'],
			'sql'   => "int(10) unsigned NOT NULL default '0'"
		),
		'show_in_toc' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book_chapter']['show_in_toc'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50'),
			'sql'       => "char(1) NOT NULL default '1'"
		)
	)
);


if (Input::get('book_id')) {
	$book_id = Input::get('book_id');
	$GLOBALS['TL_DCA']['tl_book_chapter']['config']['label'] = \Muspellheim\Books\BookModel::findByPk($book_id)->title;
	$GLOBALS['TL_DCA']['tl_book_chapter']['list']['sorting']['root'] = \Muspellheim\Books\ChapterModel::findChaptersByBookIds($book_id);
}

/**
 * Provide miscellaneous methods that are used by the data container array of
 * table `tl_book_chapter`.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class tl_book_chapter extends Backend
{

	/**
	 * Set the book id for the chapter if chapter is created on books root.
	 *
	 * @param DataContainer $dc the current data container.
	 */
	public function setBook(DataContainer $dc)
	{
		// Return if there is no active record (override all)
		if (!$dc->activeRecord) {
			return;
		}

		// Return if chapter already exists
		if ($dc->activeRecord->tstamp > 0) {
			return;
		}

		// Set book as parent if insert as root element
		if ($dc->activeRecord->pid == 0) {
			$book_id = Input::get('book_id');
			$this->Database->prepare("UPDATE tl_book_chapter SET book_id=? WHERE id=?")->execute($book_id, $dc->id);
		}
	}


	/**
	 * This `button_callback` returns the link to toggle chapter visibility.
	 *
	 * @param array  $row        a books data row.
	 * @param string $href       the base URL for the link.
	 * @param string $label      the link label.
	 * @param string $title      the link title.
	 * @param string $icon       the link icon.
	 * @param string $attributes additional anchor attributes.
	 * @return string the HTML link to toggle chapters visibility.
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
	 * Toggle the visibility of the chapter with given id.
	 *
	 * @param integer the chapter id.
	 * @param boolean the current visibility.
	 */
	public function toggleVisibility($id, $visible)
	{
		$objVersions = new Versions('tl_book_chapter', $id);
		$objVersions->initialize();

		// Update the database
		$this->Database->prepare("UPDATE tl_book_chapter SET tstamp=" . time() . ", published='" . ($visible ? 1 : '') . "' WHERE id=?")->execute($id);

		$objVersions->create();
		$this->log('A new version of record "tl_book_chapter.id=' . $id . '" has been created', __METHOD__, TL_GENERAL);
	}


	/**
	 * This `save_callback` generate the chapter alias if it does not exist.
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

		$objAlias = $this->Database->prepare("SELECT id FROM tl_book_chapter WHERE alias=?")->execute($value);

		// Check whether the news alias exists
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
	 * Add the breadcrumb menu.
	 */
	public function addBreadcrumb()
	{
		Backend::addPagesBreadcrumb();
	}


	/**
	 * Add an image to each chapter in the tree.
	 *
	 * @param array         $row            a books data row.
	 * @param string        $label          the chapters label.
	 * @param DataContainer $dc             the current data container.
	 * @param string        $imageAttribute additional image attributes.
	 * @param boolean       $blnReturnImage return the image only?
	 * @param boolean       $blnProtected   this parameter is ignored.
	 * @return string the HTML image link and text link.
	 */
	public function addIcon($row, $label, DataContainer $dc = null, $imageAttribute = '', $blnReturnImage = false, $blnProtected = false)
	{
		if ($row['published']) {
			$image = 'system/modules/books/assets/chapter.png';
		} else {
			$image = 'system/modules/books/assets/chapter_1.png';
		}

		// Return the image only
		if ($blnReturnImage) {
			return \Image::getHtml($image, '', $imageAttribute);
		}

		// Add the breadcrumb link
		$label = '<a href="' . \Controller::addToUrl('node=' . $row['id']) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['selectNode']) . '">' . $label . '</a>';

		// Return the image
		return \Image::getHtml($image, '', $imageAttribute) . ' ' . $label;

	}

}
