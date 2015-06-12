<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */


/**
 * Table tl_book
 */
$GLOBALS['TL_DCA']['tl_book'] = array
(

    // Config
    'config'   => array
    (
        'label'            => Config::get('websiteTitle'),
        'dataContainer'    => 'Table',
        'ctable'           => array('tl_content'),
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id'    => 'primary',
                'pid'   => 'index',
                'alias' => 'index',
                'type'  => 'index'
            )
        )
    ),
    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => 5,
            'icon'        => 'pagemounts.gif',
            'panelLayout' => 'filter,search'
        ),
        'label'             => array
        (
            'fields' => array('title'),
            'format' => '%s'
        ),
        'global_operations' => array
        (
            'toggleNodes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['toggleAll'],
                'href'  => 'ptg=all',
                'class' => 'header_toggle'
            ),
            'all'         => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'       => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
//                'button_callback' => array('tl_book', 'editPage')
            ),
            'copy'       => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['copy'],
                'href'       => 'act=paste&amp;mode=copy',
                'icon'       => 'copy.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'copyPage')
            ),
            'copyChilds' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['copyChilds'],
                'href'       => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon'       => 'copychilds.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'copyPageWithSubpages')
            ),
            'cut'        => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['cut'],
                'href'       => 'act=paste&amp;mode=cut',
                'icon'       => 'cut.gif',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'cutPage')
            ),
            'delete'     => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//                'button_callback' => array('tl_book', 'deletePage')
            ),
            'toggle'     => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_book']['toggle'],
                'icon'       => 'visible.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
//                'button_callback' => array('tl_book', 'toggleIcon')
            ),
            'show'       => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_book']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            )
        )
    ),
    // Palettes
    // TODO Check if types regular and root are necessary or it can be book and chapter
    'palettes' => array
    (
        '__selector__' => array('type'),
//        'default'      => '{title_legend},title,alias,type',
        'regular'      => '{title_legend},title,alias;{meta_legend:hide},tags;{expert_legend:hide},cssClass,hide;{publish_legend},published',
        'root'         => '{title_legend},title,subtitle,alias;{meta_legend:hide},year,place,language,tags;{expert_legend:hide},cssClass;{publish_legend},published',
    ),
    // Fields
    'fields'   => array
    (
        'id'        => array
        (
            'label'  => array('ID'),
            'search' => true,
            'sql'    => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid'       => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting'   => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp'    => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['title'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array(
                'mandatory'      => true,
                'maxlength'      => 255,
                'decodeEntities' => true,
                'tl_class'       => 'w50'
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'alias'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['alias'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('rgxp' => 'folderalias', 'maxlength' => 128, 'tl_class' => 'w50'),
//            'save_callback' => array(
//                array('tl_book', 'generateAlias')
//            ),
            'sql'       => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'type'      => array
        (
            'label'   => &$GLOBALS['TL_LANG']['tl_book']['type'],
            'exclude' => true,
            'default' => 'regular',
            'sql'     => "varchar(32) NOT NULL default ''"
        ),
        'subtitle'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['subtitle'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'author'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['author'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'year'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['year'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('minlength' => 4, 'maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "varchar(4) NOT NULL default ''"
        ),
        'place'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['place'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'language'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['language'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array(
                'mandatory' => true,
                'rgxp'      => 'language',
                'maxlength' => 5,
                'nospace'   => true,
                'tl_class'  => 'w50 clr'
            ),
            'sql'       => "varchar(5) NOT NULL default ''"
        ),
        'tags'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['tags'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'cssClass'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['cssClass'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('maxlength' => 64, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'hide'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['hide'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_book']['published'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('submitOnChange' => true, 'doNotCopy' => true),
            'sql'       => "char(1) NOT NULL default ''"
        )
    )
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Falko Schumann <https://github.com/falkoschumann>
 */
class tl_page extends Backend
{
}
