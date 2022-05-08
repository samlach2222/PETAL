TYPE=VIEW
query=select `tablenombrereponsescorrectes`.`idQCM` AS `idQCM`,`tablenombrereponsescorrectes`.`num` AS `num`,`tablenombrequestions`.`nomQCM` AS `nomQCM`,`tablenombrequestions`.`nomMatiere` AS `nomMatiere`,round(((`tablenombrereponsescorrectes`.`nombreReponsesCorrectes` / `tablenombrequestions`.`nombreQuestions`) * 20),2) AS `moyenne` from ((select `tabletouslesreponses`.`idQCM` AS `idQCM`,`tabletouslesreponses`.`num` AS `num`,coalesce(`tablenombrereponsescorrectes`.`reponsesCorrectes`,0) AS `nombreReponsesCorrectes` from ((select `petal_db`.`reponsedeetudiant`.`idQuestion` AS `idQuestion`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`reponsedeetudiant`.`reponseChoisie` AS `reponseChoisie`,`petal_db`.`question`.`intitulé` AS `intitulé`,`petal_db`.`question`.`image` AS `image`,`petal_db`.`question`.`reponseALaQuestion` AS `reponseALaQuestion`,`petal_db`.`question`.`choix1` AS `choix1`,`petal_db`.`question`.`choix2` AS `choix2`,`petal_db`.`question`.`choix3` AS `choix3`,`petal_db`.`question`.`idQCM` AS `idQCM` from (`petal_db`.`reponsedeetudiant` join `petal_db`.`question` on((`petal_db`.`reponsedeetudiant`.`idQuestion` = `petal_db`.`question`.`idQuestion`)))) `tabletouslesreponses` left join (select `petal_db`.`question`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,count(0) AS `reponsesCorrectes` from (`petal_db`.`reponsedeetudiant` join `petal_db`.`question` on((`petal_db`.`reponsedeetudiant`.`idQuestion` = `petal_db`.`question`.`idQuestion`))) where (`petal_db`.`question`.`reponseALaQuestion` = `petal_db`.`reponsedeetudiant`.`reponseChoisie`) group by `petal_db`.`question`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrereponsescorrectes` on(((`tabletouslesreponses`.`idQCM` = `tablenombrereponsescorrectes`.`idQCM`) and (`tabletouslesreponses`.`num` = `tablenombrereponsescorrectes`.`num`)))) group by `tabletouslesreponses`.`idQCM`,`tabletouslesreponses`.`num`) `tablenombrereponsescorrectes` join (select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere`,count(0) AS `nombreQuestions` from ((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) where (`petal_db`.`qcm`.`publie` = TRUE) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrequestions` on(((`tablenombrereponsescorrectes`.`idQCM` = `tablenombrequestions`.`idQCM`) and (`tablenombrereponsescorrectes`.`num` = `tablenombrequestions`.`num`))))
md5=66a1f02d25c4ada7cdf2efd4dfd69089
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-05-08 21:44:20
create-version=1
source=SELECT idQCM, num, nomQCM, nomMatiere, ROUND((nombreReponsesCorrectes/nombreQuestions)*20,2) AS moyenne\n    FROM (\n        SELECT TableTousLesReponses.idQCM, TableTousLesReponses.num, COALESCE(reponsesCorrectes, 0) AS nombreReponsesCorrectes\n        FROM (\n            SELECT * FROM reponsedeetudiant NATURAL JOIN question\n        ) AS TableTousLesReponses LEFT JOIN (\n            SELECT idQCM, num, COUNT(*) AS reponsesCorrectes\n            FROM reponsedeetudiant NATURAL JOIN question\n            WHERE reponseALaQuestion = reponseChoisie\n            GROUP BY idQCM, num\n        ) AS TableNombreReponsesCorrectes ON (TableTousLesReponses.idQCM = TableNombreReponsesCorrectes.idQCM && TableTousLesReponses.num = TableNombreReponsesCorrectes.num)\n        GROUP BY TableTousLesReponses.idQCM, TableTousLesReponses.num\n    ) AS TableNombreReponsesCorrectes NATURAL JOIN (\n        SELECT idQCM, num, nomQCM, nomMatiere, COUNT(*) AS nombreQuestions\n        FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant\n        WHERE publie = true\n        GROUP BY idQCM, num\n    ) AS TableNombreQuestions
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `tablenombrereponsescorrectes`.`idQCM` AS `idQCM`,`tablenombrereponsescorrectes`.`num` AS `num`,`tablenombrequestions`.`nomQCM` AS `nomQCM`,`tablenombrequestions`.`nomMatiere` AS `nomMatiere`,round(((`tablenombrereponsescorrectes`.`nombreReponsesCorrectes` / `tablenombrequestions`.`nombreQuestions`) * 20),2) AS `moyenne` from ((select `tabletouslesreponses`.`idQCM` AS `idQCM`,`tabletouslesreponses`.`num` AS `num`,coalesce(`tablenombrereponsescorrectes`.`reponsesCorrectes`,0) AS `nombreReponsesCorrectes` from ((select `petal_db`.`reponsedeetudiant`.`idQuestion` AS `idQuestion`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`reponsedeetudiant`.`reponseChoisie` AS `reponseChoisie`,`petal_db`.`question`.`intitulé` AS `intitulé`,`petal_db`.`question`.`image` AS `image`,`petal_db`.`question`.`reponseALaQuestion` AS `reponseALaQuestion`,`petal_db`.`question`.`choix1` AS `choix1`,`petal_db`.`question`.`choix2` AS `choix2`,`petal_db`.`question`.`choix3` AS `choix3`,`petal_db`.`question`.`idQCM` AS `idQCM` from (`petal_db`.`reponsedeetudiant` join `petal_db`.`question` on((`petal_db`.`reponsedeetudiant`.`idQuestion` = `petal_db`.`question`.`idQuestion`)))) `tabletouslesreponses` left join (select `petal_db`.`question`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,count(0) AS `reponsesCorrectes` from (`petal_db`.`reponsedeetudiant` join `petal_db`.`question` on((`petal_db`.`reponsedeetudiant`.`idQuestion` = `petal_db`.`question`.`idQuestion`))) where (`petal_db`.`question`.`reponseALaQuestion` = `petal_db`.`reponsedeetudiant`.`reponseChoisie`) group by `petal_db`.`question`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrereponsescorrectes` on(((`tabletouslesreponses`.`idQCM` = `tablenombrereponsescorrectes`.`idQCM`) and (`tabletouslesreponses`.`num` = `tablenombrereponsescorrectes`.`num`)))) group by `tabletouslesreponses`.`idQCM`,`tabletouslesreponses`.`num`) `tablenombrereponsescorrectes` join (select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`reponsedeetudiant`.`num` AS `num`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere`,count(0) AS `nombreQuestions` from ((`petal_db`.`qcm` join `petal_db`.`question` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`question`.`idQCM`))) join `petal_db`.`reponsedeetudiant` on((`petal_db`.`question`.`idQuestion` = `petal_db`.`reponsedeetudiant`.`idQuestion`))) where (`petal_db`.`qcm`.`publie` = TRUE) group by `petal_db`.`qcm`.`idQCM`,`petal_db`.`reponsedeetudiant`.`num`) `tablenombrequestions` on(((`tablenombrereponsescorrectes`.`idQCM` = `tablenombrequestions`.`idQCM`) and (`tablenombrereponsescorrectes`.`num` = `tablenombrequestions`.`num`))))
