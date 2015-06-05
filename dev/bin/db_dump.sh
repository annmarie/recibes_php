DBH=172.12.12.12
DBU=root
DBP=root
DBN=recibes
FN=recibesdb.sql

mysqldump -h $DBH -u $DBU -p$DBP -c --add-drop-table $DBN > $FN

