::Version 1.0
@ECHO OFF
cd "%~dp0"
chcp 65001

echo Version 1.0
echo.
echo Déplace et renomme le fichier "pre-commit.hook" vers ".git\hooks\pre-commit"
xcopy /Y /F "pre-commit.hook" ".git\hooks\pre-commit\"
echo OK
TIMEOUT 3
