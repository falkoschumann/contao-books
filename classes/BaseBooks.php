<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * Base class for frontend classes.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BaseBooks extends \Frontend
{

	/**
	 * Get the URL for a given chapter.
	 *
	 * @param ChapterModel $chapter a chapter.
	 * @return string the chapters URL as string.
	 */
	public static function getChapterUrl($chapter)
	{
		$prefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/';
		$item = static::isAliasSetAndEnabled($chapter) ? $chapter->alias : $chapter->id;
		return static::generateFrontendUrl($GLOBALS['objPage']->row(), $prefix . $item);
	}


	/**
	 * Check if URL alias for a given chapter is set and item aliases are enabled.
	 *
	 * @param ChapterModel $chapter a chapter.
	 * @return bool true when alias can be used, false otherwise.
	 */
	private static function isAliasSetAndEnabled($chapter)
	{
		return $chapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
	}

}
