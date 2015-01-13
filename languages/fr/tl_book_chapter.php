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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['title']     = array('Titre', 'Saisir le titre du chapitre');
$GLOBALS['TL_LANG']['tl_book_chapter']['alias']     = array('Alias du chapitre', 'L\'alias du chapitre est une référence unique pour le chapitre qui peut être utilisé à la place de son ID numérique.');
$GLOBALS['TL_LANG']['tl_book_chapter']['note']      = array('Note', '');
$GLOBALS['TL_LANG']['tl_book_chapter']['text']      = array('Texte', 'Vous pouvez utiliser des balises HTML pour formater le texte.');
$GLOBALS['TL_LANG']['tl_book_chapter']['published'] = array('Publier le chapitre', 'Rendre le chapitre visible sur ​​le site.');
$GLOBALS['TL_LANG']['tl_book_chapter']['show_in_toc'] = array('Voir le chapitre dans la table des matières', 'Si cette case n\'est pas cochée, le chapitre ne sera pas visible dans la table des matières.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['chapter_legend'] = 'Chapitre';
$GLOBALS['TL_LANG']['tl_book_chapter']['meta_legend']    = 'Méta information';
$GLOBALS['TL_LANG']['tl_book_chapter']['text_legend']    = 'Texte';
$GLOBALS['TL_LANG']['tl_book_chapter']['publish_legend'] = 'Paramètres de publication';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book_chapter']['new']        = array('Nouveau chapitre', 'Créer un nouveau chapitre');
$GLOBALS['TL_LANG']['tl_book_chapter']['edit']       = array('Éditer le chapitre', 'Éditer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['editheader'] = array('Éditer les paramètres du chapitre', 'Éditer les paramètres du chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['copy']       = array('Dupliquer le chapitre', 'Dupliquer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['delete']     = array('Supprimer le chapitre', 'Supprimer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['toggle']     = array('Publier/Dépublier le chapitre', 'Publier/Dépublier le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['show']       = array('Détails du chapitre', 'Afficher les détails du chapitre ID %s');
$GLOBALS['TL_LANG']['tl_book_chapter']['pastenew']   = array('Ajouter un nouveau chapitre au sommet', 'Ajouter un nouveau chapitre après le chapitre ID %s');
