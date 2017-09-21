<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony3.php';
require 'hosts.php';

// Configuration
set('repository', 'git@github.com:artgris/easyadmin.git');
set('keep_releases', 3);
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('allow_anonymous_stats', false);

add('shared_dirs', ['web/uploads', 'app/Resources/translations', 'web/cache']);
add('writable_dirs', ['web/uploads', 'app/Resources/translations', 'web/cache']);

// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

before('deploy:vendors', 'deploy:build-parameters');

// on first deployment | https://github.com/deployphp/deployer/issues/126, add tty
task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}} && {{bin/composer}} {{composer_options}}', ['tty' => true]);
});

// Migrate database before symlink new release.
//before('deploy:symlink', 'database:migrate');

// Doctrine commands
task('fixtures:load', function () {
    run('{{bin/php}} {{bin/console}} doctrine:fixtures:load -n');
    write('Fixtures done!');
})->desc('Run fixtures');

// Update database Schema
task('d:s:u', function () {
    run('{{bin/php}} {{bin/console}} d:s:u --force');
    write('d:s:u was successfully completed');
})->desc('d:s:u');

// populate admin data
task('app:users:populate', function () {
    run('{{bin/php}} {{bin/console}} app:users:populate');
    write('Creation of admin users was successfully completed');
})->desc('Create admin users');

// List available commands
task('list', function () {
    run('{{bin/php}} {{bin/console}} list', ['tty' => true]);
});

// Checking Requirements
task('symfony_requirements', function () {
    run('{{bin/php}} {{bin/symfony_requirements}}', ['tty' => true]);
});

// Symfony console bin
set('bin/symfony_requirements', function () {
    return sprintf('{{release_path}}/%s/symfony_requirements', trim(get('bin_dir'), '/'));
});
