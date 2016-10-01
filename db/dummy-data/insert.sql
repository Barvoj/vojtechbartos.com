INSERT INTO `vojtechbartos`.`articles` (`article_id`, `language_id`, `user_id`, `title`, `content`, `published`) VALUES
  (1, 1, 1, 'Prvni clanek', 'Toto je vzorovy clanek', '2016-09-01 12:00:00'),
  (2, 1, 1, 'Sesty', 'Toto je vzorovy clanek', NULL),
  (3, 1, 1, 'Sedmi', 'Toto je vzorovy clanek', NULL),
  (4, 1, 2, 'Druhy', 'Toto je clanek od druheho uzivatele', '2016-09-01 12:00:00'),
  (5, 1, 2, 'Treti', 'Toto je clanek od druheho uzivatele', '2016-09-01 12:00:00'),
  (6, 1, 2, 'Ctvrty', 'Toto je clanek od druheho uzivatele', '2016-09-01 12:00:00'),
  (7, 1, 2, 'Paty', 'Toto je clanek od druheho uzivatele', '2016-09-01 12:00:00');

INSERT INTO `vojtechbartos`.`users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `password`, `language_id`) VALUES
  (2, 'user', 'user@vojtechbartos.cz', '', '', '$2y$10$GDnStWCZlRBvTJNndKMql.Mepehu2ZrbhzVFG5j0aGfeTZ21VqD3W', 1); -- password: hcAdmin
