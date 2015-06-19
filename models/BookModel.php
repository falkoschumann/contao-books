<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */

namespace Muspellheim;


/**
 * Reads and writes books.
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $sorting
 * @property integer $tstamp
 * @property string  $title
 * @property string  $alias
 * @property string  $type
 * @property string  $subtitle
 * @property string  $author
 * @property string  $year
 * @property string  $place
 * @property string  $language
 * @property string  $tags
 * @property string  $cssClass
 * @property boolean $hide
 * @property boolean $published
 * @property integer $book_id    id of the root element from current path.
 * @author Falko Schumann <https://github.com/falkoschumann/contao-books>
 */
class BookModel extends \Model
{

    /**
     * Name of the table.
     *
     * @var string
     */
    protected static $strTable = 'tl_book';

    /**
     * Details loaded.
     *
     * @var boolean
     */
    protected $blnDetailsLoaded = false;


    /**
     * Find the parent books of a book.
     *
     * @param integer $intId The book's ID.
     * @return \Model\Collection|null A collection of models or null if there are no parent books.
     */
    public static function findParentsById($intId)
    {
        $arrModels = array();

        while ($intId > 0 && ($objBook = static::findByPk($intId)) !== null) {
            $intId = $objBook->pid;
            $arrModels[] = $objBook;
        }

        if (empty($arrModels)) {
            return null;
        }

        return static::createCollection($arrModels, 'tl_book');
    }


    /**
     * Find a book by its ID and return it with the inherited details.
     *
     * @param integer $intId The book's ID.
     * @return \Model|null The model or null if there is no matching book.
     */
    public static function findWithDetails($intId)
    {
        $objBook = static::findByPk($intId);

        if ($objBook === null) {
            return null;
        }

        return $objBook->loadDetails();
    }


    /**
     * Get the details of a book including inherited parameters.
     *
     * @return \Model The book model
     */
    public function loadDetails()
    {
        // Loaded already
        if ($this->blnDetailsLoaded) {
            return $this;
        }

        $parents = $this->findParentsById($this->id);
        if ($parents === null) {
            $this->book_id = $this->id;
        } else {
            $this->book_id = $parents->last()->id;
        }

        // Prevent saving
        $this->preventSaving();
        $this->blnDetailsLoaded = true;

        return $this;
    }

}
