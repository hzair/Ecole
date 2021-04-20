-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 20 mars 2021 à 16:41
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de données : `ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
                         `id` int(11) NOT NULL,
                         `id_inscription` int(11) NOT NULL,
                         `nom` text NOT NULL,
                         `prenom` text NOT NULL,
                         `sexe` enum('M','F') NOT NULL,
                         `date_naissance` date NOT NULL,
                         `lieu_naissance` text NOT NULL,
                         `cours_annee_prec` tinyint(1) NOT NULL,
                         `cours_annee_prec_ici` tinyint(1) NOT NULL,
                         `num_annee_prec_ici` text DEFAULT NULL,
                         `decharge` tinyint(1) NOT NULL,
                         `autorisation_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
                               `id` int(11) NOT NULL,
                               `id_fonc` varchar(50) NOT NULL,
                               `email` text DEFAULT NULL,
                               `date` date NOT NULL,
                               `id_pere` int(11) DEFAULT NULL,
                               `id_mere` int(11) DEFAULT NULL,
                               `parents_separe` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

CREATE TABLE `parent` (
                          `id` int(11) NOT NULL,
                          `id_inscription` int(11) NOT NULL,
                          `email` text NOT NULL,
                          `nom` text NOT NULL,
                          `prenom` text NOT NULL,
                          `sexe` enum('M','F') NOT NULL,
                          `profession` text DEFAULT NULL,
                          `telephone_portable` text NOT NULL,
                          `telephone_fixe` text DEFAULT NULL,
                          `adresse` text NOT NULL,
                          `code_postale` text NOT NULL,
                          `ville` text NOT NULL,
                          `cours_arabe_adulte` tinyint(1) DEFAULT NULL,
                          `cours_sciences_islamiques` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Auto increment
--
ALTER TABLE `eleve` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `inscription` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `parent` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parent`
--
ALTER TABLE `parent`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `parent`
--
ALTER TABLE `parent`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

