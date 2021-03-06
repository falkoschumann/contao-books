<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Models
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * The model for chapter.
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Models
 * @property int     $id             Die ID des Kapitels
 * @property int     $pid            Die ID des übergeordneten Kapitels
 * @property int     $sorting        Der Sortierindex des Kapitels
 * @property int     $tstamp         Das Änderungsdatum der Metainformationen des Kapitels
 * @property string  $title          Der Titel des Kapitels
 * @property string  $alias          Der Kapitelalias
 * @property string  $type           Der Kapiteltyp
 * @property boolean $published      Flag ob das Kapitel veröffentlicht ist
 * @property boolean $book_id        Die ID des Buches zu dem das Kapitel gehört
 * @property boolean $show_in_toc    Das Kapitel im Inhaltsverzeichnis anzeigen
 */
class ChapterModel extends \Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_chapter';


    public function __get($key)
    {
        switch ($key) {
            case 'relatedBook':
                return $this->getRelated('pid');
            default:
                return parent::__get($key);
        }
    }


    /**
     * @param int $pid
     * @return ChapterModel|Collection|null
     */
    public static function findPublishedByPid($pid)
    {
        $t = static::$strTable;
        $columns = array("$t.pid=?");
        $options['order'] = "$t.pid, $t.sorting";

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=1";
        }

        $values = array($pid);
        return static::findBy($columns, $values, $options);
    }


    /**
     * @param int $id
     * @return ChapterModel|null
     */
    public static function findPublishedById($id)
    {
        $t = static::$strTable;
        $columns = array("$t.id=?");

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=1";
        }
        return static::findOneBy($columns, $id);
    }


    /**
     * @param ChapterModel $chapter
     * @return ChapterModel|null
     */
    public static function findPreviousPublishedFor($chapter)
    {
        $t = static::$strTable;
        $columns = array("$t.pid=?", "$t.sorting<?");

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=1";
        }
        $options = array
        (
            'order' => 'sorting DESC'
        );
        return static::findOneBy($columns, array($chapter->pid, $chapter->sorting), $options);
    }


    /**
     * @param ChapterModel $chapter
     * @return ChapterModel|null
     */
    public static function findNextPublishedFor($chapter)
    {
        $t = static::$strTable;
        $columns = array("$t.pid=?", "$t.sorting>?");

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=1";
        }
        $options = array
        (
            'order' => 'sorting'
        );
        return static::findOneBy($columns, array($chapter->pid, $chapter->sorting), $options);
    }


    /**
     * The chapters label contains the title; tags added to the title if present.
     *
     * @return string the book label.
     */
    public function label()
    {
        $result = $this->title;
        if ($this->tags) {
            $tags = '[' . implode('] [', preg_split('/\s*,\s*/', $this->tags)) . ']';
            $result .= ' <span style="font-weight:bold;padding-left:20px;float:right;">' . $tags . '</span>';
        }
        return $result;
    }


    /**
     * @param ChapterModel
     * @return string
     */
    public static function getUrlForChapter($chapter)
    {
        $prefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/';
        $aliasIsSet = $chapter->alias != '';
        $aliasEnabled = !$GLOBALS['TL_CONFIG']['disableAlias'];
        $item = ($aliasIsSet && $aliasEnabled) ? $chapter->alias : $chapter->id;
        return \Controller::generateFrontendUrl($GLOBALS['objPage']->row(), $prefix . $item);
    }


    /**
     * @param int $chapterId
     * @return string
     */
    public static function renderContent($chapterId)
    {
        $strContent = '';
        $objElements = \ContentModel::findPublishedByPidAndTable($chapterId, 'tl_chapter');
        if ($objElements !== null) {
            while ($objElements->next()) {
                $strContent .= \Controller::getContentElement($objElements->id);
            }
        }
        return $strContent;
    }


    /**
     * @param ChapterModel $objChapter
     * @return ChapterModel|null
     */
    public static function findRoot($objChapter)
    {
        $objParentChapter = $objChapter;
        do {
            $objParentChapter = static::findById($objParentChapter->pid);
        } while ($objParentChapter !== null && $objParentChapter->pid != 0);
        return $objParentChapter;
    }

}
