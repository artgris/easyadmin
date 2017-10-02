How To Deploy a Symfony Application on DigitalOcean with Deployer
=================================================================


### Create LAMP droplet

First, create a [LAMP on 16.04 Droplet](https://www.digitalocean.com/products/one-click-apps/lamp/)
and add your SSH key `cat ~/.ssh/id_rsa.pub`

### Server configuration

Start a ssh connection :

```bash
$ ssh root@ip
```
#### Set up Locale

```bash   
$ sudo -i 
$ export LANGUAGE=en_US.UTF-8
$ echo 'LANGUAGE="en_US.UTF-8"' >> /etc/default/locale
$ echo 'LC_ALL="en_US.UTF-8"' >> /etc/default/locale
```    

#### Set up Timezone if needed
`$ timedatectl set-timezone 'Europe/Paris'`


#### Install Additional PHP Extensions + unzip

```bash
$ sudo apt-get update
$ sudo apt-get install php-intl php-zip php-mysql php-curl php-gd php-mbstring php-mcrypt php-xml php-xmlrpc unzip
```   
#### Enable pdo_mysql

```bash
$ sudo phpenmod pdo_mysql
```

#### Create a Sudo User

```bash
$ sudo adduser arthur
$ sudo gpasswd -a arthur sudo
```    
#### Set Up SSH Keys
   
- Active Password Authentification :

```bash
$ sudo vi /etc/ssh/sshd_config
```    
    And replace `PasswordAuthentication no` with `PasswordAuthentication yes`
    
- Restart sshd 
   
```bash            
$ sudo service sshd restart    
$ exit
```
- Copy the public key (from your machine)
```bash
$ ssh-copy-id arthur@ip
```
    
- Try to logging
```bash
$ ssh arthur@ip
```
    
- replace `PasswordAuthentication yes` with `PasswordAuthentication no` and `$ sudo service sshd restart`

#### Configure Mysql

```bash
$ cat /root/.digitalocean_password
$ sudo mysql_secure_installation
```   
Answers :
    
    - Would you like to setup VALIDATE PASSWORD plugin?: y
    - Password validation policy: 2
    - Change the password for root: n
    - Remove anonymous users?: y
    - Disallow root login remotely?: y
    - Remove test database and access to it?: y
    - Reload privilege tables now?: y
 
Generate strong passwords (useful in next step)

```bash
$ apg -a 1 -m 10 -x 10
```
Create a new database and user

```bash
$ sudo cat /root/.digitalocean_password   
$ sudo mysql -u root -p
$ mysql> CREATE DATABASE db_symfony DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
$ mysql> GRANT ALL ON db_symfony.* TO 'db_symfony_user'@'localhost' IDENTIFIED BY 'a_strong_password';
$ mysql> FLUSH PRIVILEGES;
$ mysql> EXIT;
``` 
#### Configure the Symfony Directory

```bash 
$ sudo mkdir /var/www/symfony
$ sudo chown arthur:arthur /var/www/symfony
```

#### Configure Apache VirtualHost [(Symfony Doc)](http://symfony.com/doc/current/setup/web_server_configuration.html)

```bash 
$ sudo vi /etc/apache2/sites-available/symfony.conf
``` 
The minimum configuration : 
```apache    
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
```          
####  Enable/disable apache2 site 
```bash          
$ sudo a2dissite 000-default.conf
$ sudo a2ensite symfony.conf
$ sudo service apache2 reload 
```    
#### Enable the Rewrite Module
 ```bash 
$ sudo a2enmod rewrite
$ sudo service apache2 restart
```   
   
#### Restrict Apache Information Leakage.

```bash 
$ sudo vi /etc/apache2/conf-available/security.conf 
```    
    
Edit the following lines and save :

```apache       
ServerTokens Prod
ServerSignature Off
TraceEnable Off
```   
Restart Apache

```bash 
sudo service apache2 restart
``` 

### Set up deployer 

#### Edit deploy.php

```php
set('repository', 'git@github.com:...');
```

#### Copy hosts.php.dist to hosts.php

```bash
cp hosts.php.dist hosts.php
```

#### Edit the following variables

```php
$host = 'host_ip';
$deploy_path = '/var/www/symfony';
$user = 'arthur';
```

#### Generate a symfony token (useful for the next step)

```bash
$ apg -a 1 -M nl -m 40 -x 40
or
$ openssl rand -hex 20 
or 
$ php -r "echo hash('sha1', uniqid(mt_rand(), true));"
or
$ php -r "echo  bin2hex(random_bytes(23));"
or
$ php -r "echo hash('sha1', openssl_random_pseudo_bytes(23));" #openssl required
```

#### Deploy commands

```bash
$ dep deploy dev
$ dep symfony_requirements dev # Checking Requirements
$ dep d:s:u dev
$ dep app:users:populate dev
```
