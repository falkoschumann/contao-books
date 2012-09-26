INSERT INTO `tl_book` (`id`, `tstamp`, `title`, `subtitle`, `alias`, `author`, `language`, `published`, `text`)
SELECT
  `id`,
  UNIX_TIMESTAMP(`modified`),
  `title`,
  `subtitle`,
  `shortname`,
  `author`,
  `language`,
  `published`,
  `text`
FROM `santmat_books`
WHERE `parent_id` = 0;

INSERT INTO `tl_book_chapter`
SELECT
  `id`,
  `parent_id` AS `pid`,
  `ordering` AS `sorting`,
  `parent_id` AS `bookid`,
  UNIX_TIMESTAMP(`modified`) AS `tstamp`,
  `shortname` AS `alias`,
  `title`,
  `published`,
  '',
  `text`
FROM `santmat_books`
WHERE `parent_id` <> 0;
