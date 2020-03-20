#!/bin/sh

echo -e "\n### Requirement ###"
echo -e "Project, database and sql file name need to be the same\n"

read -p "Press enter to continue or ctrl+c to quit"

echo -e "\nChoose your project, database and sql file name"
read name

echo -e "\nChoose your OS [0]:\n0: LAMP\n1: MAMP"
read os
# Set default value
os=${os:-0}

##########
##########
echo -e "\n---SQL CONFIGURATION---"
##########
##########

if [ $os -eq 0 ]; then 
	echo -e "\nDB_HOST [localhost]:"
	read host
	host=${host:-localhost}

	echo -e "\nDB_USER [root]:"
	read user
	user=${user:-root}

	echo -e "\nDB_PWD [root]:"
	read -s pwd
	pwd=${pwd:-root}

	MYSQL="mysql --host=$host -u$user -p$pwd"
	$MYSQL -e "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
	$MYSQL $name < $name.sql
	
elif [ $os -eq 1 ]; then
	host="localhost"

	user="root"
	pwd="root"

	MYSQL="/Applications/MAMP/Library/bin/mysql --host=$host -u$user -p$pwd"
	$MYSQL -e "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
	$MYSQL $name < $name.sql
fi

echo -e "\nBDD created and data imported"

##########
##########
echo -e "\n---PHP CONFIGURATION---"
##########
##########

touch config.php
cat > config.php << EOF
<?php

	define('DB_HOST',    '$host');
	define('DB_NAME',    '$name');
	define('DB_USER',    '$user');
	define('DB_PWD',     '$pwd');
EOF

echo -e "\nconfig/config.php created"

##########
##########
echo -e "\n---RIGHTS CONFIGURATION---"
##########
##########

if [ $os -eq 0 ]; then
	chown -R www-data:www-data /var/www/$name

	find /var/www/$name -type d -exec chmod 750 {} \;
	find /var/www/$name -type f -exec chmod 640 {} \;

elif [ $os -eq 1 ]; then
	echo -e "\nNo configuration needed"
fi

echo -e "\nRIGHTS done"

##########
##########
# echo -e "\n---FOR THIS PROJECT---"
##########
##########