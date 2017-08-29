<?php

namespace Deployer;

$host = 'host_ip';
$deploy_path = '/var/www/symfony';
$user = 'arthur';

host('dev')
    ->hostname($host)
    ->stage('dev')
    ->set('symfony_env', 'dev')
    ->user($user)
    ->set('clear_paths', ['web/config.php'])
    ->set('deploy_path', $deploy_path)
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --optimize-autoloader');

host('test')
    ->hostname($host)
    ->stage('test')
    ->set('symfony_env', 'test')
    ->user($user)
    ->set('deploy_path', $deploy_path);

host('prod')
    ->hostname($host)
    ->stage('prod')
    ->set('symfony_env', 'prod')
    ->user($user)
    ->set('deploy_path', $deploy_path)
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-dev --optimize-autoloader'); // on first deployment
