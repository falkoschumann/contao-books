<?php

/**
 * Books Extension for Contao
 * Copyright (c) 2015 Falko Schumann
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @package Books
 * @license MIT
 */


namespace Muspellheim\Books;


/**
 * Base class for frontend classes.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class Books extends \Frontend
{

	/**
	 * @param ChapterModel $chapter
	 * @return string
	 */
	public static function getChapterUrl($chapter)
	{
		$prefix = $GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/';
		$item   = static::isAliasSetAndEnabled($chapter) ? $chapter->alias : $chapter->id;
		return static::generateFrontendUrl($GLOBALS['objPage']->row(), $prefix . $item);
	}


	/**
	 * @param ChapterModel $chapter
	 * @return bool
	 */
	private static function isAliasSetAndEnabled($chapter)
	{
		return $chapter->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias'];
	}

}
