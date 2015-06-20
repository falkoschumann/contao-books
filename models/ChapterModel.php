<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */

namespace Muspellheim;


/**
 * Reads and writes chapters.
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
 * @property integer $book    id of the root element from current path.
 * @author Falko Schumann <https://github.com/falkoschumann/contao-books>
 */
class ChapterModel extends \Model
{

    /**
     * Name of the table.
     *
     * @var string
     */
    protected static $strTable = 'tl_chapter';

    /**
     * Details loaded.
     *
     * @var boolean
     */
    protected $blnDetailsLoaded = false;


    /**
     * Find the parent chapters of a chapter.
     *
     * @param integer $intId The chapter's ID.
     * @return \Model\Collection|null A collection of models or null if there are no parent chapters.
     */
    public static function findParentsById($intId)
    {
        $arrModels = array();

        while ($intId > 0 && ($objChapter = static::findByPk($intId)) !== null) {
            $intId = $objChapter->pid;
            $arrModels[] = $objChapter;
        }

        if (empty($arrModels)) {
            return null;
        }

        return static::createCollection($arrModels, 'tl_chapter');
    }


    /**
     * Find a chapter by its ID and return it with the inherited details.
     *
     * @param integer $intId The chapter's ID.
     * @return \Model|null The model or null if there is no matching chapter.
     */
    public static function findWithDetails($intId)
    {
        $objChapter = static::findByPk($intId);

        if ($objChapter === null) {
            return null;
        }

        return $objChapter->loadDetails();
    }


    /**
     * Get the details of a chapter including inherited parameters.
     *
     * @return \Model The chapter model
     */
    public function loadDetails()
    {
        // Loaded already
        if ($this->blnDetailsLoaded) {
            return $this;
        }

        $parents = $this->findParentsById($this->id);
        if ($parents === null) {
            $this->book = $this->id;
        } else {
            $this->book = $parents->last()->id;
        }

        // Prevent saving
        $this->preventSaving();
        $this->blnDetailsLoaded = true;

        return $this;
    }

}
