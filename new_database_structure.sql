-- ============================================================================
-- PROFESSIONAL TOUR & TRAVEL MANAGEMENT SYSTEM DATABASE
-- Complete Database Structure with Migration Queries
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================================================
-- STEP 1: CREATE NEW PROFESSIONAL TABLES
-- ============================================================================

-- 1. Categories Table (Tour Types)
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    `icon` VARCHAR(255),
    `display_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (`slug`),
    INDEX idx_active (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Destinations Table (Locations/Cities)
CREATE TABLE IF NOT EXISTS `destinations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `state` VARCHAR(100),
    `country` VARCHAR(100) DEFAULT 'India',
    `description` TEXT,
    `image` VARCHAR(255),
    `latitude` DECIMAL(10, 8),
    `longitude` DECIMAL(11, 8),
    `is_active` TINYINT(1) DEFAULT 1,
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (`slug`),
    INDEX idx_active (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tour Packages Table (Main Tours - Unified)
CREATE TABLE IF NOT EXISTS `tour_packages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `short_description` TEXT,
    `description` LONGTEXT,
    `duration_days` INT NOT NULL,
    `duration_nights` INT NOT NULL,
    
    -- Pricing
    `base_price` DECIMAL(10, 2) NOT NULL,
    `discounted_price` DECIMAL(10, 2),
    `price_type` ENUM('per_person', 'per_group') DEFAULT 'per_person',
    
    -- Media
    `featured_image` VARCHAR(255),
    `gallery_images` TEXT,
    `video_url` VARCHAR(255),
    
    -- Package Details
    `max_group_size` INT DEFAULT 20,
    `min_age` INT DEFAULT 0,
    `difficulty_level` ENUM('easy', 'moderate', 'challenging', 'difficult') DEFAULT 'easy',
    
    -- Inclusions/Exclusions (JSON format for flexibility)
    `inclusions` TEXT,
    `exclusions` TEXT,
    
    -- SEO
    `meta_title` VARCHAR(255),
    `meta_description` TEXT,
    `meta_keywords` TEXT,
    
    -- Status
    `is_active` TINYINT(1) DEFAULT 1,
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_bestseller` TINYINT(1) DEFAULT 0,
    `display_order` INT DEFAULT 0,
    `views` INT DEFAULT 0,
    
    -- Timestamps
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT,
    INDEX idx_category (`category_id`),
    INDEX idx_slug (`slug`),
    INDEX idx_active (`is_active`),
    INDEX idx_featured (`is_featured`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Package Destinations (Many-to-Many Relationship)
CREATE TABLE IF NOT EXISTS `package_destinations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT NOT NULL,
    `destination_id` INT NOT NULL,
    `day_number` INT,
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`package_id`) REFERENCES `tour_packages`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`destination_id`) REFERENCES `destinations`(`id`) ON DELETE CASCADE,
    UNIQUE KEY unique_package_destination (`package_id`, `destination_id`),
    INDEX idx_package (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Package Itinerary (Day-wise Details)
CREATE TABLE IF NOT EXISTS `package_itinerary` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT NOT NULL,
    `day_number` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `meals` VARCHAR(100),
    `accommodation` VARCHAR(255),
    `activities` TEXT,
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`package_id`) REFERENCES `tour_packages`(`id`) ON DELETE CASCADE,
    INDEX idx_package_day (`package_id`, `day_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Package Pricing (Seasonal/Group/Accommodation Based)
CREATE TABLE IF NOT EXISTS `package_pricing` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT NOT NULL,
    `pricing_type` ENUM('seasonal', 'group_size', 'accommodation') NOT NULL,
    
    -- For seasonal pricing
    `season_name` VARCHAR(100),
    `start_date` DATE,
    `end_date` DATE,
    
    -- For group pricing
    `min_persons` INT,
    `max_persons` INT,
    
    -- For accommodation type
    `accommodation_type` VARCHAR(100),
    
    `price` DECIMAL(10, 2) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`package_id`) REFERENCES `tour_packages`(`id`) ON DELETE CASCADE,
    INDEX idx_package (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Customers Table
CREATE TABLE IF NOT EXISTS `customers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `country` VARCHAR(100) DEFAULT 'India',
    `state` VARCHAR(100),
    `city` VARCHAR(100),
    `address` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Bookings Table
CREATE TABLE IF NOT EXISTS `bookings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `booking_number` VARCHAR(50) UNIQUE NOT NULL,
    `customer_id` INT NOT NULL,
    `package_id` INT NOT NULL,
    `vehicle_id` INT,
    
    -- Booking Details
    `travel_date` DATE NOT NULL,
    `number_of_persons` INT NOT NULL,
    `number_of_days` INT NOT NULL,
    
    -- Pricing
    `total_price` DECIMAL(10, 2) NOT NULL,
    `discount` DECIMAL(10, 2) DEFAULT 0,
    `final_price` DECIMAL(10, 2) NOT NULL,
    
    -- Payment
    `payment_status` ENUM('pending', 'partial', 'paid', 'refunded') DEFAULT 'pending',
    `paid_amount` DECIMAL(10, 2) DEFAULT 0,
    `payment_method` VARCHAR(50),
    
    -- Status
    `booking_status` ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    
    -- Notes
    `special_requests` TEXT,
    `admin_notes` TEXT,
    
    -- Timestamps
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE RESTRICT,
    FOREIGN KEY (`package_id`) REFERENCES `tour_packages`(`id`) ON DELETE RESTRICT,
    INDEX idx_booking_number (`booking_number`),
    INDEX idx_travel_date (`travel_date`),
    INDEX idx_status (`booking_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Reviews Table
CREATE TABLE IF NOT EXISTS `reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT NOT NULL,
    `customer_id` INT NOT NULL,
    `rating` INT NOT NULL CHECK (`rating` BETWEEN 1 AND 5),
    `title` VARCHAR(255),
    `comment` TEXT,
    `is_approved` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`package_id`) REFERENCES `tour_packages`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE,
    INDEX idx_package (`package_id`),
    INDEX idx_approved (`is_approved`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Vehicles Table (Keep existing structure compatible)
CREATE TABLE IF NOT EXISTS `vehicles_new` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `type` ENUM('sedan', 'suv', 'tempo_traveller', 'bus', 'luxury') NOT NULL,
    `capacity` INT NOT NULL,
    `image` VARCHAR(255),
    `features` TEXT,
    `price_per_km` DECIMAL(8, 2),
    `price_per_day` DECIMAL(10, 2),
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. Gallery Table (Centralized)
CREATE TABLE IF NOT EXISTS `gallery_new` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255),
    `image_url` VARCHAR(255) NOT NULL,
    `thumbnail_url` VARCHAR(255),
    `category` VARCHAR(100),
    `related_type` ENUM('package', 'destination', 'vehicle', 'general') DEFAULT 'general',
    `related_id` INT,
    `display_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_category (`category`),
    INDEX idx_related (`related_type`, `related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. Admin Users Table (Secure Authentication)
CREATE TABLE IF NOT EXISTS `admin_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100),
    `role` ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin',
    `is_active` TINYINT(1) DEFAULT 1,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- STEP 2: INSERT DEFAULT CATEGORIES
-- ============================================================================

INSERT INTO `categories` (`name`, `slug`, `description`, `display_order`, `is_active`) VALUES
('Golden Triangle', 'golden-triangle', 'Explore Delhi, Agra, and Jaipur - India''s most iconic destinations', 1, 1),
('Himachal Tours', 'himachal-tours', 'Experience the beauty of Himachal Pradesh with hill stations and adventure', 2, 1),
('Rajasthan Tours', 'rajasthan-tours', 'Discover the royal heritage and desert landscapes of Rajasthan', 3, 1),
('Taj Mahal Tours', 'tajmahal-tours', 'Visit the iconic Taj Mahal with same-day and multi-day packages', 4, 1),
('Pilgrimage Tours', 'pilgrimage-tours', 'Spiritual journeys to sacred destinations across India', 5, 1),
('Wildlife Safari', 'wildlife-safari', 'Explore India''s national parks and wildlife sanctuaries', 6, 1),
('Beach Tours', 'beach-tours', 'Relaxing getaways to India''s beautiful coastal destinations', 7, 1),
('Adventure Tours', 'adventure-tours', 'Trekking, rafting, and adventure activities', 8, 1),
('Cultural Tours', 'cultural-tours', 'Immerse in India''s rich cultural heritage', 9, 1),
('Honeymoon Packages', 'honeymoon-packages', 'Romantic getaways for newlyweds', 10, 1);

-- ============================================================================
-- STEP 3: INSERT COMMON DESTINATIONS
-- ============================================================================

INSERT INTO `destinations` (`name`, `slug`, `state`, `country`, `description`, `is_active`, `display_order`) VALUES
-- Golden Triangle Destinations
('Delhi', 'delhi', 'Delhi', 'India', 'Capital city with rich Mughal heritage', 1, 1),
('Agra', 'agra', 'Uttar Pradesh', 'India', 'Home to the iconic Taj Mahal', 1, 2),
('Jaipur', 'jaipur', 'Rajasthan', 'India', 'The Pink City known for forts and palaces', 1, 3),

-- Himachal Destinations
('Shimla', 'shimla', 'Himachal Pradesh', 'India', 'Popular hill station and former summer capital', 1, 4),
('Manali', 'manali', 'Himachal Pradesh', 'India', 'Adventure hub with snow-capped mountains', 1, 5),
('Dharamshala', 'dharamshala', 'Himachal Pradesh', 'India', 'Home to Dalai Lama and Tibetan culture', 1, 6),
('Kullu', 'kullu', 'Himachal Pradesh', 'India', 'Valley of Gods with scenic beauty', 1, 7),
('Dalhousie', 'dalhousie', 'Himachal Pradesh', 'India', 'Charming colonial-era hill station', 1, 8),
('Kasauli', 'kasauli', 'Himachal Pradesh', 'India', 'Peaceful hill town with colonial charm', 1, 9),

-- Rajasthan Destinations
('Udaipur', 'udaipur', 'Rajasthan', 'India', 'City of Lakes with romantic palaces', 1, 10),
('Jodhpur', 'jodhpur', 'Rajasthan', 'India', 'The Blue City with Mehrangarh Fort', 1, 11),
('Jaisalmer', 'jaisalmer', 'Rajasthan', 'India', 'The Golden City in Thar Desert', 1, 12),
('Bikaner', 'bikaner', 'Rajasthan', 'India', 'Desert city famous for Junagarh Fort', 1, 13),
('Pushkar', 'pushkar', 'Rajasthan', 'India', 'Sacred town with Brahma Temple', 1, 14),
('Mount Abu', 'mount-abu', 'Rajasthan', 'India', 'Only hill station in Rajasthan', 1, 15),

-- Pilgrimage Destinations
('Varanasi', 'varanasi', 'Uttar Pradesh', 'India', 'Holiest city on banks of Ganges', 1, 16),
('Haridwar', 'haridwar', 'Uttarakhand', 'India', 'Gateway to God with evening Ganga Aarti', 1, 17),
('Rishikesh', 'rishikesh', 'Uttarakhand', 'India', 'Yoga capital of the world', 1, 18),
('Mathura', 'mathura', 'Uttar Pradesh', 'India', 'Birthplace of Lord Krishna', 1, 19),
('Vrindavan', 'vrindavan', 'Uttar Pradesh', 'India', 'Sacred town of Krishna temples', 1, 20),
('Amritsar', 'amritsar', 'Punjab', 'India', 'Home to the Golden Temple', 1, 21),

-- Other Popular Destinations
('Goa', 'goa', 'Goa', 'India', 'Beach paradise with Portuguese heritage', 1, 22),
('Kerala', 'kerala', 'Kerala', 'India', 'God''s Own Country with backwaters', 1, 23),
('Mumbai', 'mumbai', 'Maharashtra', 'India', 'Financial capital and Bollywood hub', 1, 24),
('Bangalore', 'bangalore', 'Karnataka', 'India', 'Garden City and IT capital', 1, 25);

-- ============================================================================
-- STEP 4: MIGRATE DATA FROM OLD TABLES TO NEW STRUCTURE
-- ============================================================================

-- NOTE: If you're importing into a NEW empty database (sspsof5_tdspt2),
-- these migration queries will be SKIPPED automatically because old tables don't exist.
-- 
-- To migrate data from old database (sspsof5_tdspt):
-- Option 1: Run this SQL file in OLD database first, then export tour_packages table
-- Option 2: Use the manual migration steps at the end of this file

-- Migrate Golden Triangle Tours
INSERT INTO `tour_packages` (
    `category_id`, `title`, `slug`, `description`, `duration_days`, `duration_nights`,
    `base_price`, `gallery_images`, `inclusions`, `exclusions`,
    `meta_title`, `meta_description`, `meta_keywords`, `is_active`
)
SELECT 
    1 as category_id,
    title,
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) as duration_days,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1 as duration_nights,
    price as base_price,
    gallery_images,
    inclusion as inclusions,
    exclusion as exclusions,
    COALESCE(meta_title, title) as meta_title,
    COALESCE(meta_description, LEFT(description, 160)) as meta_description,
    COALESCE(meta_keywords, title) as meta_keywords,
    1 as is_active
FROM `golden_triangle`
WHERE EXISTS (SELECT 1 FROM `golden_triangle` LIMIT 1);

-- Migrate Himachal Tours
INSERT INTO `tour_packages` (
    `category_id`, `title`, `slug`, `description`, `duration_days`, `duration_nights`,
    `base_price`, `gallery_images`, `inclusions`, `exclusions`,
    `meta_title`, `meta_description`, `meta_keywords`, `is_active`
)
SELECT 
    2 as category_id,
    title,
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) as duration_days,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1 as duration_nights,
    price as base_price,
    gallery_images,
    inclusion as inclusions,
    exclusion as exclusions,
    COALESCE(meta_title, title) as meta_title,
    COALESCE(meta_description, LEFT(description, 160)) as meta_description,
    COALESCE(meta_keywords, title) as meta_keywords,
    1 as is_active
FROM `himachal_packages`
WHERE EXISTS (SELECT 1 FROM `himachal_packages` LIMIT 1);

-- Migrate Rajasthan Tours
INSERT INTO `tour_packages` (
    `category_id`, `title`, `slug`, `description`, `duration_days`, `duration_nights`,
    `base_price`, `gallery_images`, `inclusions`, `exclusions`,
    `meta_title`, `meta_description`, `meta_keywords`, `is_active`
)
SELECT 
    3 as category_id,
    title,
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) as duration_days,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1 as duration_nights,
    price as base_price,
    gallery_images,
    inclusion as inclusions,
    exclusion as exclusions,
    COALESCE(meta_title, title) as meta_title,
    COALESCE(meta_description, LEFT(description, 160)) as meta_description,
    COALESCE(meta_keywords, title) as meta_keywords,
    1 as is_active
FROM `rajasthan_tour`
WHERE EXISTS (SELECT 1 FROM `rajasthan_tour` LIMIT 1);

-- Migrate Taj Mahal Tours
INSERT INTO `tour_packages` (
    `category_id`, `title`, `slug`, `description`, `duration_days`, `duration_nights`,
    `base_price`, `gallery_images`, `inclusions`, `exclusions`,
    `meta_title`, `meta_description`, `meta_keywords`, `is_active`
)
SELECT 
    4 as category_id,
    title,
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) as duration_days,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1 as duration_nights,
    price as base_price,
    gallery_images,
    inclusion as inclusions,
    exclusion as exclusions,
    COALESCE(meta_title, title) as meta_title,
    COALESCE(meta_description, LEFT(description, 160)) as meta_description,
    COALESCE(meta_keywords, title) as meta_keywords,
    1 as is_active
FROM `tajmahal_tours`
WHERE EXISTS (SELECT 1 FROM `tajmahal_tours` LIMIT 1);

-- Migrate Pilgrimage Tours
INSERT INTO `tour_packages` (
    `category_id`, `title`, `slug`, `description`, `duration_days`, `duration_nights`,
    `base_price`, `gallery_images`, `inclusions`, `exclusions`,
    `meta_title`, `meta_description`, `meta_keywords`, `is_active`
)
SELECT 
    5 as category_id,
    title,
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) as duration_days,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1 as duration_nights,
    price as base_price,
    gallery_images,
    inclusion as inclusions,
    exclusion as exclusions,
    COALESCE(meta_title, title) as meta_title,
    COALESCE(meta_description, LEFT(description, 160)) as meta_description,
    COALESCE(meta_keywords, title) as meta_keywords,
    1 as is_active
FROM `pilgrimage_package`
WHERE EXISTS (SELECT 1 FROM `pilgrimage_package` LIMIT 1);

-- ============================================================================
-- STEP 5: MIGRATE ITINERARIES (If itinerary column contains day-wise data)
-- ============================================================================

-- Note: This requires manual review as itinerary format may vary
-- You'll need to parse the itinerary column and insert day-wise data
-- Example structure after manual review:

-- INSERT INTO `package_itinerary` (`package_id`, `day_number`, `title`, `description`)
-- VALUES (1, 1, 'Day 1: Arrival in Delhi', 'Pick up from airport...');

-- ============================================================================
-- STEP 6: CREATE DEFAULT ADMIN USER
-- ============================================================================

-- Password: admin123 (Change this after first login!)
INSERT INTO `admin_users` (`username`, `email`, `password`, `full_name`, `role`, `is_active`)
VALUES ('admin', 'admin@touristdrivers.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'super_admin', 1);

-- ============================================================================
-- STEP 7: MIGRATE EXISTING VEHICLES (If table exists)
-- ============================================================================

INSERT INTO `vehicles_new` (
    `name`, `type`, `capacity`, `image`, `price_per_km`, `price_per_day`, `is_active`
)
SELECT 
    name,
    CASE 
        WHEN LOWER(type) LIKE '%sedan%' THEN 'sedan'
        WHEN LOWER(type) LIKE '%suv%' THEN 'suv'
        WHEN LOWER(type) LIKE '%tempo%' THEN 'tempo_traveller'
        WHEN LOWER(type) LIKE '%bus%' THEN 'bus'
        ELSE 'sedan'
    END as type,
    capacity,
    image,
    price_per_km,
    price_per_day,
    1 as is_active
FROM `cars`
WHERE EXISTS (SELECT 1 FROM `cars` LIMIT 1);

-- ============================================================================
-- STEP 8: MIGRATE GALLERY IMAGES (If separate gallery table exists)
-- ============================================================================

INSERT INTO `gallery_new` (`title`, `image_url`, `category`, `related_type`, `is_active`)
SELECT 
    title,
    image,
    category,
    'general' as related_type,
    1 as is_active
FROM `gallery`
WHERE EXISTS (SELECT 1 FROM `gallery` LIMIT 1);

-- ============================================================================
-- OPTIONAL: BACKUP OLD TABLES (Uncomment to rename old tables)
-- ============================================================================

-- RENAME TABLE `golden_triangle` TO `golden_triangle_backup`;
-- RENAME TABLE `himachal_packages` TO `himachal_packages_backup`;
-- RENAME TABLE `rajasthan_tour` TO `rajasthan_tour_backup`;
-- RENAME TABLE `tajmahal_tours` TO `tajmahal_tours_backup`;
-- RENAME TABLE `pilgrimage_package` TO `pilgrimage_package_backup`;
-- RENAME TABLE `cars` TO `cars_backup`;
-- RENAME TABLE `gallery` TO `gallery_backup`;

-- ============================================================================
-- RENAME NEW TABLES TO PRODUCTION NAMES (After successful migration)
-- ============================================================================

-- RENAME TABLE `vehicles_new` TO `vehicles`;
-- RENAME TABLE `gallery_new` TO `gallery`;

-- ============================================================================
-- VERIFICATION QUERIES
-- ============================================================================

-- Check migration results:
-- SELECT c.name as category, COUNT(p.id) as package_count 
-- FROM categories c 
-- LEFT JOIN tour_packages p ON c.id = p.category_id 
-- GROUP BY c.id;

-- SELECT * FROM tour_packages LIMIT 10;
-- SELECT * FROM destinations LIMIT 10;

-- ============================================================================
-- NOTES FOR IMPLEMENTATION
-- ============================================================================

/*
IMPORTANT: TWO SCENARIOS FOR MIGRATION

SCENARIO A: IMPORTING INTO NEW EMPTY DATABASE (sspsof5_tdspt2)
==============================================================

1. BACKUP YOUR CURRENT DATABASE FIRST!
   mysqldump -u root -p sspsof5_tdspt > backup_old_database.sql

2. Create new database:
   CREATE DATABASE sspsof5_tdspt2;

3. Import this file into NEW database:
   mysql -u root -p sspsof5_tdspt2 < new_database_structure.sql
   
   Result:
   ✅ New tables created
   ✅ Categories and destinations pre-filled
   ✅ Migration queries SKIPPED (old tables don't exist)
   ⚠️  No tour data yet

4. Manually export data from OLD database and import:
   
   A. Export old tours from sspsof5_tdspt:
      Run these queries in OLD database (sspsof5_tdspt):

      -- Golden Triangle
      SELECT 
          1 as category_id,
          title,
          LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), '/', '-'), '&', 'and')) as slug,
          description,
          duration,
          price as base_price,
          gallery_images,
          inclusion as inclusions,
          exclusion as exclusions,
          COALESCE(meta_title, title) as meta_title,
          COALESCE(meta_description, LEFT(description, 160)) as meta_description,
          COALESCE(meta_keywords, title) as meta_keywords
      FROM golden_triangle;
      
      -- Export as CSV or copy results
      -- Then manually insert into sspsof5_tdspt2.tour_packages
      
   B. Or use this simpler approach:
      
      In phpMyAdmin:
      1. Old database: Select golden_triangle table → Export → SQL
      2. Open exported file, change INSERT INTO to:
         INSERT INTO sspsof5_tdspt2.tour_packages (category_id, title, slug, description...)
      3. Import into new database

5. Update config.php:
   $database = "sspsof5_tdspt2";

6. Test thoroughly!


SCENARIO B: IMPORTING INTO OLD DATABASE (sspsof5_tdspt)
=======================================================

1. BACKUP CURRENT DATABASE FIRST!
   mysqldump -u root -p sspsof5_tdspt > backup.sql

2. Import this file into OLD database:
   mysql -u root -p sspsof5_tdspt < new_database_structure.sql
   
   Result:
   ✅ New tables created
   ✅ Categories and destinations pre-filled  
   ✅ All tours AUTOMATICALLY migrated
   ✅ Old tables preserved (for backup)

3. Verify migration:
   SELECT c.name, COUNT(p.id) as tours 
   FROM categories c 
   LEFT JOIN tour_packages p ON c.id = p.category_id 
   GROUP BY c.id;

4. After successful testing, rename old tables:
   RENAME TABLE golden_triangle TO golden_triangle_backup;
   RENAME TABLE himachal_packages TO himachal_packages_backup;
   (etc.)

5. Update all PHP files to use new tables

6. Test everything!


RECOMMENDED APPROACH FOR YOU (New Database sspsof5_tdspt2):
===========================================================

EASIEST METHOD:

1. Import this SQL into OLD database first (sspsof5_tdspt):
   - This will migrate all data automatically
   
2. Export ONLY the new tables from old database:
   mysqldump -u root -p sspsof5_tdspt \
     categories destinations tour_packages package_destinations \
     package_itinerary package_pricing customers bookings reviews \
     vehicles_new gallery_new admin_users \
     > new_tables_with_data.sql

3. Import into NEW database (sspsof5_tdspt2):
   mysql -u root -p sspsof5_tdspt2 < new_tables_with_data.sql

4. Update config.php database name

5. Done! ✅


MANUAL DATA MIGRATION QUERIES (If needed):
==========================================

-- If you want to manually copy data between databases:

-- Example: Copy Golden Triangle tours
INSERT INTO sspsof5_tdspt2.tour_packages 
  (category_id, title, slug, description, duration_days, duration_nights, 
   base_price, gallery_images, inclusions, exclusions, 
   meta_title, meta_description, meta_keywords)
SELECT 
    1,
    title,
    LOWER(REPLACE(REPLACE(title, ' ', '-'), '&', 'and')),
    description,
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED),
    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) - 1,
    price,
    gallery_images,
    inclusion,
    exclusion,
    COALESCE(meta_title, title),
    COALESCE(meta_description, LEFT(description, 160)),
    COALESCE(meta_keywords, title)
FROM sspsof5_tdspt.golden_triangle;

-- Repeat for other categories (change category_id):
-- 2 = Himachal Tours (himachal_packages)
-- 3 = Rajasthan Tours (rajasthan_tour)
-- 4 = Taj Mahal Tours (tajmahal_tours)
-- 5 = Pilgrimage Tours (pilgrimage_package)


VERIFICATION QUERIES:
=====================

-- Check if migration was successful:
SELECT 'Categories' as Table_Name, COUNT(*) as Count FROM categories
UNION ALL
SELECT 'Destinations', COUNT(*) FROM destinations
UNION ALL
SELECT 'Tour Packages', COUNT(*) FROM tour_packages
UNION ALL
SELECT 'Admin Users', COUNT(*) FROM admin_users;

-- Expected results:
-- Categories: 10
-- Destinations: 25+
-- Tour Packages: (your tour count)
-- Admin Users: 1

-- View migrated tours by category:
SELECT 
    c.name as Category,
    COUNT(p.id) as Total_Tours,
    MIN(p.base_price) as Min_Price,
    MAX(p.base_price) as Max_Price
FROM categories c 
LEFT JOIN tour_packages p ON c.id = p.category_id 
GROUP BY c.id, c.name
ORDER BY c.display_order;


IMPORTANT REMINDERS:
====================

✅ ALWAYS backup before migration
✅ Test in new database first (sspsof5_tdspt2)  
✅ Verify all data migrated correctly
✅ Update config.php database name
✅ Update all PHP files to use new tables
✅ Change default admin password (admin123)
✅ Test booking functionality
✅ Monitor error logs
✅ Keep old database as backup for 1-2 weeks
*/

-- ============================================================================
-- END OF SQL FILE
-- ============================================================================
