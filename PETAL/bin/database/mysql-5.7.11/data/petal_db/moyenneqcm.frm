TYPE=VIEW
query=select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,round((sum(`petal_db`.`resultatetudiant`.`noteExamen`) / count(`petal_db`.`resultatetudiant`.`noteExamen`)),2) AS `moyenne`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere` from (`petal_db`.`qcm` join `petal_db`.`resultatetudiant` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`resultatetudiant`.`idQCM`))) group by `petal_db`.`qcm`.`idQCM`
md5=4e29f63b176e1b737e7d24fbff95fafa
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-04-22 14:07:37
create-version=1
source=SELECT idQCM, nomQCM, ROUND(SUM(noteExamen)/COUNT(noteExamen), 2) AS moyenne, nomMatiere\n    FROM QCM NATURAL JOIN ResultatEtudiant\n    GROUP BY idQCM
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `petal_db`.`qcm`.`idQCM` AS `idQCM`,`petal_db`.`qcm`.`nomQCM` AS `nomQCM`,round((sum(`petal_db`.`resultatetudiant`.`noteExamen`) / count(`petal_db`.`resultatetudiant`.`noteExamen`)),2) AS `moyenne`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere` from (`petal_db`.`qcm` join `petal_db`.`resultatetudiant` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`resultatetudiant`.`idQCM`))) group by `petal_db`.`qcm`.`idQCM`
