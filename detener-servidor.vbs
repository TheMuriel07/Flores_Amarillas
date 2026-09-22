Option Explicit

Dim WshShell
Set WshShell = CreateObject("WScript.Shell")
WshShell.CurrentDirectory = "C:\Users\USUARIO\Documents\flores-amarillas"
WshShell.Run "taskkill /F /IM php.exe", 0, True
Set WshShell = Nothing