CREATE TABLE `products` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `file` text NOT NULL,
 `category` varchar(60) NOT NULL,
 `location` varchar(2) NOT NULL,
 `price` float(7) NOT NULL,
 PRIMARY KEY (`id`)
);


INSERT INTO products VALUES
  (1, "Screen Shot 2019-11-11 at 5.07.25 PM.png", "test", "NY", "200.00");
