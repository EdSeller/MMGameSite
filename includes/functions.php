<?php

//Includes para mantar site organizado.

    require 'includes/functions_mall.php';
    require 'includes/functions_painel.php';
    require 'includes/functions_site.php';

//Classes usada para buscar dados da conta

class contagroup {

    private $nome;
    private $usuario;
    private $email;
    private $data;
    private $lc;

    public function __construct($nome, $usuario, $email, $data, $lc, $id) {
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->data = $data;
        $this->lc = $lc;
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getEmail(){
        echo $this->email;
    }

    public function getData(){
        echo $this->data;
    }

    public function getLc(){
        return $this->lc;
    }

    public function getId(){
        return $this->id;
    }

}

//Mostra o nome do Site

function site_name() {
    echo config('name');
}

//Mostra a url do Site

function site_url() {
    echo config('site_url');
}

// Mostra a versao do Site

function site_version() {
    echo config('version');
}

// Seleciona o TimeZone do site e formato de horario exibido

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

//Mostra o titulo da pagina com base no link

function page_title() {
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';
    echo ucwords(str_replace('-', ' ', $page));
}

//Conexao Banco de Dados

function db_connect_member(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME_MEMBER . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

function db_connect_s_data(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME_S_DATA . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

function db_connect_web_data(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME_WEB_DATA . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

function db_connect_web_account(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME_WEB_ACCOUNT . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

function db_connect_gamedata(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME_GAMEDATA . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

//Usar para pegar subdominio do site

function initSelect() {
    $url = $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($url);
    $host = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain = $host[0];
    return $subdomain;
}

//Inicia todo template do Site

function init() {
  $init = initSelect();
    if ($init == "mall") {
      require config('template_path_mall') . '/template.php';
    } elseif ($init == "painel") {
       require config('template_path_painel') . '/template.php';
    } elseif ($init == "registro"){
      require config('template_path_registro') . '/template.php';
    } else {
      require config('template_path_site') . '/template.php';
    }
}

// Seleciona function para mostrar o conteudo da pagina

function page_content() {
  $init = initSelect();
    if ($init == "mall") {
      page_content_mall();
    } elseif ($init == "painel") {
      page_content_painel();
    } else {
      page_content_site();
    }
}

?>