::Version 4.4
@ECHO OFF
cd "%~dp0"
chcp 65001

echo Version 4.4
echo.
echo Déplace et renomme le fichier "pre-commit.hook" vers ".git\hooks\pre-commit"
copy "pre-commit.hook" ".git\hooks\"
move ".git\hooks\pre-commit.hook" ".git\hooks\pre-commit"
echo OK
TIMEOUT 3
