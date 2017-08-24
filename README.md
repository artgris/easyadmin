easyadmin
=========

Symfony starter project using 
[EasyAdminBundle](https://github.com/javiereguiluz/EasyAdminBundle)

TODO : TUTO

sudo apt-get install unzip php-zip php-mysql php-curl php-gd php-mbstring php-mcrypt php-xml
sudo phpenmod pdo_mysql
adduser arthur
gpasswd -a arthur sudo
vi /etc/ssh/sshd_config => PasswordAuthentication yes
service sshd restart
> local : ssh-copy-id arthur@ip
sudo mkdir /var/www/symfony
sudo chown arthur:arthur /var/www/symfony
> dep deploy dev => failed
vi /var/www/symfony/shared/app/config/parameters.yml 

cat /root/.digitalocean_password   
mysql -u root -p
CREATE DATABASE db_symfony DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
GRANT ALL ON db_symfony.* TO 'db_symfony_user'@'localhost' IDENTIFIED BY 'erfe51f65e';
FLUSH PRIVILEGES;
EXIT;
 
 
sudo vi /etc/apache2/sites-available/symfony.conf
<VirtualHost *:80>
    #ServerName domain.tld
    #ServerAlias www.domain.tld

    DocumentRoot /var/www/symfony/current/web
    <Directory /var/www/symfony/current/web>
        AllowOverride All
        Order Allow,Deny
        Allow from All
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/symfony_error.log
    CustomLog ${APACHE_LOG_DIR}/symfony_access.log combined
</VirtualHost>
 
  sudo a2dissite 000-default.conf
  sudo a2ensite symfony.conf 
  sudo a2enmod rewrite
  sudo service apache2 restart
 
 
a voir php-intl
  
//sudo phpenmod pdo_mysql
 
export LANGUAGE=en_US.UTF-8
echo 'LANGUAGE="en_US.UTF-8"' >> /etc/default/locale
echo 'LC_ALL="en_US.UTF-8"' >> /etc/default/locale

dep app:users:populate dev
