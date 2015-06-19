<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */


/**
 * Table tl_book
 */
$GLOBALS['TL_DCA']['tl_book'] = array
(

    // Config
    'config'   => array
    (
        'label'            => Config::get('websiteTitle'),
        'dataContainer'    => 'Table',
        'ctable'           => array('tl_content'),
        'enableVersioning' => true,
        'onload_callback'  => array
        (
            array('tl_book', 'setRootType'),
        ),
        'sql'              => array
        (
            'keys' => array
            (
                'id'    => 'primary',
                'pid'   => 'index',
                'alias' => 'index',
                'type'  => 'index'
            )
        )
    ),
    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => 5,
            'icon'        => 'pagemounts.gif',
            'panelLayout' => 'filter,search'
        ),
        'label'             => array
        (
            'fields'         => array('title'),
            'format'         => '%s',
            'label_callback' => array('tl_book', 'addIcon')
        ),
        'global_operations' => array
        (
            'toggleNodes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['toggleAll'],
                'href'  => 'ptg=all',
                'class' => 'header_toggle'
            ),
            'all'         => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'       => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
//                'button_callback' => array('tl_book', 'editPage')
            ),
            'copy'       => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['copy'],
                'href'       => 'act=paste&amp;mode=copy',
                'icon'       => 'copy.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'copyPage')
            ),
            'copyChilds' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['copyChilds'],
                'href'       => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon'       => 'copychilds.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'copyPageWithSubpages')
            ),
            'cut'        => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['cut'],
                'href'       => 'act=paste&amp;mode=cut',
                'icon'       => 'cut.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'cutPage')
            ),
            'delete'     => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'deletePage')
            ),
            'toggle'     => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['toggle'],
                'icon'       => 'visible.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
//                'button_callback' => array('tl_book', 'toggleIcon')
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
    // TODO Check if types regular and root are necessary or it can be book and chapter
    'palettes' => array
    (
        '__selector__' => array('type'),
        'default'      => '{title_legend},title,alias,type',
        'regular'      => '{title_legend},title,alias;{meta_legend:hide},tags;{expert_legend:hide},cssClass,hide;{publish_legend},published',
        'root'         => '{title_legend},title,subtitle;{meta_legend:hide},year,place,language,tags;{expert_legend:hide},cssClass;{publish_legend},published',
    ),
    // Fields
    'fields'   => array
    (
        'id'        => array
        (
            'label'  => array('ID'),
            'search' => true,
            'sql'    => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid'       => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting'   => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
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
            'search'    => true,
            'eval'      => array(
                'mandatory'      => true,
                'maxlength'      => 255,
                'decodeEntities' => true,
                'tl_class'       => 'w50'
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'alias'     => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_book']['alias'],
            'exclude'       => true,
            'inputType'     => 'text',
            'search'        => true,
            'eval'          => array('rgxp' => 'folderalias', 'maxlength' => 128, 'tl_class' => 'w50 clr'),
            'save_callback' => array(
                array('tl_book', 'generateAlias')
            ),
            'sql'           => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'type'      => array
        (
            'label'   => &$GLOBALS['TL_LANG']['tl_book']['type'],
            'exclude' => true,
            'default' => 'regular',
            'sql'     => "varchar(32) NOT NULL default ''"
        ),
        'subtitle'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'author'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['author'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'year'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['year'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('minlength' => 4, 'maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "varchar(4) NOT NULL default ''"
        ),
        'place'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['place'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'language'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['language'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('rgxp' => 'language', 'maxlength' => 5, 'nospace' => true, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(5) NOT NULL default ''"
        ),
        'tags'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['tags'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'cssClass'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['cssClass'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 64, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'hide'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['hide'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['published'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('submitOnChange' => true, 'doNotCopy' => true),
            'sql'       => "char(1) NOT NULL default ''"
        )
    )
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Falko Schumann <https://github.com/falkoschumann/contao-books>
 */
class tl_book extends Backend
{

    /**
     * Make new top-level elements books or root chapters.
     *
     * @param \DataContainer
     */
    public function setRootType(DataContainer $dc)
    {
        if (Input::get('act') != 'create') {
            return;
        }

        // Insert into
        if (Input::get('pid') == 0) {
            $GLOBALS['TL_DCA']['tl_book']['fields']['type']['default'] = 'root';
        } elseif (Input::get('mode') == 1) {
            $objPage = $this->Database->prepare("SELECT * FROM " . $dc->table . " WHERE id=?")
            ->limit(1)
            ->execute(Input::get('pid'));

            if ($objPage->pid == 0) {
                $GLOBALS['TL_DCA']['tl_book']['fields']['type']['default'] = 'root';
            }
        }
    }


    /**
     * Add an image to each book in the tree.
     *
     * @param array
     * @param string
     * @param \DataContainer
     * @param string
     * @param boolean
     * @param boolean
     * @return string
     */
    public function addIcon(
        $row,
        $label,
        DataContainer $dc = null,
        $imageAttribute = '',
        $blnReturnImage = false,
        $blnProtected = false
    ) {
        $image = tl_book::getBookStatusIcon((object)$row);

        // Return the image only
        if ($blnReturnImage) {
            return \Image::getHtml($image, '', $imageAttribute);
        }

        // Mark root
        if ($row['type'] == 'root') {
            $label = '<strong>' . $label . '</strong>';
        }

//        // Add the breadcrumb link
//        $label = '<a href="' . \Controller::addToUrl('node=' . $row['id']) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['selectNode']) . '">' . $label . '</a>';

        // Return the image
        return \Image::getHtml($image, '', $imageAttribute) . ' ' . $label;
    }


    /**
     * Calculate the book status icon name based on the book parameters.
     *
     * @param object $objBook The book object.
     * @return string The status icon name.
     */
    private static function getBookStatusIcon($objBook)
    {
        $sub = 0;
        $image = 'system/modules/books/assets/' . $objBook->type . '.png';

        // Book not published or not active
        if (!$objBook->published || ($objBook->start != '' && $objBook->start > time()) || ($objBook->stop != '' && $objBook->stop < time())) {
            $sub += 1;
        }

        // Book hidden from menu
        if ($objBook->hide && !in_array($objBook->type, array('root'))) {
            $sub += 2;
        }

        // Get the image name
        if ($sub > 0) {
            $image = 'system/modules/books/assets/' . $objBook->type . '_' . $sub . '.png';
        }

        return $image;
    }


    /**
     * Auto-generate a book alias if it has not been set yet.
     *
     * @param mixed
     * @param \DataContainer
     * @return string
     * @throws \Exception
     */
    public function generateAlias($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord->type === "root") {
            return;
        }

        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_book WHERE id=? OR alias=?")->execute($dc->id,
            $varValue);

        // Check whether the book alias exists
        if ($objAlias->numRows > ($autoAlias ? 0 : 1)) {
            $arrBooks = array();
            $strBook = 0;

            while ($objAlias->next()) {
                $objCurrentBook = BookModel::findWithDetails($objAlias->id);
                $book = $objCurrentBook->book_id;

                // Store the current book's data
                if ($objCurrentBook->id == $dc->id) {
                    $strBook = $book;
                } else {
                    $arrBooks[$book][] = $objAlias->id;
                }
            }

            $arrCheck = $arrBooks[$strBook];

            // Check if there are multiple results for the current domain
            if (!empty($arrCheck)) {
                if ($autoAlias) {
                    $varValue .= '-' . $dc->id;
                } else {
                    throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
                }
            }
        }

        return $varValue;
    }

}
