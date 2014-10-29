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
 * Data Container Array for table `tl_book_chapter`
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
        'onsubmit_callback' => array(array('tl_book', 'setBook')),
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
            'panelLayout' => 'filter;search,limit',
            'rootPaste'   => true
        ),
        'label'             => array
        (
            'fields' => array('title')
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
                'label' => &$GLOBALS['TL_LANG']['tl_book_chapter']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
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
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'book_id'     => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
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


if (Input::get('book_id'))
{
    $book_id = Input::get('book_id');
    $GLOBALS['TL_DCA']['tl_book_chapter']['config']['label'] = \Muspellheim\Books\BookModel::findByPk($book_id)->title;
    $GLOBALS['TL_DCA']['tl_book_chapter']['list']['sorting']['root'] = \Muspellheim\Books\BookModel::findChildIds($book_id);
}

/**
 * Class tl_book_chapter.
 *
 * Provide miscellaneous methods that are used by the data configuration array
 * like callback methods.
 *
 * @copyright  Falko Schumann 2012
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Controller
 */
class tl_book_chapter extends Backend
{

    /**
     * @param \DataContainer
     */
    public function setBook(DataContainer $dc)
    {
        // Return if there is no active record (override all)
        if (!$dc->activeRecord)
        {
            return;
        }

        // Existing book
        if ($dc->activeRecord->tstamp > 0)
        {
            return;
        }

        // Set book as parent if insert as root element
        if ($dc->activeRecord->pid == 0)
        {
            $book_id = Input::get('book_id');
            $this->Database->prepare("UPDATE tl_book_chapter SET pid=? WHERE id=?")->execute($book_id, $dc->id);
        }
    }


    /**
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
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        $objVersions = new Versions('tl_book_chapter', $intId);
        $objVersions->initialize();

        // Update the database
        $this->Database->prepare("UPDATE tl_book_chapter SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_book_chapter.id=' . $intId . '" has been created', __METHOD__, TL_GENERAL);
    }


    /**
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
            $varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_book_chapter WHERE alias=?")->execute($varValue);

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
