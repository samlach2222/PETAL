TYPE=VIEW
query=select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere`,round(((`tablenombrereponsescorrectes`.`nombreReponsesCorrectes` / count(0)) * 20),2) AS `moyenne` from (((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) join (select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,count(0) AS `nombreReponsesCorrectes` from ((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) where (`petal_db`.`question`.`reponseALaQuestion` = `petal_db`.`reponsedeetudiant`.`reponseChoisie`) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrereponsescorrectes` on(((`petal_db`.`qcm`.`idQCM` = `tablenombrereponsescorrectes`.`idQCM`) and (`petal_db`.`reponsedeetudiant`.`num` = `tablenombrereponsescorrectes`.`num`)))) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`
md5=81f7ecacfc16a0e6950c368ef38fa8ff
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-04-25 14:21:31
create-version=1
source=SELECT idQCM, num, nomQCM, nomMatiere, ROUND((nombreReponsesCorrectes/COUNT(*))*20,2) AS moyenne\n    FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant NATURAL JOIN (\n        SELECT idQCM, num, COUNT(*) AS nombreReponsesCorrectes\n        FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant\n        WHERE reponseALaQuestion = reponseChoisie\n        GROUP BY idQCM, num\n    ) AS TableNombreReponsesCorrectes\n    GROUP BY idQCM, num
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere`,round(((`tablenombrereponsescorrectes`.`nombreReponsesCorrectes` / count(0)) * 20),2) AS `moyenne` from (((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) join (select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,count(0) AS `nombreReponsesCorrectes` from ((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) where (`petal_db`.`question`.`reponseALaQuestion` = `petal_db`.`reponsedeetudiant`.`reponseChoisie`) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrereponsescorrectes` on(((`petal_db`.`qcm`.`idQCM` = `tablenombrereponsescorrectes`.`idQCM`) and (`petal_db`.`reponsedeetudiant`.`num` = `tablenombrereponsescorrectes`.`num`)))) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`
