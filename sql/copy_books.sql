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

-- Kapitelebene 1
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  santmat.`parent_id`,
  1,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book` AS book
WHERE santmat.`parent_id` = book.`id`;

-- Kapitelebene 2
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  chapter.`pid`,
  2,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book_chapter` AS chapter
WHERE santmat.`parent_id` = chapter.`id`;

-- Kapitelebene 3
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  chapter.`pid`,
  3,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book_chapter` AS chapter
WHERE santmat.`parent_id` = chapter.`id` AND santmat.`id` NOT IN (SELECT `id` FROM `tl_book_chapter`);

-- Kapitelebene 4
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  chapter.`pid`,
  4,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book_chapter` AS chapter
WHERE santmat.`parent_id` = chapter.`id` AND santmat.`id` NOT IN (SELECT `id` FROM `tl_book_chapter`);

-- Kapitelebene 5
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  chapter.`pid`,
  5,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book_chapter` AS chapter
WHERE santmat.`parent_id` = chapter.`id` AND santmat.`id` NOT IN (SELECT `id` FROM `tl_book_chapter`);

-- Kapitelebene 6
INSERT INTO `tl_book_chapter` (`id`, `pid`,  `depth`, `sorting`, `tstamp`, `title`, `alias`, `published`, `text`)
SELECT
  santmat.`id`,
  chapter.`pid`,
  6,
  santmat.`ordering`,
  UNIX_TIMESTAMP(santmat.`modified`),
  santmat.`title`,
  santmat.`shortname`,
  santmat.`published`,
  santmat.`text`
FROM `santmat_books` AS santmat, `tl_book_chapter` AS chapter
WHERE santmat.`parent_id` = chapter.`id` AND santmat.`id` NOT IN (SELECT `id` FROM `tl_book_chapter`);
