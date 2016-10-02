INSERT INTO `vojtechbartos`.`languages` (`language_id`, `code`, `locale`, `locale_language`, `locale_region`, `name`, `is_enabled`) VALUES
  (1, 'cze', 'cs-CZ', 'cs', 'CZ', 'Čeština', 1),
  (2, 'eng', 'en-US', 'en', 'US', 'English', 1);

INSERT INTO `vojtechbartos`.`roles` (`role_id`, `code`) VALUES
  (1, 'regular'),
  (2, 'admin');

INSERT INTO `vojtechbartos`.`users` (`user_id`, `username`, `role_id`, `email`, `first_name`, `last_name`, `password`, `language_id`)
VALUES
  (1, 'admin', 2, 'administrator@vojtechbartos.cz', 'Vojtěch', 'Bartoš',
   '$2y$10$GDnStWCZlRBvTJNndKMql.Mepehu2ZrbhzVFG5j0aGfeTZ21VqD3W', 1); -- password: hcAdmin
