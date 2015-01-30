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


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_book']['title'] = array('Titre', 'Saisir le titre du livre.');
$GLOBALS['TL_LANG']['tl_book']['subtitle'] = array('Sous-titre', 'Saisir un sous-titre pour le livre (facultatif).');
$GLOBALS['TL_LANG']['tl_book']['alias'] = array('Alias du livre', 'L\'alias du livre est une référence unique pour le livre qui peut être utilisé à la place de son ID numérique.');
$GLOBALS['TL_LANG']['tl_book']['author'] = array('Auteur', 'Saisir l\'auteur du livre.');
$GLOBALS['TL_LANG']['tl_book']['language'] = array('Langage', 'Saisir la langue de la page conformément à la norme ISO-639-1 (par exemple "fr" pour le français)');
$GLOBALS['TL_LANG']['tl_book']['category'] = array('Catégorie', 'Catégorie(s) du livre, par exemple "Livre", "Aventure" ou "Polar"');
$GLOBALS['TL_LANG']['tl_book']['abstract'] = array('Résumé', 'Vous pouvez utiliser des balises HTML pour formater le texte.');
$GLOBALS['TL_LANG']['tl_book']['published'] = array('Publier le livre', 'Rendre le livre visible sur ​​le site.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_book']['book_legend'] = 'Livre';
$GLOBALS['TL_LANG']['tl_book']['meta_legend'] = 'Méta information';
$GLOBALS['TL_LANG']['tl_book']['abstract_legend'] = 'Résumé';
$GLOBALS['TL_LANG']['tl_book']['publish_legend'] = 'Paramètres de publication';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_book']['new'] = array('Nouveau livre', 'Crée un nouveau livre');
$GLOBALS['TL_LANG']['tl_book']['edit'] = array('Éditer le livre', 'Éditer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['editheader'] = array('Éditer les paramètres du livre', 'Éditer les paramètres du livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['copy'] = array('Dupliquer le livre', 'Dupliquer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['delete'] = array('Supprimer le livre', 'Supprimer le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['toggle'] = array('Publier/Dépublier le livre', 'Publier/Dépublier le livre ID %s');
$GLOBALS['TL_LANG']['tl_book']['show'] = array('Détails du livre', 'Afficher les détails du livre ID %s');
