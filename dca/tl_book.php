<?php

/**
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
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
 */


/**
 * Table tl_book
 */
$GLOBALS['TL_DCA']['tl_book'] = array
(

	// Config
	'config'   => array
	(
		'dataContainer'    => 'Table',
		'ctable'           => array('tl_book_chapter'),
		'switchToEdit'     => true,
		'enableVersioning' => true,
		'sql'              => array
		(
			'keys' => array
			(
				'id'    => 'primary',
				'alias' => 'index'
			)
		)
	),

	// List
	'list'     => array
	(
		'sorting'           => array
		(
			'mode'        => 2,
			'fields'      => array('title'),
			'flag'        => 1,
			'panelLayout' => 'sort,filter;search,limit'
		),
		'label'             => array
		(
			'fields' => array('title', 'author'),
			'format' => '%s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>'
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
			'edit'       => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book']['edit'],
				'href'       => 'table=tl_book_chapter',
				'icon'       => 'edit.gif',
				'attributes' => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book']['editheader'],
				'href'       => 'act=edit',
				'icon'       => 'header.gif',
				'attributes' => 'class="edit-header"'
			),
			'copy'       => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_book']['copy'],
				'href'  => 'act=copy',
				'icon'  => 'copy.gif'
			),
			'delete'     => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_book']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle'     => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_book']['toggle'],
				'icon'            => 'visible.gif',
				'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback' => array('tl_book', 'toggleIcon')
			),
			'show'       => array
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
		'default'      => '{book_legend},title,subtitle,alias,author;{meta_legend:hide},language,category,note;{text_legend},text;{publish_legend},published'
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
			'inputType' => 'text',
			'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'search'    => true,

			'sorting'   => true,
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'subtitle'  => array

		(

			'label'     => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],

			'exclude'   => true,

			'inputType' => 'text',

			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),

			'search'    => true,
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'alias'     => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_book']['alias'],
			'exclude'       => true,
			'inputType'     => 'text',
			'eval'          => array('rgxp' => 'alnum', 'unique' => true, 'doNotCopy' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
			'search'        => true,
			'save_callback' => array
			(
				array('tl_book', 'generateAlias')
			),
			'sql'           => "varbinary(128) NOT NULL default ''"
		),
		'author'    => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['author'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'filter'    => true,
			'search'    => true,
			'sorting'   => true,
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'language'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['language'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('minlength' => 2, 'maxlength' => 2, 'rgxp' => 'alpha', 'tl_class' => 'w50'),
			'filter'    => true,
			'sorting'   => true,
			'sql'       => "varchar(2) NOT NULL default ''"
		),
		'category'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['category'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
			'filter'    => true,
			'search'    => true,
			'sorting'   => true,
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'note'      => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['note'],
			'exclude'   => true,
			'inputType' => 'textarea',
			'eval'      => array('wrap' => 'soft'),
			'search'    => true,
			'sql'       => "text NOT NULL"
		),

		'text'      => array
		(

			'label'     => &$GLOBALS['TL_LANG']['tl_book']['text'],

			'exclude'   => true,

			'inputType' => 'textarea',
			'eval'      => array('allowHtml' => true, 'rte' => 'tinyMCE', 'doNotShow' => true),

			'search'    => true,
			'sql'       => "mediumtext NOT NULL"

		),
		'published' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_book']['published'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50'),
			'filter'    => true,
			'sorting'   => true,
			'sql'       => "char(1) NOT NULL default ''"
		)
	)
);


/**
 * Class tl_book
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class tl_book extends Backend
{

	/**
	 * Return the "toggle visibility" button
	 *
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ';
	}


	/**
	 * Disable/enable a user group
	 *
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		$objVersions = new Versions('tl_book', $intId);
		$objVersions->initialize();

		// Update the database
		$this->Database->prepare("UPDATE tl_book SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_book.id=' . $intId . '" has been created', __METHOD__, TL_GENERAL);
	}


	/**
	 * Auto-generate the Book alias if it has not been set yet
	 *
	 * @param mixed
	 * @param DataContainer
	 * @return mixed
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($varValue))
		{
			$autoAlias = true;
			$varValue  = standardize(String::restoreBasicEntities($dc->activeRecord->title));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_book WHERE alias=?")->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}

}
