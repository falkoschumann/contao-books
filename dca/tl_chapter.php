<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */


/**
 * Table tl_chapter
 */
$GLOBALS['TL_DCA']['tl_chapter'] = array
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
            array('tl_chapter', 'setRootType'),
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
            'label_callback' => array('tl_chapter', 'addIcon')
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
                'label' => &$GLOBALS['TL_LANG']['tl_chapter']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'copy'       => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_chapter']['copy'],
                'href'       => 'act=paste&amp;mode=copy',
                'icon'       => 'copy.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
            ),
            'copyChilds' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['copyChilds'],
                'href'            => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon'            => 'copychilds.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset()"',
                'button_callback' => array('tl_chapter', 'copyChapterWithSubchapters')
            ),
            'cut'        => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_chapter']['cut'],
                'href'       => 'act=paste&amp;mode=cut',
                'icon'       => 'cut.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"'
            ),
            'delete'     => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_chapter']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle'     => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_chapter', 'toggleIcon')
            ),
            'show'       => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_chapter']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__' => array('type'),
        'default'      => '{title_legend},title,alias,type',
        'regular'      => '{title_legend},title,alias;{meta_legend:hide},tags;{expert_legend:hide},cssID,hide;{publish_legend},published',
        'root'         => '{title_legend},title,subtitle;{meta_legend:hide},year,place,language,tags;{expert_legend:hide},cssID;{publish_legend},published',
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
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['title'],
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
            'label'         => &$GLOBALS['TL_LANG']['tl_chapter']['alias'],
            'exclude'       => true,
            'inputType'     => 'text',
            'search'        => true,
            'eval'          => array('rgxp' => 'folderalias', 'maxlength' => 128, 'tl_class' => 'w50 clr'),
            'save_callback' => array(
                array('tl_chapter', 'generateAlias')
            ),
            'sql'           => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'type'      => array
        (
            'label'   => &$GLOBALS['TL_LANG']['tl_chapter']['type'],
            'exclude' => true,
            'default' => 'regular',
            'sql'     => "varchar(32) NOT NULL default ''"
        ),
        'subtitle'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['subtitle'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'author'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['author'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'year'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['year'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('minlength' => 4, 'maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "varchar(4) NOT NULL default ''"
        ),
        'place'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['place'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'language'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['language'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('rgxp' => 'language', 'maxlength' => 5, 'nospace' => true, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(5) NOT NULL default ''"
        ),
        'tags'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['tags'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'cssID'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['cssID'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('multiple' => true, 'size' => 2, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'hide'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['hide'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['published'],
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
class tl_chapter extends Backend
{

    /**
     * Make new top-level elements root chapters (books).
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
            $GLOBALS['TL_DCA']['tl_chapter']['fields']['type']['default'] = 'root';
        } elseif (Input::get('mode') == 1) {
            $objChapter = $this->Database->prepare("SELECT * FROM " . $dc->table . " WHERE id=?")->limit(1)->execute(Input::get('pid'));

            if ($objChapter->pid == 0) {
                $GLOBALS['TL_DCA']['tl_chapter']['fields']['type']['default'] = 'root';
            }
        }
    }


    /**
     * Add an image to each chapter in the tree.
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
        // TODO display subtitle and author if given

        $image = tl_chapter::getChapterStatusIcon((object)$row);

        // Return the image only
        if ($blnReturnImage) {
            return \Image::getHtml($image, '', $imageAttribute);
        }

        // Mark root
        if ($row['type'] == 'root') {
            $label = '<strong>' . $label . '</strong>';
        }

        // Return the image
        return \Image::getHtml($image, '', $imageAttribute) . ' ' . $label;
    }


    /**
     * Calculate the chapter status icon name based on the chapter parameters.
     *
     * @param object $objChapter The chapter object.
     * @return string The status icon name.
     */
    private static function getChapterStatusIcon($objChapter)
    {
        $sub = 0;
        $image = 'system/modules/books/assets/' . $objChapter->type . '.png';

        // Chapter not published or not active
        if (!$objChapter->published || ($objChapter->start != '' && $objChapter->start > time()) || ($objChapter->stop != '' && $objChapter->stop < time())) {
            $sub += 1;
        }

        // Chapter hidden from table of contents
        if ($objChapter->hide && !in_array($objChapter->type, array('root'))) {
            $sub += 2;
        }

        // Get the image name
        if ($sub > 0) {
            $image = 'system/modules/books/assets/' . $objChapter->type . '_' . $sub . '.png';
        }

        return $image;
    }


    /**
     * Auto-generate a chapter alias if it has not been set yet.
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

        $objAlias = $this->Database->prepare("SELECT id FROM tl_chapter WHERE id=? OR alias=?")->execute($dc->id,
            $varValue);

        // Check whether the chapter alias exists
        if ($objAlias->numRows > ($autoAlias ? 0 : 1)) {
            $arrChapters = array();
            $strChapter = 0;

            while ($objAlias->next()) {
                $objCurrentChapter = ChapterModel::findWithDetails($objAlias->id);
                $book = $objCurrentChapter->book;

                // Store the current chapter's data
                if ($objCurrentChapter->id == $dc->id) {
                    $strChapter = $book;
                } else {
                    $arrChapters[$book][] = $objAlias->id;
                }
            }

            $arrCheck = $arrChapters[$strChapter];

            // Check if there are multiple results for the current book
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


    /**
     * Return the copy chapter with subchapters button.
     *
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function copyChapterWithSubchapters($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed']) {
            return '';
        }

        $objSubchapters = $this->Database->prepare("SELECT * FROM tl_chapter WHERE pid=?")->limit(1)->execute($row['id']);

        return $objSubchapters->numRows ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
    }


    /**
     * Return the "toggle visibility" button.
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
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
            $label) . '</a> ';
    }


    /**
     * Disable/enable a chapter.
     *
     * @param integer
     * @param boolean
     * @param \DataContainer
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc = null)
    {
        $objVersions = new Versions('tl_chapter', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_chapter']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_chapter']['fields']['published']['save_callback'] as $callback) {
                if (is_array($callback)) {
                    $this->import($callback[0]);
                    $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
                } elseif (is_callable($callback)) {
                    $blnVisible = $callback($blnVisible, ($dc ?: $this));
                }
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_chapter SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_chapter.id=' . $intId . '" has been created' . $this->getParentEntries('tl_chapter',
                $intId), __METHOD__, TL_GENERAL);
    }

}
