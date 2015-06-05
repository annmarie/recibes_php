
DROP DATABASE recibes;

CREATE DATABASE recibes;

USE recibes;

CREATE TABLE recipe (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rcp_headline VARCHAR(255) NOT NULL,
  rcp_body MEDIUMTEXT,
  rcp_notes MEDIUMTEXT,
  rcp_img_id INT(10),
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE INDEX rcp_headline_ix ON recipe (rcp_headline);

CREATE TRIGGER recipe_create BEFORE INSERT ON `recipe`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE ingredient (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ingr_item VARCHAR(255) UNIQUE NOT NULL,
  ingr_img_id INT(10),
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE INDEX ingr_item_ix ON ingredient (ingr_item);

CREATE TRIGGER ingredient_create BEFORE INSERT ON `ingredient`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE recipe_ingredient (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rcp_id INT(10) NOT NULL,
  ingr_id INT(10) NOT NULL,
  ingr_amount VARCHAR(100),
  ingr_notes MEDIUMTEXT,
  ingr_order INT(10) DEFAULT 0,
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE TRIGGER recipe_ingredient_create BEFORE INSERT ON `recipe_ingredient`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE tag (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tag_item VARCHAR(255) UNIQUE NOT NULL,
  tag_img_id INT(10),
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE INDEX tag_item_ix ON tag (tag_item);

CREATE TRIGGER tag_create BEFORE INSERT ON `tag`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE recipe_tag (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rcp_id INT(10) NOT NULL,
  tag_id INT(10) NOT NULL,
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE TRIGGER recipe_tag_create BEFORE INSERT ON `recipe_tag`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE image (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  img_filepath VARCHAR(255) NOT NULL,
  created TIMESTAMP DEFAULT NOW(),
  updated TIMESTAMP
) ENGINE=MyISAM;

CREATE TRIGGER image_create BEFORE INSERT ON `image`
FOR EACH ROW SET NEW.updated = NOW();

CREATE TABLE word (
   id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   word_item VARCHAR(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM;

CREATE INDEX word_item_ix ON word (word_item);

CREATE TABLE occurrence (
   id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   word_id INT(10) UNSIGNED NOT NULL default '0',
   rcp_id INT(10) UNSIGNED NOT NULL default '0'
) ENGINE=MyISAM;

