<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';
require 'contrib/npm.php';

// Project name
set('application', 'Trollers');

// Project repository
set('repository', 'https://github.com/crm107-ua/Trollers.git');
set('branch', 'main');

// Indicamos la version de php-fpm
set('php_fpm_version', '8.2');

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', ["public/images", "public/archivos"]);

// Writable dirs by web server 
add(
    'writable_dirs',
    [
        "public/images/fotos",
        "public/images/perfiles",
        "public/images/mw3",
        "public/images/stories",
    ]
);

// Indicamos el usuario de despliegue en el servidor
host('trollers.server')
    ->set('remote_user', 'deploy')
    // ->set('port', '4851')
    ->set('identity_file', '~/deploy')
    ->set('deploy_path', '/var/www/html/trollers');

// Tareas del despliegue
task('deploy', [
    'deploy:prepare',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:view:clear',
    'artisan:view:cache',
    'deploy:composer_install',
    'deploy:publish'
]);

task('deploy:composer_install', function () {
    run('cd {{release_path}} && {{bin/composer}} update --optimize-autoloader --no-dev');
});

after('deploy:failed', 'deploy:unlock');