<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony3.php';

// Configuration
set('repository', 'git@gitlab.com:artgris/easyadmin.git');

$host = 'IP';
$deploy_path = '/var/www/symfony/';
$user = "arthur";

set('keep_releases', 3);
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('allow_anonymous_stats', false);

add('shared_dirs', ['web/uploads', 'app/Resources/translations']);
add('writable_dirs', ['web/uploads', 'app/Resources/translations']);

host('dev')
    ->hostname($host)
    ->stage('dev')
    ->set('env', 'dev')
    ->user($user)
    ->set('clear_paths', ['web/config.php'])
    ->set('deploy_path',$deploy_path)
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

host('test')
    ->hostname($host)
    ->stage('test')
    ->user($user)
    ->set('deploy_path',$deploy_path);

host('prod')
    ->hostname($host)
    ->stage('prod')
    ->user($user)
    ->set('deploy_path',$deploy_path);

// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');

task('fixtures:load', function () use ($deploy_path) {
    run('{{bin/php}} {{bin/console}} doctrine:fixtures:load -n');
    write('Fixtures done!');
})->desc('Run fixtures');

task('app:users:populate', function () use ($deploy_path) {
    run('{{bin/php}} {{bin/console}} app:users:populate');
    write('Creation of admin users was successfully completed');
})->desc('Create admin users');

