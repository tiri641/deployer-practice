<?php
namespace Deployer;

require 'recipe/common.php';

// Config
set('repository', 'git@github.com:tiri641/deployer-practice.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('18.183.159.210')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/my-app')
    ->set('forward_agent', true);

// Tasks
task('maintenance:on', function () {
    run('touch {{current_path}}/maintenance.flag');
});

task('maintenance:off', function () {
    run('rm -f {{current_path}}/maintenance.flag');
});

// Hooks
after('deploy:failed', 'deploy:unlock');