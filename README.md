# Quick and Dirty Setup WordPress Plain Theme

## Installation

- Clone repository
- Execute ```./setup.sh projectname```
- Projectname should only contain lowercase letters and dashes! Script is not checking for it...
- Execute ```docker compose up``` or ```docker compose up -d```

## Get a DB dump

- Get the database container id with ```docker ps```
- Execute ```docker exec -i <container-id> mysqldump -uwordpress -pwordpress wordpress > your_db_export.sql```

## Known bugs

__403 Forbiden after stoping and starting the project__

- Get id of wp container with ```docker ps``` 
- Ssh into the wp container via ```docker exec -it <container-id> /bin/bash```
- Cd into wordpress source location ```cd /usr/src/wordpress/```
- Copy files manually with the ultra ugly command: ```cp index.php wp-activate.php wp-comments-post.php wp-links-opml.php wp-mail.php wp-trackback.php license.txt wp-cron.php wp-load.php wp-settings.php xmlrpc.php readme.html wp-blog-header.php wp-login.php wp-signup.php /var/www/html```
- Cd into server location ```cd /var/www/html```
- Change permissions ```chown www-data:www-data index.php wp-activate.php wp-comments-post.php wp-links-opml.php wp-mail.php wp-trackback.php license.txt wp-cron.php wp-load.php wp-settings.php xmlrpc.php readme.html wp-blog-header.php wp-login.php wp-signup.php```
- Puke 