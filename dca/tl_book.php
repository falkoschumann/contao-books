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
 * Data Container Array for table `tl_book`
 *
 * Die Tabelle `tl_book` enthält sowohl Bücher als auch deren Kapitel. Initial
 * werden die Bücher als *List View* dargestellt. Der "Bearbeiten"-Link eines
 * Buches führt zum *Tree View* der Kapitel des Buches. Der "Bearbeiten"-Link
 * eines Kapitels führt zum *Parent View* in dem die Inhaltselemente des
 * Kapitels verwaltet werden.
 *
 * Für die unterschiedliche Darstellung der Bücher und Kapitel wird der DCA mit
 * den gemeinsamen Einstellungen beider Darstelungen initialisiert und im
 * Anschluss mit einer if-else-Klausel die Unterschiede konfiguriert.
 * Unterschieden werden die beiden Darstellungen durch den URL-Parameter
 * `book_id`. Ist der Parameter gesetzt, enhält er die ID des Buches, deren
 * Kapitel angezeigt werden sollen.
 *
 * Die folgende Tabelle zeigt die Verwendung der Spalten bei der Darstellung:
 *
 * Column      | Book  | Chapter
 * ------------|-------|--------
 * id          |   X   |   X
 * pid         |   -   |   X
 * sorting     |   X   |   X
 * tstamp      |   X   |   X
 * title       |   X   |   X
 * alias       |   X   |   X
 * subtitle    |   X   |   -
 * author      |   X   |   -
 * language    |   X   |   -
 * tags        |   X   |   -
 * abstract    |   X   |   -
 * published   |   X   |   X
 * show_in_toc |   -   |   X
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause http://opensource.org/licenses/BSD-2-Clause
 */


/**
 * Table tl_book
 */
$GLOBALS['TL_DCA']['tl_book'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'ctable' => array('tl_content'),
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'pid' => 'index',
                'alias' => 'index',
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('title'),
            'flag' => 1,
            'panelLayout' => 'sort,filter;search,limit'
        ),
        'label' => array
        (
            /* TODO subtitle and author are optional fields, rewrite to use label_callback */
            'fields' => array('title', 'subtitle', 'author'),
            'format' => '%s: %s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>'
        ),
        'global_operations' => array
        (
            'toggleNodes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['toggleAll'],
                'href' => 'ptg=all',
                'class' => 'header_toggle'
            ),
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['edit'],
                'href' => 'do=books',
                'icon' => 'edit.gif',
            ),
            'editheaders' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.gif'
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['toggle'],
                'icon' => 'visible.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_book', 'toggleIcon')
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array(''),
        'default' => '{book_legend},title,subtitle,alias,author;{meta_legend:hide},language,tags;{abstract_legend},abstract;{publish_legend},published'
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['title'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'search' => true,
            'sorting' => true,
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['alias'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'alnum', 'unique' => true, 'doNotCopy' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'search' => true,
            'save_callback' => array
            (
                array('tl_book', 'generateAlias')
            ),
            'sql' => "varbinary(128) NOT NULL default ''"
        ),
        'subtitle' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50'),
            'search' => true,
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'author' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['author'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50'),
            'filter' => true,
            'search' => true,
            'sorting' => true,
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'language' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['language'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('minlength' => 2, 'maxlength' => 2, 'rgxp' => 'alpha', 'tl_class' => 'w50'),
            'filter' => true,
            'sql' => "varchar(2) NOT NULL default ''"
        ),
        'tags' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['tags'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50'),
            'search' => true,
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'abstract' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['abstract'],
            'exclude' => true,
            'inputType' => 'textarea',
            'eval' => array('allowHtml' => true, 'rte' => 'tinyMCE', 'doNotShow' => true),
            'search' => true,
            'sql' => "mediumtext NOT NULL"

        ),
        'published' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['published'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'w50'),
            'filter' => true,
            'sql' => "char(1) NOT NULL default ''"
        ),
        'show_in_toc' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_book']['show_in_toc'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'w50'),
            'sql' => "char(1) NOT NULL default '1'"
        )
    )
);

if (Input::get('do') == 'books') {
    $book_id = Input::get('book_id');
    if ($book_id) {
        $GLOBALS['TL_DCA']['tl_book']['config']['label'] = \Muspellheim\Books\BookModel::findByPk($book_id)->title;
        $GLOBALS['TL_DCA']['tl_book']['config']['backlink'] = 'do=books';
        $GLOBALS['TL_DCA']['tl_book']['config']['onsubmit_callback'] = array
        (
            array('tl_book', 'setParent')
        );

        $GLOBALS['TL_DCA']['tl_book']['list']['sorting']['mode'] = 5;
        $GLOBALS['TL_DCA']['tl_book']['list']['sorting']['root'] = \Muspellheim\Books\BookModel::findChildIds($book_id);
        $GLOBALS['TL_DCA']['tl_book']['list']['sorting']['rootPaste'] = true;
        $GLOBALS['TL_DCA']['tl_book']['list']['operations']['edit']['href'] = 'table=tl_content';

        $GLOBALS['TL_DCA']['tl_book']['palettes']['default'] = '{book_legend},title,alias;{publish_legend},published,show_in_toc';

        $this->loadLanguageFile('tl_book_chapter');
        $GLOBALS['TL_LANG']['tl_book']['new'] = $GLOBALS['TL_LANG']['tl_book_chapter']['new'];
        $GLOBALS['TL_LANG']['tl_book']['edit'] = $GLOBALS['TL_LANG']['tl_book_chapter']['edit'];
        $GLOBALS['TL_LANG']['tl_book']['copy'] = $GLOBALS['TL_LANG']['tl_book_chapter']['copy'];
        $GLOBALS['TL_LANG']['tl_book']['delete'] = $GLOBALS['TL_LANG']['tl_book_chapter']['delete'];
        $GLOBALS['TL_LANG']['tl_book']['toggle'] = $GLOBALS['TL_LANG']['tl_book_chapter']['toggle'];
        $GLOBALS['TL_LANG']['tl_book']['show'] = $GLOBALS['TL_LANG']['tl_book_chapter']['show'];
        $GLOBALS['TL_LANG']['tl_book']['title'] = $GLOBALS['TL_LANG']['tl_book_chapter']['title'];
        $GLOBALS['TL_LANG']['tl_book']['alias'] = $GLOBALS['TL_LANG']['tl_book_chapter']['alias'];
        $GLOBALS['TL_LANG']['tl_book']['published'] = $GLOBALS['TL_LANG']['tl_book_chapter']['published'];
    } else {
        $GLOBALS['TL_DCA']['tl_book']['list']['sorting']['filter'] = array
        (
            array('pid=?', 0)
        );
        $GLOBALS['TL_DCA']['tl_book']['list']['operations']['edit']['button_callback'] = array('tl_book', 'editChapters');
    }
}

/**
 * Class tl_book
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
        if (strlen($this->Input->get('tid'))) {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
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
        if (!strlen($varValue)) {
            $autoAlias = true;
            $varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_book WHERE alias=?")->execute($varValue);

        // Check whether the news alias exists
        if ($objAlias->numRows > 1 && !$autoAlias) {
            throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        // Add ID to alias
        if ($objAlias->numRows && $autoAlias) {
            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }


    /**
     * @param \DataContainer
     */
    public function setParent(DataContainer $dc)
    {
        $this->log('Scheissdreck', __METHOD__, TL_ACCESS);

        // Return if there is no active record (override all)
        if (!$dc->activeRecord) {
            return;
        }

        $this->log('Foo', __METHOD__, TL_ACCESS);

        // Existing book
        if ($dc->activeRecord->tstamp > 0) {
            return;
        }

        $this->log('Bar', __METHOD__, TL_ACCESS);

        $book_id = Input::get('book_id');
        $this->Database->prepare("UPDATE tl_book SET pid=? WHERE id=?")->execute($book_id, $dc->id);
    }


    /**
     * Callback for edit button.
     *
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function editChapters($row, $href, $label, $title, $icon)
    {
        return '<a href="' . $this->addToUrl($href . '&amp;book_id=' . $row['id']) . '" title="' . specialchars($title) . '">' . Image::getHtml($icon, $label) . '</a> ';
    }

}
