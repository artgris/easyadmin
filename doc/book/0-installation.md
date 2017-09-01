Chapter 0. Installation
=======================


### Clone 
```bash
    $ git clone git@github.com:artgris/easyadmin.git
    $ cd easyadmin
    $ composer install
```

```bash
cp hosts.php.dist hosts.php
```

    #hosts.php:
    
    $host = 'host_ip';
    $deploy_path = '/var/www/symfony';
    $user = 'arthur';


    #deploy.php
    set('repository', 'git@github.com:artgris/easyadmin.git');

http://nux.net/secret


```bash
    $ dep deploy dev
    $ dep d:s:u dev
    $ dep app:users:populate dev
```