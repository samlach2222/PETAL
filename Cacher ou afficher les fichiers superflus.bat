@ECHO OFF
cd "%~dp0"
chcp 65001
SET gitDesktopPath="%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe"

echo.
::Si git existe dans le path, l'utiliser
::Sinon tente d'utiliser git dans les dossiers de GitHub Desktop
WHERE /Q git
IF %ERRORLEVEL% EQU 0 (
	GOTO git-path
) ELSE (
	IF EXIST %gitDesktopPath% (
		GOTO git-github-desktop
	) ELSE (
		GOTO pas-git
	)
)

:git-path
git ls-files -v "PETAL/bin/database/mysql-5.7.11/data/ibdata1" | find "h" > nul
IF %ERRORLEVEL% EQU 0 (
	REM Il faut afficher
	REM Affiche tous les fichiers dans PETAL
	git ls-files "PETAL/" | git update-index --no-assume-unchanged --stdin
	echo Fichiers affichés !
) ELSE (
	REM Il faut cacher
	REM Cache tous les fichiers dans PETAL
	git ls-files "PETAL/" | git update-index --assume-unchanged --stdin
	::Réaffiche les fichiers utiles dans PETAL
	git ls-files "PETAL/www/" | git update-index --no-assume-unchanged --stdin
	git ls-files "PETAL/bin/database/mysql-5.7.11/data/petal_db/" | git update-index --no-assume-unchanged --stdin
	echo Fichiers cachés !
)
GOTO END

:git-github-desktop
%gitDesktopPath% ls-files -v "PETAL/bin/database/mysql-5.7.11/data/ibdata1" | find "h" > nul
IF %ERRORLEVEL% EQU 0 (
	REM Il faut afficher
	REM Affiche tous les fichiers dans PETAL
	%gitDesktopPath% ls-files "PETAL/" | %gitDesktopPath% update-index --no-assume-unchanged --stdin
	echo Fichiers affichés !
) ELSE (
	REM Il faut cacher
	REM Cache tous les fichiers dans PETAL
	%gitDesktopPath% ls-files "PETAL/" | %gitDesktopPath% update-index --assume-unchanged --stdin
	::Réaffiche les fichiers utiles dans PETAL
	%gitDesktopPath% ls-files "PETAL/www/" | %gitDesktopPath% update-index --no-assume-unchanged --stdin
	%gitDesktopPath% ls-files "PETAL/bin/database/mysql-5.7.11/data/petal_db/" | %gitDesktopPath% update-index --no-assume-unchanged --stdin
	echo Fichiers cachés !
)
GOTO END


:pas-git
echo git n'a pas été trouvé ni dans le path, ni à l'emplacement %gitDesktopPath%
:END
TIMEOUT 3
