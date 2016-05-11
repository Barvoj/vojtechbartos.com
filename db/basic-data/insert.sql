INSERT INTO `vojtechbartos`.`languages` (`language_id`, `code`, `locale`, `locale_language`, `locale_region`, `name`, `is_enabled`) VALUES
  (1, 'cze', 'cs-CZ', 'cs', 'CZ', 'Čeština', 1),
  (2, 'eng', 'en-US', 'en', 'US', 'English', 1);

INSERT INTO `vojtechbartos`.`users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `password`, `language_id`) VALUES
  (1, 'admin', 'administrator@vojtechbartos.cz', '', '', '$2y$10$GDnStWCZlRBvTJNndKMql.Mepehu2ZrbhzVFG5j0aGfeTZ21VqD3W', 1); -- password: hcAdmin
