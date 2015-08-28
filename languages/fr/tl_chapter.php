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
$GLOBALS['TL_LANG']['tl_chapter']['title']     = array('Titre', 'Saisir le titre du chapitre');
$GLOBALS['TL_LANG']['tl_chapter']['alias']     = array('Alias du chapitre', 'L\'alias du chapitre est une référence unique pour le chapitre qui peut être utilisé à la place de son ID numérique.');
$GLOBALS['TL_LANG']['tl_chapter']['note']      = array('Note', '');
$GLOBALS['TL_LANG']['tl_chapter']['text']      = array('Texte', 'Vous pouvez utiliser des balises HTML pour formater le texte.');
$GLOBALS['TL_LANG']['tl_chapter']['published'] = array('Publier le chapitre', 'Rendre le chapitre visible sur ​​le site.');
$GLOBALS['TL_LANG']['tl_chapter']['hide']      = array('Voir le chapitre dans la table des matières', 'Si cette case n\'est pas cochée, le chapitre ne sera pas visible dans la table des matières.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_chapter']['chapter_legend'] = 'Chapitre';
$GLOBALS['TL_LANG']['tl_chapter']['meta_legend']    = 'Méta information';
$GLOBALS['TL_LANG']['tl_chapter']['text_legend']    = 'Texte';
$GLOBALS['TL_LANG']['tl_chapter']['publish_legend'] = 'Paramètres de publication';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_chapter']['new']        = array('Nouveau chapitre', 'Créer un nouveau chapitre');
$GLOBALS['TL_LANG']['tl_chapter']['edit']       = array('Éditer le chapitre', 'Éditer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['editheader'] = array('Éditer les paramètres du chapitre', 'Éditer les paramètres du chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['copy']       = array('Dupliquer le chapitre', 'Dupliquer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['delete']     = array('Supprimer le chapitre', 'Supprimer le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['toggle']     = array('Publier/Dépublier le chapitre', 'Publier/Dépublier le chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['show']       = array('Détails du chapitre', 'Afficher les détails du chapitre ID %s');
$GLOBALS['TL_LANG']['tl_chapter']['pastenew']   = array('Ajouter un nouveau chapitre au sommet', 'Ajouter un nouveau chapitre après le chapitre ID %s');
