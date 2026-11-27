# 1. Save your updated routes/web.php from clipboard (or edit routes\web.php directly in VS Code)
Get-Clipboard | Set-Content -Path "routes\web.php" -Encoding UTF8

# 2. Check modified files, stage, commit, and push to main
git status
git add routes/web.php
git commit -m "Update routes/web.php for workspace routes, auth, and CRUD"
git push origin main
