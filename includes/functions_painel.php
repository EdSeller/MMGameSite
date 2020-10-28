<?php 

//Exibe conteudo de painel de admin

function page_content_painel() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path_painel') . '/' . $page . '.php';
    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path_painel') . '/404.php';
    }
    include_once($path);
}

?>