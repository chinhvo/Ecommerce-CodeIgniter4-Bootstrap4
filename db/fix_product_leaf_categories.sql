-- Force products to use only leaf categories (no parent categories)
-- Works with the 3-level category design from category_dump_from_rawhtml.sql

SET FOREIGN_KEY_CHECKS = 0;

UPDATE products
SET shop_categorie = CASE url
    WHEN 'xe-dien-scooter-x6' THEN 39
    WHEN 'xe-dien-smart-v9-plus' THEN 42
    WHEN 'xe-dien-type3-pro' THEN 54
    WHEN 'xe-dien-v1-plus-livo' THEN 45
    WHEN 'xe-dien-yaka-vx' THEN 55
    WHEN 'xe-dien-yaka-lavara' THEN 55
    WHEN 'xe-dien-smart-v1-pro' THEN 42
    WHEN 'xe-dien-hot-trend-dylexe-x1' THEN 56
    WHEN 'xe-dien-dior-livo' THEN 58
    WHEN 'xe-dien-vnbike-x6' THEN 41
    WHEN 'xe-dap-dien-vnbike-i1' THEN 25
    WHEN 'xe-dien-smart-a9' THEN 42
    WHEN 'xe-dien-vnbike-a8' THEN 41
    WHEN 'xe-dap-dien-vnbike-v1-18inh' THEN 25
    WHEN 'xe-dap-dien-vnbike-hotgirl-g1' THEN 19
    WHEN 'o-to-dien-vinfast-vf3-thue-pin' THEN 61
    WHEN 'xe-3-banh-cho-hang-smart-m700' THEN 88
    WHEN 'o-to-dien-bestune-xiaoma' THEN 63
    WHEN 'xe-dap-dien-yadea-e3' THEN 24
    WHEN 'xe-may-dien-tailg-f73' THEN 49
    WHEN 'bo-sac-xe-dien-60v-12a' THEN 120
    WHEN 'ac-quy-xe-dien-60v-20ah-lithium' THEN 133
    WHEN 'tram-sac-xe-dien-ac-7kw' THEN 122
    WHEN 'xe-dien-tre-em-mini-3-banh-36v' THEN 32
    WHEN 'xe-may-dien-pega-newtech-2024' THEN 43
    WHEN 'xe-dien-kazuki-s5-plus' THEN 26
    WHEN 'binh-ac-quy-48v-12ah' THEN 129
    WHEN 'xe-may-dien-giant-hp3-2024' THEN 50
    WHEN 'den-pha-led-xe-dien-sieu-sang' THEN 111
    WHEN 'xe-dien-3-banh-cho-khach-ev-k300' THEN 90
    ELSE shop_categorie
END
WHERE url IN (
    'xe-dien-scooter-x6',
    'xe-dien-smart-v9-plus',
    'xe-dien-type3-pro',
    'xe-dien-v1-plus-livo',
    'xe-dien-yaka-vx',
    'xe-dien-yaka-lavara',
    'xe-dien-smart-v1-pro',
    'xe-dien-hot-trend-dylexe-x1',
    'xe-dien-dior-livo',
    'xe-dien-vnbike-x6',
    'xe-dap-dien-vnbike-i1',
    'xe-dien-smart-a9',
    'xe-dien-vnbike-a8',
    'xe-dap-dien-vnbike-v1-18inh',
    'xe-dap-dien-vnbike-hotgirl-g1',
    'o-to-dien-vinfast-vf3-thue-pin',
    'xe-3-banh-cho-hang-smart-m700',
    'o-to-dien-bestune-xiaoma',
    'xe-dap-dien-yadea-e3',
    'xe-may-dien-tailg-f73',
    'bo-sac-xe-dien-60v-12a',
    'ac-quy-xe-dien-60v-20ah-lithium',
    'tram-sac-xe-dien-ac-7kw',
    'xe-dien-tre-em-mini-3-banh-36v',
    'xe-may-dien-pega-newtech-2024',
    'xe-dien-kazuki-s5-plus',
    'binh-ac-quy-48v-12ah',
    'xe-may-dien-giant-hp3-2024',
    'den-pha-led-xe-dien-sieu-sang',
    'xe-dien-3-banh-cho-khach-ev-k300'
);

SET FOREIGN_KEY_CHECKS = 1;

-- Validation query: must return 0 rows
SELECT p.id, p.url, p.shop_categorie
FROM products p
JOIN shop_categories c ON c.id = p.shop_categorie
WHERE EXISTS (
    SELECT 1
    FROM shop_categories child
    WHERE child.sub_for = c.id
);
