-- Seed blog posts from the bestsellers-table block in app/Views/references/rawhtml.html
-- Safe to re-run: it updates matching URLs and inserts missing rows/translations.

START TRANSACTION;

DROP TEMPORARY TABLE IF EXISTS tmp_bestseller_blog_seed;
CREATE TEMPORARY TABLE tmp_bestseller_blog_seed (
    title VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    abbr VARCHAR(5) NOT NULL DEFAULT 'en'
);

INSERT INTO tmp_bestseller_blog_seed (title, url, image, description, abbr) VALUES
('TGXCD dong hanh cung TpHCM khoi cong cau di bo Sai Gon', 'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon', 'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon908.jpg', '<p>TGXCD dong hanh cung TpHCM khoi cong cau di bo Sai Gon.</p>', 'en'),
('Hop tac kinh doanh cung The Gioi Xe Chay Dien', 'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien', 'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien285.jpg', '<p>Hop tac kinh doanh cung The Gioi Xe Chay Dien.</p>', 'en'),
('Chay thu xe dap dien, xe may dien mien phi tai nha', 'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha', 'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha282.jpg', '<p>Chay thu xe dap dien, xe may dien mien phi tai nha.</p>', 'en'),
('Xe dap dien, xe may dien tot nhat hien nay', 'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay', 'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay552.jpg', '<p>Xe dap dien, xe may dien tot nhat hien nay.</p>', 'en'),
('Bao ve vang xe dap dien, xe may dien', 'bao-ve-vang-xe-dap-dien-xe-may-dien', 'bao-ve-vang-xe-dap-dien-xe-may-dien580.jpg', '<p>Bao ve vang xe dap dien, xe may dien.</p>', 'en'),
('San xuat xe 3 banh tu che cho hang theo yeu cau', 'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau', 'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau246.jpg', '<p>San xuat xe 3 banh tu che cho hang theo yeu cau.</p>', 'en'),
('Xe ban hang luu dong chay dien: trao luu duoc ua chuong nhat hien nay', 'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay', 'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay785.jpg', '<p>Xe ban hang luu dong chay dien: trao luu duoc ua chuong nhat hien nay.</p>', 'en');

-- Keep image/time in sync for existing rows by URL.
UPDATE blog_posts bp
JOIN tmp_bestseller_blog_seed s ON s.url = bp.url
SET bp.image = s.image,
    bp.time = UNIX_TIMESTAMP();

-- Insert missing blog posts.
INSERT INTO blog_posts (image, url, time)
SELECT s.image, s.url, UNIX_TIMESTAMP()
FROM tmp_bestseller_blog_seed s
LEFT JOIN blog_posts bp ON bp.url = s.url
WHERE bp.id IS NULL;

-- Insert missing translations for each seeded URL/language.
INSERT INTO blog_translations (title, description, abbr, for_id)
SELECT s.title, s.description, s.abbr, bp.id
FROM tmp_bestseller_blog_seed s
JOIN blog_posts bp ON bp.url = s.url
LEFT JOIN blog_translations bt
    ON bt.for_id = bp.id
   AND bt.abbr = s.abbr
WHERE bt.id IS NULL;

-- Update existing translations to keep title/description current.
UPDATE blog_translations bt
JOIN blog_posts bp ON bp.id = bt.for_id
JOIN tmp_bestseller_blog_seed s ON s.url = bp.url AND s.abbr = bt.abbr
SET bt.title = s.title,
    bt.description = s.description;

COMMIT;

-- Verify seeded rows.
SELECT bp.id, bp.url, bp.image, bt.abbr, bt.title
FROM blog_posts bp
JOIN blog_translations bt ON bt.for_id = bp.id
WHERE bp.url IN (
    'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon',
    'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien',
    'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha',
    'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay',
    'bao-ve-vang-xe-dap-dien-xe-may-dien',
    'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau',
    'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay'
)
ORDER BY bp.id;