
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Bảng categories (Danh mục tour)
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description text ,
    image VARCHAR(255) NULL DEFAULT NULL,
    slug Varchar(255) not null,
    category_parent BIGINT UNSIGNED NULL DEFAULT NULL,
    status TINYINT NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    
);

-- 3. Bảng tours
CREATE TABLE tours (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT NULL DEFAULT NULL,
    image VARCHAR(255) NULL DEFAULT NULL,
    price_adult INT NOT NULL,
    price_children INT NOT NULL,
    quantity INT NOT NULL,
    vehicle VARCHAR(100) NULL DEFAULT NULL,
    departure_date TEXT NOT NULL,
    slug VARCHAR(255),
    tour_code VARCHAR(50) NOT NULL UNIQUE,
    tour_form VARCHAR(100) NULL DEFAULT NULL,
    tour_to VARCHAR(100) NULL DEFAULT NULL,
    tour_time VARCHAR(100) NULL DEFAULT NULL,
    status TINYINT NOT NULL DEFAULT 1,
    note TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. Bảng bookings (Đặt tour)
CREATE TABLE bookings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tour_id BIGINT UNSIGNED NOT NULL,
    date_departure TEXT NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    note TEXT NULL DEFAULT NULL,
    phone VARCHAR(20) NOT NULL,
    adult INT NOT NULL,
    children INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status TINYINT NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign key constraint
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 5. Bảng schedules (Lịch trình tour)
CREATE TABLE schedules (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tour_id BIGINT UNSIGNED NOT NULL,
    lichtrinh TEXT NULL DEFAULT NULL,
    chinhsach TEXT NULL DEFAULT NULL,
    baogom TEXT NULL DEFAULT NULL,
    khongbaogom TEXT NULL DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign key constraint
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 6. Bảng galleries (Thư viện ảnh)
CREATE TABLE galleries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tour_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NULL DEFAULT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign key constraint
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- 11. Bảng cache_locks (Laravel Cache Locks)
CREATE TABLE cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INTEGER NOT NULL
);

-- 12. Bảng sessions (Laravel Sessions)
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL DEFAULT NULL,
    ip_address VARCHAR(45) NULL DEFAULT NULL,
    user_agent TEXT NULL DEFAULT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INTEGER NOT NULL,
    
    -- Indexes
    INDEX idx_sessions_user_id (user_id),
    INDEX idx_sessions_last_activity (last_activity),
    
    -- Foreign key constraint
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 13. Bảng password_reset_tokens (Laravel Password Reset)
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL
);