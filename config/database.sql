-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_book`
-- 

CREATE TABLE `tl_book` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `alias` varbinary(128) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `author` varchar(255) NOT NULL default '',
  `category` varchar(255) NOT NULL default '',
  `language` varchar(2) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  `note` text NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_chapter`
-- 

CREATE TABLE `tl_book_chapter` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `depth` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `alias` varbinary(128) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  `note` varchar(255) NOT NULL default '',
  `text` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `book` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
