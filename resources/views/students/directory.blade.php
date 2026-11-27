# Save each view from clipboard in PowerShell, then commit and push to main
Get-Clipboard | Set-Content -Path "resources\views\students\directory.blade.php" -Encoding UTF8
# (copy settings.blade.php to clipboard, then run:)
Get-Clipboard | Set-Content -Path "resources\views\students\settings.blade.php" -Encoding UTF8
# (copy welcome.blade.php to clipboard, then run:)
Get-Clipboard | Set-Content -Path "resources\views\welcome.blade.php" -Encoding UTF8

git add resources/views/students/directory.blade.php resources/views/students/settings.blade.php resources/views/welcome.blade.php app/Http/Controllers/StudentController.php routes/web.php
git commit -m "Phase 4: update directory, settings, and welcome views"
git push origin main
