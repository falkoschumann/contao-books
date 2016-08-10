<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2016 Falko Schumann
 *
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Muspellheim\Books;


/**
 * The model for book.
 *
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @property int     $id             book id
 * @property int     $tstamp         timestamp of last edit
 * @property string  $title          book title
 * @property string  $alias          URL alias
 * @property int     $root_chapter   id of the root chapter
 * @property string  $subtitle       book subtitle
 * @property string  $author         book author
 * @property string  $year           publication year
 * @property string  $location       publication location
 * @property string  $language       books language
 * @property string  $tags           comma seperated list of tags
 * @property boolean $published      show book in frontend?
 */
class BookModel extends \Model
{

    // TODO call root chapter by reference, instead of id

    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_book';


    /**
     * @param int id
     * @return BookModel|null
     */
    public static function findPublishedById($id)
    {
        $t = static::$strTable;
        $arrColumns = array("$t.id=?");

        if (!BE_USER_LOGGED_IN) {
            $arrColumns[] = "$t.published=1";
        }
        return static::findOneBy($arrColumns, $id);
    }

    /**
     * @param int rootChapterId
     * @return BookModel|null
     */
    public static function findByRootChapter($rootChapterId)
    {
        $t = static::$strTable;
        $arrColumns = array("$t.root_chapter=?");
        return static::findOneBy($arrColumns, $rootChapterId);
    }

    /**
     * The books label contains the title; subtitle, author and tags added to the title if present.
     *
     * @return string the book label.
     */
    public function label()
    {
        $result = $this->title;
        if ($this->subtitle) {
            $result .= '. ' . $this->subtitle;
        }
        if ($this->author) {
            $result .= ' <span style="color:#b3b3b3;padding-left:3px">[' . $this->author . ']</span>';
        }
        if ($this->tags) {
            $tags = '[' . implode('] [', preg_split('/\s*,\s*/', $this->tags)) . ']';
            $result .= ' <span style="font-weight:bold;padding-left:20px;float:right;">' . $tags . '</span>';
        }
        return $result;
    }

}
