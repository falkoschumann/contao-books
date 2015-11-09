<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


/**
 * Data container array for table `tl_chapter`.
 *
 * Store chapters meta data like title and publishing state. The chapters text
 * is stored in child table `tl_content`.
 *
 * The chapters are shown as tree view.
 */
$GLOBALS['TL_DCA']['tl_chapter'] = array
(

    // Config
    'config'   => array
    (
        'label'            => $GLOBALS['TL_CONFIG']['websiteTitle'],
        'dataContainer'    => 'Table',
        'ctable'           => array('tl_content'),
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id'    => 'primary',
                'pid'   => 'index',
                'alias' => 'index'
            )
        ),
        'backlink'         => 'do=books',
        'onload_callback'  => array
        (
            array('tl_chapter', 'filterChaptersOfSelectedBook')
        )
    ),
    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'                  => 5,
            'icon'                  => 'system/modules/books/assets/book.png',
            'paste_button_callback' => array('tl_chapter', 'pastePage'),
            'panelLayout'           => 'filter,search',
            'rootPaste'             => false
        ),
        'label'             => array
        (
            'fields'         => array('title'),
            'format'         => '%s',
            'label_callback' => array('tl_chapter', 'chapterLabel')
        ),
        'global_operations' => array
        (
            'editbookheaders' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_chapter']['editbookheader'],
                'href'  => 'act=edit&amp;table=tl_book&amp;id=' . $_GET['book_id'],
                'icon'  => 'header.gif'
            ),
            'toggleNodes'     => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['toggleAll'],
                'href'  => 'ptg=all',
                'class' => 'header_toggle'
            ),
            'all'             => array
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
                'label' => &$GLOBALS['TL_LANG']['tl_chapter']['edit'],
                'href'  => 'table=tl_content',
                'icon'  => 'edit.gif'
            ),
            'editheaders' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['editheader'],
                'href'            => 'act=edit',
                'icon'            => 'header.gif',
                'button_callback' => array('tl_chapter', 'editHeaders')
            ),
            'copy'        => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['copy'],
                'href'            => 'act=paste&amp;mode=copy',
                'icon'            => 'copy.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset()"',
                'button_callback' => array('tl_chapter', 'copyChapter')
            ),
            'copyChilds'  => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['copyChilds'],
                'href'            => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon'            => 'copychilds.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset()"',
                'button_callback' => array('tl_chapter', 'copyChapterWithSubchapters')
            ),
            'cut'         => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['cut'],
                'href'            => 'act=paste&amp;mode=cut',
                'icon'            => 'cut.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset()"',
                'button_callback' => array('tl_chapter', 'cutChapter')
            ),
            'delete'      => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['delete'],
                'href'            => 'act=delete',
                'icon'            => 'delete.gif',
                'attributes'      => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
                'button_callback' => array('tl_chapter', 'deleteChapter')
            ),
            'toggle'      => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_chapter']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_chapter', 'toggleIcon')
            ),
            'show'        => array
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
        'default'      => '',
        'regular'      => '{chapter_legend},title,alias;{meta_legend:hide},tags;{expert_legend:hide},cssID,hide;{publish_legend},published'
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
            'label' => &$GLOBALS['TL_LANG']['tl_chapter']['tstamp'],
            'sql'   => "int(10) unsigned NOT NULL default '0'"
        ),
        'title'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['title'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'alias'     => array
        (
            'label'         => $GLOBALS['TL_LANG']['tl_chapter']['alias'],
            'exclude'       => true,
            'search'        => true,
            'inputType'     => 'text',
            'eval'          => array(
                'rgxp'              => 'alnum',
                'unique'            => true,
                'doNotCopy'         => true,
                'spaceToUnderscore' => true,
                'maxlength'         => 128,
                'tl_class'          => 'w50'
            ),
            'sql'           => "varbinary(128) NOT NULL default ''",
            'save_callback' => array
            (
                array('tl_chapter', 'generateAlias')
            )
        ),
        'type'      => array
        (
            'label'   => &$GLOBALS['TL_LANG']['tl_chapter']['type'],
            'default' => 'regular',
            'sql'     => "varchar(32) NOT NULL default ''"
        ),
        'tags'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_chapter']['tags'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
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
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        )
    )
);


/**
 * Provide miscellaneous methods that are used by the data container array of
 * table `tl_chapter`.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Books
 */
class tl_chapter extends Backend
{

    public function filterChaptersOfSelectedBook(DataContainer $dc)
    {
        if (Input::get('book_id')) {
            $book = BookModel::findByPk(Input::get('book_id'));
            $GLOBALS['TL_DCA']['tl_chapter']['list']['sorting']['root'] = array($book->root_chapter);
        }
    }


    /**
     * This `paste_button_callback` returns the paste chapter button.
     *
     * @param \DataContainer $dc
     * @param array          $row
     * @param string         $table
     * @param boolean        $cr
     * @param array          $arrClipboard
     * @return string
     */
    public function pastePage(DataContainer $dc, $row, $table, $cr, $arrClipboard = null)
    {
        $disablePA = false;
        $disablePI = false;

        // Disable all buttons if there is a circular reference
        if ($arrClipboard !== false && ($arrClipboard['mode'] == 'cut' && ($cr == 1 || $arrClipboard['id'] == $row['id'])
                || $arrClipboard['mode'] == 'cutAll' && ($cr == 1 || in_array($row['id'], $arrClipboard['id'])))
        ) {
            $disablePA = true;
            $disablePI = true;
        }

        // Prevent adding non-root chapter on top-level
        if (Input::get('mode') != 'create' && $row['pid'] == 0) {
            $objPage = $this->Database->prepare("SELECT * FROM " . $table . " WHERE id=?")
                ->limit(1)
                ->execute(Input::get('id'));

            if ($objPage->type != 'root') {
                $disablePA = true;

                if ($row['id'] == 0) {
                    $disablePI = true;
                }
            }
        }

        // Prevent creating root chapters
        if ($row['pid'] == 0) {
            $disablePA = true;
        }

        $return = '';

        // Return the buttons
        $imagePasteAfter = Image::getHtml('pasteafter.gif',
            sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1], $row['id']));
        $imagePasteInto = Image::getHtml('pasteinto.gif',
            sprintf($GLOBALS['TL_LANG'][$table]['pasteinto'][1], $row['id']));

        if ($row['id'] > 0) {
            $return = $disablePA ? Image::getHtml('pasteafter_.gif') . ' ' :
                '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&amp;mode=1&amp;pid=' . $row['id'] .
                    (!is_array($arrClipboard['id']) ? '&amp;id=' . $arrClipboard['id'] : '')) .
                '" title="' . specialchars(sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1],
                    $row['id'])) . '" onclick="Backend.getScrollOffset()">' . $imagePasteAfter . '</a> ';
        }

        return $return . ($disablePI ? Image::getHtml('pasteinto_.gif') . ' ' :
            '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&amp;mode=2&amp;pid=' . $row['id'] .
                (!is_array($arrClipboard['id']) ? '&amp;id=' . $arrClipboard['id'] : '')) .
            '" title="' . specialchars(sprintf($GLOBALS['TL_LANG'][$table]['pasteinto'][1],
                $row['id'])) . '" onclick="Backend.getScrollOffset()">' . $imagePasteInto . '</a> ');
    }


    /**
     * This `label_callback` add an individual image as icon and tags if present to the default label.
     *
     * @param array         $row            a books data row.
     * @param string        $label          the chapters label.
     * @param DataContainer $dc             the current data container.
     * @param string        $imageAttribute additional image attributes.
     * @param boolean       $blnReturnImage return the image only?
     * @return string the HTML image link and text link.
     */
    public function chapterLabel($row, $label, DataContainer $dc = null, $imageAttribute = '', $blnReturnImage = false)
    {
        $chapter = new ChapterModel();
        $chapter->setRow($row);

        $image = $this::getChapterStatusIcon((object)$row);
        $image = \Image::getHtml($image, '', $imageAttribute);

        // Return the image only
        if ($blnReturnImage) {
            return $image;
        }

        // Mark root pages
        if ($row['type'] == 'root') {
            $this->log("search book with root_chapter=" . $chapter->id, __FUNCTION__, TL_GENERAL);
            $book = Muspellheim\Books\BookModel::findByRootChapter($chapter->id);
            $label = '<strong>' . $book->label() . '</strong>';
        } else {
            $label = $chapter->label();
        }

        // Return the image
        return $image . ' ' . $label;
    }


    /**
     * Calculate the chapter status icon name based on the chapter parameters.
     *
     * @param object $objChapter The page object
     *
     * @return string The status icon name
     */
    private static function getChapterStatusIcon($objChapter)
    {
        $sub = 0;
        $image = 'system/modules/books/assets/' . $objChapter->type . '.png';

        // Chapter not published or not active
        if (!$objChapter->published) {
            $sub += 1;
        }

        // Chapter hidden from table of content
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
     * Return the copy chapter button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     * @return string
     */
    public function editHeaders($row, $href, $label, $title, $icon, $attributes, $table)
    {
        // TODO edit book headers for root chapter

        $disabled = Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
        $enabled = '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ';
        return $row['type'] === 'root' ? $disabled : $enabled;
    }


    /**
     * Return the copy chapter button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     * @return string
     */
    public function copyChapter($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed']) {
            return '';
        }

        $disabled = Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
        $enabled = '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ';
        return $row['type'] === 'root' ? $disabled : $enabled;
    }


    /**
     * Return the copy chapter with subchapters button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     * @return string
     */
    public function copyChapterWithSubchapters($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed']) {
            return '';
        }

        $objSubchapters = $this->Database->prepare("SELECT * FROM tl_chapter WHERE pid=?")->limit(1)->execute($row['id']);

        $disabled = Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
        $enabled = '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ';
        return ($objSubchapters->numRows && $row['type'] !== 'root') ? $enabled : $disabled;
    }


    /**
     * Return the cut chapter button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     * @return string
     */
    public function cutChapter($row, $href, $label, $title, $icon, $attributes, $table)
    {
        $disabled = Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
        $enabled = '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ';
        return $row['type'] === 'root' ? $disabled : $enabled;
    }


    /**
     * Return the delete chapter button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     * @return string
     */
    public function deleteChapter($row, $href, $label, $title, $icon, $attributes, $table)
    {
        $disabled = Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
        $enabled = '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
                $label) . '</a> ';
        return $row['type'] === 'root' ? $disabled : $enabled;
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
        if ($row['type'] === 'root') {
            return Image::getHtml('invisible.gif') . ' ';
        }

        $this->import('BackendUser', 'User');

        if (strlen($this->Input->get('tid'))) {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_chapter::published', 'alexf')) {
            return '';
        }

        $href .= '&amp;id=' . $this->Input->get('id') . '&amp;tid=' . $row['id'] . '&amp;state=' . $row[''];

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }


    /**
     * Toggle the visibility of the chapter with given id.
     *
     * @param integer $intId        the chapter id.
     * @param boolean $blnPublished the current visibility.
     */
    public function toggleVisibility($intId, $blnPublished)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_chapter::published', 'alexf')) {
            $this->log('Not enough permissions to show/hide record ID "' . $intId . '"', 'tl_chapter toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $objVersions = new Versions('tl_chapter', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_chapter']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_chapter']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_chapter SET tstamp=" . time() . ", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_chapter.id=' . $intId . '" has been created', __METHOD__, TL_GENERAL);
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

        $objAlias = $this->Database->prepare("SELECT id FROM tl_chapter WHERE alias=?")->execute($value);

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

}
