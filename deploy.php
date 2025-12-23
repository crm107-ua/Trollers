<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';
require 'contrib/npm.php';

set('application', 'Trollers');
set('repository', 'https://github.com/crm107-ua/Trollers.git');
set('branch', 'master');

set('php_fpm_version', '8.5');

set('bin/php', '/usr/bin/php');
set('bin/composer', '{{bin/php}} /usr/local/bin/composer');

add('shared_dirs', ['public/images', 'public/archivos']);

add('writable_dirs', [
    'public/images/fotos',
    'public/images/perfiles',
    'public/images/mw3',
    'public/images/stories',
]);

host('192.168.50.20')
    ->set('remote_user', 'deploy')
    ->set('identity_file', '/Users/carlosrobles/deploy')
    ->set('deploy_path', '/var/www/html/trollers');

task('deploy', [
    'deploy:prepare',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:view:cache',
    'artisan:config:cache',
    'deploy:composer_install',
    'deploy:publish',
]);

task('deploy:composer_install', function () {
    run('cd {{release_path}} && {{bin/composer}} install --no-dev --optimize-autoloader');
});

after('deploy:failed', 'deploy:unlock');
