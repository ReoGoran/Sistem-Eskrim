-- IceScoop seed data
INSERT INTO users (name,email,whatsapp,password_hash,role) VALUES
('Admin','admin@icescoop.local','628111111111', '$2y$10$6q8WwY2hOa5lUqH0.Zz7ceI6WQqPZkY9bVq5P2Wq3kqKAvQ9G6d3O','admin');

INSERT INTO categories (name,slug) VALUES
('Strawberry','strawberry'),('Orange','orange'),('Grape','grape'),('Chocolate','chocolate'),('Vanilla','vanilla');

INSERT INTO products (category_id,name,slug,description,price,stock,weight_kg,image,flavor,is_discount,is_popular) VALUES
(1,'Strawberry Bliss','strawberry-bliss','Rasa stroberi segar manis.',15000,100,0.50,'/public/assets/img/uploads/strawberry.jpg','strawberry',1,1),
(2,'Orange Zest','orange-zest','Jeruk segar menyegarkan.',14000,100,0.50,'/public/assets/img/uploads/orange.jpg','orange',0,1),
(3,'Grape Dream','grape-dream','Anggur manis lembut.',16000,90,0.50,'/public/assets/img/uploads/grape.jpg','grape',0,0),
(4,'Choco Lava','choco-lava','Cokelat pekat nikmat.',17000,120,0.60,'/public/assets/img/uploads/choco.jpg','chocolate',1,1),
(5,'Vanilla Cloud','vanilla-cloud','Vanilla lembut klasik.',13000,110,0.50,'/public/assets/img/uploads/vanilla.jpg','vanilla',0,0);

INSERT INTO banners (title,image,link,is_active,sort_order) VALUES
('Diskon 20% Minggu Ini','/public/assets/img/uploads/banner1.jpg','/products?discount=1',1,1),
('Rasa Baru Choco Lava','/public/assets/img/uploads/banner2.jpg','/products/detail/4',1,2);

INSERT INTO events (title,content,target_amount,collected_amount,is_active) VALUES
('Event Berbagi Es Krim','Mari berbagi kebahagiaan dengan donasi es krim untuk anak panti asuhan.',2000000,250000,1);

INSERT INTO blog_posts (title,slug,content,author_id,is_published) VALUES
('Manfaat Es Krim Rasa Buah','manfaat-es-krim-buah','<p>Es krim rasa buah menyegarkan dan kaya vitamin.</p>',1,1);

-- Seed flavors (initial taxonomy)
INSERT INTO flavors (name,slug,image) VALUES
('Strawberry','strawberry','/public/assets/img/uploads/strawberry.jpg'),
('Orange','orange','/public/assets/img/uploads/orange.jpg'),
('Grape','grape','/public/assets/img/uploads/grape.jpg'),
('Chocolate','chocolate','/public/assets/img/uploads/choco.jpg'),
('Vanilla','vanilla','/public/assets/img/uploads/vanilla.jpg');

-- Map existing products to flavors
INSERT INTO product_flavors (product_id,flavor_id)
SELECT p.id, f.id FROM products p JOIN flavors f ON p.flavor = f.slug;
