-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Serveur: db200.1and1.fr
-- Généré le : Jeudi 21 Mai 2009 à 11:12
-- Version du serveur: 4.0.27
-- Version de PHP: 4.3.10-200.schlund.1
-- 
-- Base de données: `db179817164`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `emails`
-- 

CREATE TABLE `emails` (
  `email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`email`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `emails_logs`
-- 

CREATE TABLE `emails_logs` (
  `id` int(255) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL default '',
  `time` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `events`
-- 

CREATE TABLE `events` (
  `id` int(255) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `date_debut` date default NULL,
  `date_fin` date default NULL,
  `horaires` varchar(255) default NULL,
  `adresse` varchar(255) default NULL,
  `description` text,
  `flyer` varchar(255) default NULL,
  `language` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `files`
-- 

CREATE TABLE `files` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `jlx_user`
-- 

CREATE TABLE `jlx_user` (
  `usr_login` varchar(50) NOT NULL default '',
  `usr_email` varchar(255) default NULL,
  `usr_password` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`usr_login`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `newsletters`
-- 

CREATE TABLE `newsletters` (
  `id` int(255) NOT NULL auto_increment,
  `date_create` date NOT NULL default '0000-00-00',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Structure de la table `pages`
-- 

CREATE TABLE `pages` (
  `id` int(255) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `language` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
