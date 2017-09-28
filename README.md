easyadmin
=========

Symfony starter project using:

- [javiereguiluz/easyadmin-bundle](https://github.com/javiereguiluz/EasyAdminBundle)
- [friendsofsymfony/user-bundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
- [jms/translation-bundle](https://github.com/schmittjoh/JMSTranslationBundle)
- [jms/di-extra-bundle](https://github.com/schmittjoh/JMSDiExtraBundle)
- [jms/i18n-routing-bundle](https://github.com/schmittjoh/JMSI18nRoutingBundle)
- [a2lix/translation-form-bundle](https://github.com/javiereguiluz/EasyAdminBundle)
- [knplabs/doctrine-behaviors](https://github.com/KnpLabs/DoctrineBehaviors)
- [arkounay/block-bundle-i18n](https://github.com/Arkounay/BlockI18nBundle)
- [artgris/filemanager-bundle](https://github.com/artgris/FileManagerBundle)
- [artgris/media-bundle](https://github.com/artgris/MediaBundle)
- [ninsuo/symfony-collection](https://github.com/ninsuo/symfony-collection)
- [stof/doctrine-extensions-bundle](https://github.com/stof/StofDoctrineExtensionsBundle)
- [doctrine/doctrine-migrations-bundle](https://github.com/doctrine/DoctrineMigrationsBundle)
- [vich/uploader-bundle](https://github.com/dustin10/VichUploaderBundle)
- [gregwar/image-bundle](https://github.com/Gregwar/ImageBundle)
- [google/apiclient](https://github.com/google/google-api-php-client)

Documentation
-------------

#### Installation

  ```bash
  $ git clone git@github.com:artgris/easyadmin.git
  $ rm -rf .git && git init && git add . && git commit -m "First commit"
  $ git remote add origin git@github.com:...
  $ git push -u origin master
  $ cd easyadmin
  $ composer install
  ```

#### Tutorials

  * [How To Deploy a Symfony Application on DigitalOcean with Deployer](doc/tutorials/digitalocean.md)
  
Front
-----
#### Installation
```
npm install
```

#### Config livereload and webpack

In ``webpack.config.js`` change the proxy property at ``line 38`` :
```
...
proxy: 'yourproject.dev/app_dev.php',
...
```

#### Livereload and compile during dev env
```
npm run dev
```

#### Compile for prod env

Clear the directory ``./web/build`` and push the new files compiled.
```
npm run prod
```

#### Generate icon font

Add svg files in directory ``./front/assets/icons/svg``
The command generate a scss file in ``./front/scss/typography/_iconfont.scss``.
```
npm run iconfont
```