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
 * Data container array for table `tl_book`.
 *
 * Store books meta data like title and author. The books chapters are stored in
 * `tl_chapter`. The chapter table is not a child table because pid column is
 * used for the chapter tree. Instead a root chapter is defined.
 *
 * The books are shown as list view.
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
                'id' => 'primary'
            )
        ),
        'onsubmit_callback' => array
        (
            array('tl_book', 'createRootChapterIfNotExists')
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
        'default'      => '{book_legend},title,subtitle,author;{meta_legend:hide},year,place,language,tags;{expert_legend:hide},cssID;{publish_legend},published'
    ),
    // Fields
    'fields'   => array
    (
        'id'           => array
        (
            'label'  => array('ID'),
            'search' => true,
            'sql'    => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'       => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['title'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'subtitle'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'author'       => array
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
        'year'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['year'],
            'exclude'   => true,
            'sorting'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => array('minlength' => 4, 'maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "varchar(4) NOT NULL default ''"
        ),
        'place'        => array
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
        'language'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['language'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => array('minlength' => 2, 'maxlength' => 2, 'rgxp' => 'alpha', 'tl_class' => 'w50'),
            'sql'       => "varchar(2) NOT NULL default ''"
        ),
        'tags'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['tags'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'cssID'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['cssID'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('multiple' => true, 'size' => 2, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'published'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['published'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'root_chapter' => array
        (
            'label'      => &$GLOBALS['TL_LANG']['tl_book']['root_chapter'],
            'sql'        => "int(10) unsigned NOT NULL default '0'",
            'foreignKey' => 'tl_chapter.id',
            'relation'   => array('type' => 'hasOne', 'load' => 'lazy')
        )
    )
);


/**
 * Provide miscellaneous methods that are used by the data container array of
 * table `tl_book`.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Books
 */
class tl_book extends Backend
{

    /**
     * This `label_callback` return the label of a book.
     *
     * @param array $row a data row for a book.
     * @return string the book label.
     */
    public function bookLabel($row)
    {
        $book = new BookModel();
        $book->setRow($row);
        return $book->label();
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
        $href = $this->addToUrl($href . '&amp;table=tl_chapter&amp;book_id=' . $row['id']);
        return '<a href="' . $href . '" title="' . specialchars($title) . '">' . Image::getHtml($icon,
            $label) . '</a> ';
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

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
            $label) . '</a> ';
    }


    /**
     * Toggle the visibility of the book with given id.
     *
     * @param integer $id      the books id.
     * @param boolean $visible the current visibility.
     */
    private function toggleVisibility($id, $visible)
    {
        $objVersions = new Versions('tl_book', $id);
        $objVersions->initialize();
        $this->Database->prepare("UPDATE tl_book SET tstamp=" . time() . ", published='" . ($visible ? 1 : '') . "' WHERE id=?")->execute($id);
        $objVersions->create();
        $this->log('A new version of record "tl_book.id=' . $id . '" has been created', __METHOD__, TL_GENERAL);
    }


    /**
     * This `onsubmit_callback` create or update the root chapter of a book.
     *
     * @param \DataContainer $dc
     */
    public function createRootChapterIfNotExists(DataContainer $dc)
    {
        $rootChapterId = $dc->activeRecord->root_chapter;
        if ($rootChapterId > 0) {
            return;
        }

        $rootChapter = new \Muspellheim\Books\ChapterModel();
        $rootChapter->published = true;
        $rootChapter->type = 'root';
        $rootChapter = $rootChapter->save();

        $this->Database->prepare('UPDATE tl_book SET root_chapter=? WHERE id=?')->execute($rootChapter->id, $dc->id);
    }


    /**
     * This `ondelete_callback` delete all chapters from a book.
     *
     * @param \DataContainer $dc
     */
    public function deleteChapters(DataContainer $dc)
    {
        if (!$dc->id) {
            return;
        }

        $rootChapter = \Muspellheim\Books\ChapterModel::findByPk($dc->activeRecord->root_chapter);
        if ($rootChapter) {
            $this->log('Delete root chapter ' . $rootChapter->id . '.', __METHOD__, TL_GENERAL);
			$chapterTable = new DC_Table('tl_chapter');
			$chapterTable->intId = $rootChapter->id;
			$chapterTable->delete(true);
        }
    }


    /**
     * This `oncopy_callback` copy all chapters from a book.
     *
     * @param integer   $newBookId
     * @param \DC_Table $bookTable
     */
    public function copyChapters($newBookId, DC_Table $bookTable)
    {
        $this->log('Copy ' . $bookTable->table . ' ' . $bookTable->id . ' to ' . $newBookId, __METHOD__, TL_GENERAL);
        $chapterIds = \Muspellheim\Books\ChapterModel::findChapterIdsByBookIds($bookTable->id);
        $chapterTable = new DC_Table('tl_chapter');
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
