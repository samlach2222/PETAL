TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER trigger_matiere_admin_insert BEFORE INSERT\nON matiere\nFOR EACH ROW\nIF IsAdmin(NEW.num) != 1 THEN\n    SIGNAL SQLSTATE \'50001\' SET MESSAGE_TEXT = \'Un étudiant ne peut pas gérer une matière\';\nEND IF' 'CREATE DEFINER=`root`@`localhost` TRIGGER trigger_matiere_admin_update BEFORE UPDATE\nON matiere\nFOR EACH ROW\nIF IsAdmin(NEW.num) != 1 THEN\n    SIGNAL SQLSTATE \'50001\' SET MESSAGE_TEXT = \'Un étudiant ne peut pas gérer une matière\';\nEND IF'
sql_modes=1075838976 1075838976
definers='root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci'
created=165167964782 165167964786
