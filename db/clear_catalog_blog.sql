-- Reset catalog + blog data for fresh import
-- Target: products, categories, blog posts and their translations
-- Run in MySQL/MariaDB against the AxCommerce database

SET FOREIGN_KEY_CHECKS = 0;

-- Products
TRUNCATE TABLE products_translations;
TRUNCATE TABLE products;

-- Shop categories
TRUNCATE TABLE shop_categories_translations;
TRUNCATE TABLE shop_categories;

-- Blog
TRUNCATE TABLE blog_translations;
TRUNCATE TABLE blog_posts;

SET FOREIGN_KEY_CHECKS = 1;
