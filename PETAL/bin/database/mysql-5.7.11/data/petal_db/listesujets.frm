TYPE=VIEW
query=select `petal_db`.`sujetforum`.`idSujetForum` AS `idSujetForum`,`petal_db`.`sujetforum`.`nomSujet` AS `nomSujet`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,`tablenbmessages`.`nbMessages` AS `nbMessages`,`petal_db`.`sujetforum`.`resolu` AS `resolu`,`petal_db`.`sujetforum`.`nomMatiere` AS `nomMatiere`,`petal_db`.`sujetforum`.`num` AS `num` from ((`petal_db`.`sujetforum` join (select `petal_db`.`messageforum`.`idSujetForum` AS `idSujetForum`,count(0) AS `nbMessages` from `petal_db`.`messageforum` group by `petal_db`.`messageforum`.`idSujetForum`) `tablenbmessages` on((`petal_db`.`sujetforum`.`idSujetForum` = `tablenbmessages`.`idSujetForum`))) join `petal_db`.`utilisateur` on((`petal_db`.`sujetforum`.`num` = `petal_db`.`utilisateur`.`num`)))
md5=d4b2b7d5565deb5b80a78c72b16c644a
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-05-05 09:35:52
create-version=1
source=SELECT idSujetForum, nomSujet, nom, prenom, nbMessages, resolu, nomMatiere, num\n    FROM sujetforum NATURAL JOIN (\n        SELECT idSujetForum, COUNT(*) AS nbMessages\n        FROM messageforum\n        GROUP BY idSujetForum\n    ) AS tableNbMessages NATURAL JOIN utilisateur
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `petal_db`.`sujetforum`.`idSujetForum` AS `idSujetForum`,`petal_db`.`sujetforum`.`nomSujet` AS `nomSujet`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,`tablenbmessages`.`nbMessages` AS `nbMessages`,`petal_db`.`sujetforum`.`resolu` AS `resolu`,`petal_db`.`sujetforum`.`nomMatiere` AS `nomMatiere`,`petal_db`.`sujetforum`.`num` AS `num` from ((`petal_db`.`sujetforum` join (select `petal_db`.`messageforum`.`idSujetForum` AS `idSujetForum`,count(0) AS `nbMessages` from `petal_db`.`messageforum` group by `petal_db`.`messageforum`.`idSujetForum`) `tablenbmessages` on((`petal_db`.`sujetforum`.`idSujetForum` = `tablenbmessages`.`idSujetForum`))) join `petal_db`.`utilisateur` on((`petal_db`.`sujetforum`.`num` = `petal_db`.`utilisateur`.`num`)))
