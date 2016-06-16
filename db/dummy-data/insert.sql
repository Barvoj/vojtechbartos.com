INSERT INTO `vojtechbartos`.`articles` (`article_id`, `language_id`, `user_id`, `title`, `content`) VALUES
  (1, 1, 1, 'Prvni clanek', 'Toto je vzorovy clanek'),
  (2, 1, 2, 'Druhy', 'Toto je clanek od druheho uzivatele');

INSERT INTO `vojtechbartos`.`users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `password`, `language_id`) VALUES
  (2, 'user', 'user@vojtechbartos.cz', '', '', '$2y$10$GDnStWCZlRBvTJNndKMql.Mepehu2ZrbhzVFG5j0aGfeTZ21VqD3W', 1); -- password: hcAdmin