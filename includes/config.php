<?php

/**
 * Use para configurar as informaçoes e armazenamento do Site
 *
 * @var string or null
 */
function config($key = '') {
    $config = [
        'name' => 'MixMaster',
        'site_url' => 'http://localhost/',
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'v2.0',
    ];
    return isset($config[$key]) ? $config[$key] : null;
}

//Dados para conexao ao banco de dados MySql
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'password');

//Selcao dos BDs do jogo e site
define('DB_NAME_MEMBER', 'Member');
define('DB_NAME_S_DATA', 'S_Data');
define('DB_NAME_WEB_DATA', 'web_data');
define('DB_NAME_WEB_ACCOUNT', 'Web_Account');
define('DB_NAME_GAMEDATA', 'gamedata');
