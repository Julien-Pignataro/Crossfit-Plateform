-- ============================================================
-- schema.sql — Base de données du site CrossFit (MySQL / MariaDB)
-- ============================================================

-- (Optionnel) Créer la base
-- CREATE DATABASE IF NOT EXISTS crossfit
--   DEFAULT CHARACTER SET utf8mb4
--   DEFAULT COLLATE utf8mb4_unicode_ci;
-- USE crossfit;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =========================
-- TABLE: users
-- =========================
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL DEFAULT 'user',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================
-- TABLE: boxes
-- =========================
DROP TABLE IF EXISTS boxes;
CREATE TABLE boxes (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  city VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================
-- TABLE: competitions
-- =========================
DROP TABLE IF EXISTS competitions;
CREATE TABLE competitions (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT DEFAULT NULL,
  event_date DATE DEFAULT NULL,
  city VARCHAR(255) DEFAULT NULL,

  -- WOD par catégorie
  wod_rx TEXT DEFAULT NULL,
  wod_intermediate TEXT DEFAULT NULL,
  wod_scaled TEXT DEFAULT NULL,

  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  KEY idx_competitions_event_date (event_date),
  KEY idx_competitions_city (city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================
-- TABLE: inscriptions
-- =========================
DROP TABLE IF EXISTS inscriptions;
CREATE TABLE inscriptions (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  competition_id INT UNSIGNED NOT NULL,

  firstname VARCHAR(100) NOT NULL,
  lastname VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,

  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),

  -- Empêche un même user de s'inscrire 2 fois à la même compétition
  UNIQUE KEY uniq_inscriptions_user_competition (user_id, competition_id),

  KEY idx_inscriptions_user (user_id),
  KEY idx_inscriptions_competition (competition_id),

  CONSTRAINT fk_inscriptions_user
    FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE CASCADE ON UPDATE CASCADE,

  CONSTRAINT fk_inscriptions_competition
    FOREIGN KEY (competition_id) REFERENCES competitions (id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;