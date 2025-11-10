-- Ensure core flavors exist and sync existing product 'flavor' column into product_flavors mapping
-- Run this in your MySQL database for the project (phpMyAdmin or mysql client)

-- Insert flavors if not exists
INSERT INTO flavors (name,slug,image)
SELECT 'Chocolate','chocolate','/public/assets/img/uploads/choco.jpg' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM flavors WHERE slug='chocolate');

INSERT INTO flavors (name,slug,image)
SELECT 'Grape','grape','/public/assets/img/uploads/grape.jpg' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM flavors WHERE slug='grape');

INSERT INTO flavors (name,slug,image)
SELECT 'Orange','orange','/public/assets/img/uploads/orange.jpg' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM flavors WHERE slug='orange');

INSERT INTO flavors (name,slug,image)
SELECT 'Strawberry','strawberry','/public/assets/img/uploads/strawberry.jpg' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM flavors WHERE slug='strawberry');

INSERT INTO flavors (name,slug,image)
SELECT 'Vanilla','vanilla','/public/assets/img/uploads/vanilla.jpg' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM flavors WHERE slug='vanilla');

-- Map existing products to flavors based on products.flavor matching flavor.slug
INSERT INTO product_flavors (product_id,flavor_id)
SELECT p.id, f.id
FROM products p
JOIN flavors f ON p.flavor = f.slug
LEFT JOIN product_flavors pf ON pf.product_id = p.id AND pf.flavor_id = f.id
WHERE pf.product_id IS NULL;
