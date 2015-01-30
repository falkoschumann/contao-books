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


namespace Muspellheim\Books;


/**
 * Base class with common functionality for frontend classes.
 *
 * @copyright  Falko Schumann 2012-2015
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Books
 */
class BaseBooks extends \Frontend
{

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
		return static::generateFrontendUrl($GLOBALS['objPage']->row(), $prefix . $item);
	}

}
