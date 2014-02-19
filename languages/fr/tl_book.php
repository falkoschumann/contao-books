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
$GLOBALS['TL_LANG']['tl_book']['title']     = array('Titre', 'Saisir le titre du livre.');
$GLOBALS['TL_LANG']['tl_book']['subtitle']  = array('Sous-titre', 'Saisir un sous-titre pour le livre (facultatif).');
$GLOBALS['TL_LANG']['tl_book']['alias']     = array('Alias du livre', 'L\'alias du livre est une référence unique pour le livre qui peut être utilisé à la place de son ID numérique.');
$GLOBALS['TL_LANG']['tl_book']['author']    = array('Auteur', 'Saisir l\'auteur du livre.');
$GLOBALS['TL_LANG']['tl_book']['language']  = array('Langage', 'Saisir la langue de la page conformément à la norme ISO-639-1 (par exemple "fr" pour le français)');
$GLOBALS['TL_LANG']['tl_book']['category']  = array('Catégorie', 'Catégorie(s) du livre, par exemple "Livre", "Aventure" ou "Polar"');
$GLOBALS['TL_LANG']['tl_book']['note']      = array('Note', '');
$GLOBALS['TL_LANG']['tl_book']['text']      = array('Préface', 'Vous pouvez utiliser des balises HTML pour formater le texte.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Publier le livre', 'Rendre le livre visible sur ​​le site.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend']    = 'Livre';
$GLOBALS['TL_LANG']['tl_book']['meta_legend']    = 'Méta information';
$GLOBALS['TL_LANG']['tl_book']['text_legend']    = 'Préface';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Paramètres de publication';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new']         = array('Nouveau livre', 'Crée un nouveau livre');
$GLOBALS['TL_LANG']['tl_book']['edit']        = array('Éditer le livre', 'Éditer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['editheader']  = array('Éditer les paramètres du livre', 'Éditer les paramètres du livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['copy']        = array('Dupliquer le livre', 'Dupliquer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['delete']      = array('Supprimer le livre', 'Supprimer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['toggle']      = array('Publier/Dépublier le livre', 'Publier/Dépublier le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['show']        = array('Détails du livre', 'Afficher les détails du livre ID %s');
