<?php

/**
 * Books Extension for Contao
 * Copyright (c) 2014, Falko Schumann <http://www.muspellheim.de>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials  provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright  Falko Schumann 2014
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 * @license    BSD-2-clause
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
