@ECHO OFF
cd "%~dp0"
chcp 65001

echo.
::Si git existe dans le path, l'utiliser
::Sinon tente d'utiliser git dans les dossiers de GitHub Desktop
WHERE /Q git
IF %ERRORLEVEL% EQU 0 (
	GOTO git-path
) ELSE (
	IF EXIST "%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe" (
		GOTO git-github-desktop
	) ELSE (
		GOTO pas-git
	)
)

:git-path
git ls-files -v "PETAL/bin/database/mysql-5.7.11/data/ibdata1" | find "h" > nul
IF %ERRORLEVEL% EQU 0 (
	::Il faut afficher ibdata1
	git update-index --no-assume-unchanged "PETAL/bin/database/mysql-5.7.11/data/ibdata1"
	echo ibdata1 affiché !
) ELSE (
	::Il faut cacher ibdata1
	git update-index --assume-unchanged "PETAL/bin/database/mysql-5.7.11/data/ibdata1"
	echo ibdata1 caché !
)
GOTO END

:git-github-desktop
"%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe"
 ls-files -v "PETAL/bin/database/mysql-5.7.11/data/ibdata1" | find "h" > nul
IF %ERRORLEVEL% EQU 0 (
	::Il faut afficher ibdata1
	"%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe" update-index --no-assume-unchanged "PETAL/bin/database/mysql-5.7.11/data/ibdata1"
	echo ibdata1 affiché !
) ELSE (
	::Il faut cacher ibdata1
	"%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe" update-index --assume-unchanged "PETAL/bin/database/mysql-5.7.11/data/ibdata1"
	echo ibdata1 caché !
)
GOTO END


:pas-git
echo git n'a pas été trouvé ni dans le path, ni à l'emplacement "%LocalAppData%\GitHubDesktop\app-2.9.12\resources\app\git\cmd\git.exe"
:END
TIMEOUT 3
