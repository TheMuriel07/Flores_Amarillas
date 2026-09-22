Option Explicit

Dim WshShell
Set WshShell = CreateObject("WScript.Shell")
WshShell.CurrentDirectory = "C:\Users\USUARIO\Documents\flores-amarillas"
WshShell.Run "cmd /c php artisan serve --host=0.0.0.0 --port=8000 >> servidor.log 2>&1", 0, False
Set WshShell = Nothing