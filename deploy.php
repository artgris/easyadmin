<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony3.php';

// Configuration

set('repository', 'git@github.com:...');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', ['web/upload']);
add('shared_dirs', []);
add('writable_dirs', []);
set('allow_anonymous_stats', false);

host('host')
    ->user('user')
    ->stage('production')
    ->set('branch', 'feat/deployer')
    ->set('deploy_path', '/var/www/...');

// Tasks

task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});


desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    //etc/sudoers: arthur ALL=NOPASSWD:/bin/service apache2 restart
//    run('sudo systemctl restart php-fpm.service');
    run('sudo service apache2 restart');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
