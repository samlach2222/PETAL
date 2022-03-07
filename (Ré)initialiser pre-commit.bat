::Version 1.1
@ECHO OFF
cd "%~dp0"
chcp 65001

echo Version 1.1
echo.
echo Déplace et renomme le fichier "pre-commit.hook" vers ".git\hooks\pre-commit"
xcopy /Y /F /I "pre-commit.hook" ".git\hooks\pre-commit"
echo OK
TIMEOUT 3
