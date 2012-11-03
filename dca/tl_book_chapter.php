<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 *  - Neither the name of the Muspellheim.de nor the names of its contributors
 *    may be used to endorse or promote products derived from this software
 *    without specific prior written  permission.
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
 * @license    BSD-3-clause
 * @filesource
 */


/**
 * Table tl_book_chapter
 */
$GLOBALS['TL_DCA']['tl_book_chapter'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_book',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'flag'                    => 10,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title', 'subtitle', 'author', 'category', 'language', 'published'),
			'panelLayout'             => 'filter;search,limit',
			'child_record_callback'   => array('tl_book_chapter', 'listChapters')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_book_chapter']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_book_chapter']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_book_chapter']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_book_chapter']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_book_chapter', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_book_chapter']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{chapter_legend},title,alias;{meta_legend:hide},note;{text_legend},text;{publish_legend},published'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_book_chapter']['title'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'search'                  => true
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_book_chapter']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'search'                  => true,
			'save_callback' => array
			(
				array('tl_book_chapter', 'generateAlias')
			)
		),
		'note' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_book_chapter']['note'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('wrap'=>'soft'),
			'search'                  => true
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_book_chapter']['text'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>true, 'allowHtml'=>true, 'rte'=>'tinyMCE', 'doNotShow'=>true),
			'search'                  => true
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_book_chapter']['published'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'filter'                  => true
		)
	)
);


/**
 * Class tl_book_chapter
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class tl_book_chapter extends Backend
{

	/**
	 * Add the title of chapter
	 * @param array
	 * @return string
	 */
	public function listChapters($arrRow)
	{
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$title = $arrRow['title'];
		$arrHeadline = deserialize($title);
		$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
		$hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
// 		switch ($hl) {
// 			case 'h1':
// 				$offset = 10;
// 				break;
// 			case 'h2':
// 				$offset = 40;
// 				break;
// 			case 'h3':
// 				$offset = 70;
// 				break;
// 			case 'h4':
// 				$offset = 100;
// 				break;
// 			case 'h5':
// 				$offset = 130;
// 				break;
// 			case 'h6':
// 				$offset = 160;
// 				break;
// 		}
		switch ($hl) {
			case 'h6':
				$offset .= " . . . ";
			case 'h5':
				$offset .= " . . . ";
			case 'h4':
				$offset .= " . . . ";
			case 'h3':
				$offset .= " . . . ";
			case 'h2':
				$offset .= " . . . ";
			case 'h1':
				$offset .= "";
		}
		
		//return '<div class="cte_type ' . $key . '"><' . $hl . ' style="padding-left: ' . $offset . 'px;">' . $headline . '</' . $hl . '></div>';
		return '<div class="cte_type ' . $key . '"><span style="color:gray;">' . $offset .'</span>'  . $headline . '</div>';
	}

	/**
	 * Return the "toggle visibility" button
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

		//  Check permissions AFTER checking the tid, so hacking attempts are logged
		// if (!$this->User->isAdmin && !$this->User->hasAccess('tl_book_chapter::published', 'alexf'))
		// {
		// 		return '';
		// }

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to publish
		// if (!$this->User->isAdmin && !$this->User->hasAccess('tl_book_chapter::published', 'alexf'))
		// {
		// 		$this->log('Not enough permissions to publish/unpublish Book ID "'.$intId.'"', 'tl_book_chapter toggleVisibility', TL_ERROR);
		// 		$this->redirect('contao/main.php?act=error');
		// }

		$this->createInitialVersion('tl_book_chapter', $intId);

		// Trigger the save_callback
		// if (is_array($GLOBALS['TL_DCA']['tl_book_chapter']['fields']['published']['save_callback']))
		// {
		// 		foreach ($GLOBALS['TL_DCA']['tl_book_chapter']['fields']['published']['save_callback'] as $callback)
		// 		{
		// 			$this->import($callback[0]);
		// 			$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
		// 		}
		// }

		// Update the database
		$this->Database->prepare("UPDATE tl_book_chapter SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);

		$this->createNewVersion('tl_book_chapter', $intId);
	}

	/**
	 * Auto-generate the Chapter alias if it has not been set yet
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
			$arrHeadline = deserialize($dc->activeRecord->title);
			$headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
			$varValue = standardize($this->restoreBasicEntities($headline));
		}
	
		$objAlias = $this->Database->prepare("SELECT id FROM tl_book_chapter WHERE alias=? AND pid=? AND id<>?")->execute($varValue, $dc->activeRecord->pid, $dc->activeRecord->id);
	
		// Check whether the news alias exists
 		if ($objAlias->numRows > 0 && !$autoAlias)
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

?>