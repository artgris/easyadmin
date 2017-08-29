<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony3.php';
require 'hosts.php';

// Configuration
set('repository', 'git@github.com:artgris/easyadmin.git');
set('keep_releases', 3);
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('allow_anonymous_stats', false);

add('shared_dirs', ['web/uploads', 'app/Resources/translations']);
add('writable_dirs', ['web/uploads', 'app/Resources/translations']);

// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

before('deploy:vendors', 'deploy:build-parameters');


// on first deployment
task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}} && {{bin/composer}} {{composer_options}}', ['tty' => true]);
});




// Migrate database before symlink new release.
//before('deploy:symlink', 'database:migrate');

task('fixtures:load', function () {
    run('{{bin/php}} {{bin/console}} doctrine:fixtures:load -n');
    write('Fixtures done!');
})->desc('Run fixtures');

task('app:users:populate', function () {
    run('{{bin/php}} {{bin/console}} app:users:populate');
    write('Creation of admin users was successfully completed');
})->desc('Create admin users');
