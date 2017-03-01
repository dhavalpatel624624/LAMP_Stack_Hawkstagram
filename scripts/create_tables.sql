

--
-- Database : `hawkstagram`
--
CREATE DATABASE IF NOT EXISTS `hawkstagram`
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE phpmyadmin;

-- --------------------------------------------------------


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '',
  `caption` varchar(255) NOT NULL default '',
  `image_path` varchar(255) COLLATE utf8_general_ci NOT NULL default '',
  `image_size` int(11) NOT NULL default '',
  `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`photo_id`)
)
  COMMENT='photos'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) unsigned NOT NULL auto_increment,
  `comment` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`comment_id`),
)
  COMMENT='comments'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `photo_comments` (
  `photo_id` int(11) unsigned NOT NULL auto_increment,
  `comment_id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`comment_id`),
)
  COMMENT='photo_comments'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `Likes` (
  `user_id` int(11) NOT NULL default '',
  `photo_id` int(11) unsigned NOT NULL auto_increment,
 `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`user_id`),
)
  COMMENT=''
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY (`id`)
)
  COMMENT='tags'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `photo_tags` (
   `photo_id` int(11) unsigned NOT NULL,
   `tag_id` text NOT NULL,
  PRIMARY KEY (`photo_id`)
)
  COMMENT='Photo tags'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salted_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL default CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`user_id`)
)
  COMMENT='Users'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

-- --------------------------------------------------------

