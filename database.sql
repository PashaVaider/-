/* 1 запрос, Удаление пустых групп (категорий), которые не содержат товаров*/
DELETE FROM categories
WHERE id NOT IN (SELECT DISTINCT category_id FROM products);
/* 2 запрос, Удаление товаров, которые отсутствуют на складах*/
DELETE FROM products
WHERE id NOT IN (SELECT DISTINCT product_id FROM availabilities);
/*3 запрос, Удаление складов, на которых нет товаров*/
DELETE FROM stocks
WHERE id NOT IN (SELECT DISTINCT stock_id FROM availabilities);


