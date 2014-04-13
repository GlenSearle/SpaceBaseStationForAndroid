@echo off

:loop

if exist command.txt (
  type command.txt
  type command.txt >> \\.\com31
  del command.txt
) 


timeout /T 1 >> nul:

goto loop