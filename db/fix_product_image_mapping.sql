-- Fix existing product rows to use product-id folder and product_<id>.jpg image
-- Use after copying files to public/attachments/shop_images

UPDATE products
SET
    folder = id,
    image = CONCAT('product_', id, '.jpg')
WHERE id BETWEEN 1 AND 30;

-- Optional validation
SELECT id, folder, image
FROM products
WHERE id BETWEEN 1 AND 30
ORDER BY id;
