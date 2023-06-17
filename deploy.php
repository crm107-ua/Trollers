<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Trollers');

// Project repository
set('repository', 'https://gitlab.com/wanikoko/trollers.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', ["public/images","public/archivos"]);

// Writable dirs by web server 
add('writable_dirs', 
    [
        "public/images/fotos",
        "public/images/perfiles",
        "public/images/mw3"
    ]);

// Establecemos el path donde debe ser desplegado nuestra aplicación

host('46.183.113.180')
    ->user('deploy') 
    ->identityFile('~/.ssh/id_rsa') 
    ->set('deploy_path', '/var/www/trollers/html');

// Podemos definir diferentes tareas que se ejecutarán durante,
// antes o después de cada despliegue

task('build', function () {
    run('cd {{release_path}} && build');
});

// Si el despliegue falla, automáticamente hacemos un unlock y dejamos la versión anterior.

after('deploy:failed', 'deploy:unlock');

// ------------------------------------------------------------------

// Ejecutamos la migramos la base de datos justo antes de llevar a cabo el enlace simbólico a la nueva versión.

// before('deploy:symlink', 'artisan:migrate');  Se ha realizado mediante exportacion sql manual

// ------------------------------------------------------------------


// Definimos las tarea de creacion del .env, la cual solo se llevara a cabo en el primer despleigue

task('upload:env',function(){
    upload('.env','{{deploy_path}}/shared/.env');
})->desc('Environment setup');

// Definimos las tareas que queremos que se ejecuten cuando llevemos a cabo un deploy de la aplicación.

desc('Deploy your project');
task('deploy',[
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

// Reiniciamos el servicio php-fpm al final del proceso.

# Declaramos la tarea
task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php7.2-fpm restart');
});
# Reload:php-fpm se ejecuta despues del despliegue
after('deploy', 'reload:php-fpm');

// Reiniciamos config clear en artisan.

# Declaramos la tarea
task('config:clear', function () {
    run('cd .. && cd .. && cd var/www/trollers/html/current && php artisan config:clear');
});
# config:clear se ejecuta despues de reload:php-fpm
after('reload:php-fpm', 'config:clear');




