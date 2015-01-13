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


/**
 * Extension of data container array for table `tl_content`
 *
 * There are two extensions. Content elements used to define chapters content.
 * Introduce a new content element to insert a book.
 */
if (\Input::get('do') == 'books')
{
    $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_book_chapter';
}

/**
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['book'] = '{type_legend},type;{include_legend},book;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['book'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['book'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => array('tl_content_book', 'getBooks'),
    'eval'             => array('mandatory' => true, 'chosen' => true, 'submitOnChange' => true, 'tl_class' => 'long'),
    'sql'              => "int(10) unsigned NOT NULL default '0'"
);

/**
 * Class tl_content_book
 *
 * @copyright  2015 Falko Schumann
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Books
 */
class tl_content_book extends Backend
{

    /**
     * Get all books and return them as array
     *
     * @return array
     */
    public function getBooks()
    {
        $arrBooks = array();
        $objBooks = $this->Database->execute("SELECT id, title, author, category, language FROM tl_book ORDER BY title");

        while ($objBooks->next())
        {
            $item = $objBooks->title . ' (ID ' . $objBooks->id;
            if (strlen($objBooks->category) > 0)
            {
                $item .= ', ' . $objBooks->category;
            }
            if (strlen($objBooks->language) > 0)
            {
                $item .= ', ' . $objBooks->language;
            }
            $item .= ')';
            $arrBooks[$objBooks->author][$objBooks->id] = $item;
        }

        return $arrBooks;
    }

}
