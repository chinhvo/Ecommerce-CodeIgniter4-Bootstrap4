-- Reset all highlighted products first, then set 8 products as highlighted
UPDATE products SET highlighted = 0;

UPDATE products SET highlighted = 1 WHERE id IN (1, 2, 3, 4, 5, 6, 7, 8);
