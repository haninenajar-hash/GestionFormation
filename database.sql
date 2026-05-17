-- ============================================================
--  LearnNOW — Base de données complète
--  Compatible MySQL 5.7+ / PHP 7+
-- ============================================================

CREATE DATABASE IF NOT EXISTS gestion_formations
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE gestion_formations;

DROP TABLE IF EXISTS inscriptions;
DROP TABLE IF EXISTS formations;

-- TABLE formations enrichie
CREATE TABLE formations (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre         VARCHAR(150)  NOT NULL,
    description   TEXT          NOT NULL,
    objectifs     TEXT          NULL,
    prerequis     TEXT          NULL,
    technologies  VARCHAR(255)  NULL,
    programme     TEXT          NULL,
    instructeur   VARCHAR(120)  NULL,
    bio_instr     TEXT          NULL,
    prix          DECIMAL(8,2)  NOT NULL,
    duree         VARCHAR(60)   NOT NULL,
    niveau        ENUM('Débutant','Intermédiaire','Avancé') NOT NULL DEFAULT 'Débutant',
    categorie     VARCHAR(80)   NULL,
    image         VARCHAR(255)  NOT NULL DEFAULT 'default.jpg',
    certificat    TINYINT(1)    NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE inscriptions
CREATE TABLE inscriptions (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom              VARCHAR(100) NOT NULL,
    prenom           VARCHAR(100) NOT NULL,
    email            VARCHAR(180) NOT NULL,
    age              TINYINT UNSIGNED NULL,
    formation_id     INT UNSIGNED NOT NULL,
    statut_paiement  ENUM('en_attente','paye') NOT NULL DEFAULT 'en_attente',
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Données enrichies
INSERT INTO formations (titre, description, objectifs, prerequis, technologies, programme, instructeur, bio_instr, prix, duree, niveau, categorie, image, certificat) VALUES
(
    'Développement Web Full Stack',
    'Une formation complète pour maîtriser le développement web de A à Z. Vous apprendrez à concevoir des interfaces modernes, développer des APIs robustes et déployer vos applications sur le cloud.',
    'Créer des applications web complètes|Maîtriser HTML CSS JavaScript et PHP|Concevoir et interroger des bases de données|Déployer une application sur un serveur',
    'Connaissance basique de l informatique|Curiosité et motivation',
    'HTML5,CSS3,JavaScript,PHP,MySQL,Git',
    'Module 1 : Les bases du web HTML et CSS|Module 2 : JavaScript moderne|Module 3 : PHP et bases de données|Module 4 : Frameworks et outils|Module 5 : Projet final fullstack',
    'Asma Ayari',
    'Enseignante à ISET COM, spécialisée en développement web et architecture logicielle. Plus de 8 ans d expérience dans l enseignement et le développement.',
    490.00, '10 semaines', 'Débutant', 'Développement', 'web.jpg', 1
),
(
    'Data Science et Analyse',
    'Apprenez à collecter, nettoyer, analyser et visualiser des données massives avec Python. Cette formation vous donnera les clés pour devenir un professionnel de la donnée.',
    'Analyser des jeux de données réels|Créer des visualisations professionnelles|Appliquer des modèles statistiques|Construire un pipeline de données complet',
    'Notions de mathématiques|Python de base recommandé',
    'Python,Pandas,NumPy,Matplotlib,SQL,Jupyter',
    'Module 1 : Python pour la data|Module 2 : Nettoyage des données|Module 3 : Visualisation avancée|Module 4 : Statistiques appliquées|Module 5 : Projet d analyse réel',
    'Mohamed Ben Salem',
    'Data scientist senior avec 6 ans d expérience en entreprise. Ancien consultant dans le secteur fintech.',
    640.00, '12 semaines', 'Intermédiaire', 'Data et IA', 'data.jpg', 1
),
(
    'Intelligence Artificielle Appliquée',
    'Découvrez le machine learning, les réseaux de neurones et les applications concrètes de l IA. Un programme intensif basé sur des projets pratiques du monde réel.',
    'Comprendre les algorithmes de machine learning|Entraîner et évaluer des modèles|Implémenter des réseaux de neurones|Déployer un modèle en production',
    'Python intermédiaire|Algèbre linéaire et probabilités',
    'Python,TensorFlow,Scikit-learn,Keras,NumPy',
    'Module 1 : Fondements du machine learning|Module 2 : Algorithmes supervisés et non supervisés|Module 3 : Deep learning|Module 4 : NLP et vision par ordinateur|Module 5 : Déploiement et production',
    'Rania Gharbi',
    'Docteure en informatique, chercheuse en IA. Auteure de plusieurs publications sur le deep learning.',
    820.00, '14 semaines', 'Avancé', 'Data et IA', 'ia.jpg', 1
),
(
    'Cybersécurité et Ethical Hacking',
    'Comprenez les menaces informatiques modernes et apprenez à protéger les systèmes. Cette formation couvre l ethical hacking, la cryptographie et la gestion des incidents.',
    'Identifier et exploiter les vulnérabilités de manière éthique|Configurer et sécuriser des réseaux|Réaliser des audits de sécurité|Gérer un incident de sécurité',
    'Bases en réseaux informatiques|Connaissance de Linux',
    'Kali Linux,Wireshark,Metasploit,Nmap,Python',
    'Module 1 : Fondements de la cybersécurité|Module 2 : Réseaux et protocoles|Module 3 : Ethical hacking|Module 4 : Cryptographie et PKI|Module 5 : Forensique et gestion des incidents',
    'Karim Jlassi',
    'Expert en cybersécurité certifié CEH et CISSP. Consultant pour plusieurs institutions en Tunisie.',
    720.00, '12 semaines', 'Intermédiaire', 'Sécurité', 'cyber.jpg', 1
);
