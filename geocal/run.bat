@echo off

:loop

php run.php

if exist command.txt (
  echo "Sending command..."
  type command.txt
  type command.txt >> \\.\com31
  del command.txt
) 

timeout /T 3 >> nul:

goto loop