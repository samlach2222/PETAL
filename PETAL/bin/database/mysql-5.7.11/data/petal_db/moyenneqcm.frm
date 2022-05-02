TYPE=VIEW
query=select `resultatetudiant`.`idQCM` AS `idQCM`,`resultatetudiant`.`nomQCM` AS `nomQCM`,`resultatetudiant`.`nomMatiere` AS `nomMatiere`,round((sum(`resultatetudiant`.`moyenne`) / count(`resultatetudiant`.`moyenne`)),2) AS `moyenne` from `petal_db`.`resultatetudiant` group by `resultatetudiant`.`idQCM`
md5=add259fb9a67f522097246f0271b7acd
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-05-02 16:15:07
create-version=1
source=SELECT idQCM, nomQCM, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne\n    FROM resultatetudiant\n    GROUP BY idQCM
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `resultatetudiant`.`idQCM` AS `idQCM`,`resultatetudiant`.`nomQCM` AS `nomQCM`,`resultatetudiant`.`nomMatiere` AS `nomMatiere`,round((sum(`resultatetudiant`.`moyenne`) / count(`resultatetudiant`.`moyenne`)),2) AS `moyenne` from `petal_db`.`resultatetudiant` group by `resultatetudiant`.`idQCM`
