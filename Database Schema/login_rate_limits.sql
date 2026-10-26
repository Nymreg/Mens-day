CREATE TABLE IF NOT EXISTS `login_rate_limits` (
  `scope` ENUM('account', 'ip') NOT NULL,
  `subject_hash` CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `failed_attempts` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `window_started_at` DATETIME NOT NULL,
  `locked_until` DATETIME DEFAULT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`scope`, `subject_hash`),
  KEY `locked_until` (`locked_until`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;