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
 * Replace insert tags.
 *
 * @author Falko Schumann <http://www.muspellheim.de>
 */
class BookInsertTags extends \Frontend
{

    /**
     * Hook for replacing book insert tags.
     *
     * @param string $strTag an insert tag.
     * @return bool|string false if insert tag is not replaced, otherwise the replacement.
     */
    public function replaceBookInsertTags($strTag)
    {
        $arrSplit = explode('::', $strTag);
        $insertTag = $arrSplit[0];

        if ($this->beginsWith($insertTag, 'bookchapter')) {
            $idOrAlias = $arrSplit[1];
            $objChapter = $this->getChapter($idOrAlias);
            if ($objChapter) {
                $title = $this->getChapterTitle($objChapter);
                $url = $this->getChapterUrl($objChapter);
                if ($insertTag == 'bookchapter_open') {
                    return '<a href="' . $url . '" class="bookchapter">';
                } else {
                    if ($insertTag == 'bookchapter_url') {
                        return $this->getChapterUrl($objChapter);
                    } else {
                        if ($insertTag == 'bookchapter_title') {
                            return $this->getChapterTitle($objChapter);
                        } else {
                            return '<a href="' . $url . '" class="bookchapter">' . $title . '</a>';
                        }
                    }
                }
            } else {
                if ($insertTag == 'bookchapter_close') {
                    return '</a>';
                } else {
                    return '{Unbekanntens Kapitel: ' . $idOrAlias . '}';
                }
            }
        }

        return false;
    }


    /**
     * @param string $str a string.
     * @param string $sub substring at beginning of string to search for.
     * @return bool
     */
    private function beginsWith($str, $sub)
    {
        return (substr($str, 0, strlen($sub)) == $sub);
    }


    /**
     * @param int|string $idOrAlias
     * @return bool|\Database\Result
     */
    private function getChapter($idOrAlias)
    {
        $objChapters = $this->Database->prepare('SELECT id, title, alias FROM tl_chapter WHERE (id=? || alias=?) AND published=1')->execute($idOrAlias,
            $idOrAlias);
        return $objChapters->next();
    }


    /**
     * @param $objChapter
     * @return string
     */
    private function getChapterTitle($objChapter)
    {
        $arrHeadline = deserialize($objChapter->title);
        return is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
    }


    /**
     * @param $objChapter
     * @return string
     */
    private function getChapterUrl($objChapter)
    {
        global $objPage;
        $page = array(
            'id'    => $objPage->id,
            'alias' => $objPage->alias
        );

        $itemPrefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/';
        $item = $this->isAliasSetAndEnabled($objChapter) ? $objChapter->alias : $objChapter->id;
        return $this->generateFrontendUrl($page, $itemPrefix . $item);
    }


    /**
     * @param $objChapter
     * @return bool
     */
    private function isAliasSetAndEnabled($objChapter)
    {
        return $objChapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
    }

}
