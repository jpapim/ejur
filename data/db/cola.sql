###EXPORTAR WINDOWS
mysqldump -u root -B bdejur -p > C:\xampp\htdocs\ejur\data\db\script_inicial.sql

###IMPORTAR WINDOWS
mysql -u root -p < C:\xampp\htdocs\ejur\data\db\script_inicial.sql


###EXPORTAR LINUX
mysqldump -u root -B bdejur -p > /var/www/html/juridico.acthosti.com.br/data/db/script_inicial.sql


###IMPORTAR LINUX
mysql -u root -p < /var/www/html/juridico.acthosti.com.br/data/db/script_inicial.sql





mysqldump -u root -B bdejur -p > /tmp/script_inicial_backup.sql


C:\xampp\htdocs\ejur\data\db\bkp\script_inicial_backup.sql