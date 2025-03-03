CREATE TABLE `clientes` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `cif` VARCHAR(50) NOT NULL UNIQUE,
  `name` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `cuenta_corriente` VARCHAR(34) NOT NULL,
  `pais_id` SMALLINT(3) UNSIGNED NOT NULL, -- ⬅️ DEBE SER IGUAL AL `id` DE `paises`
  `moneda` VARCHAR(10) NOT NULL,
  `importe_cuota_mensual` DECIMAL(10,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (`pais_id`) REFERENCES `paises`(`id`) ON DELETE CASCADE ON UPDATE CASCADE -- ⬅️ AHORA FUNCIONARÁ
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
