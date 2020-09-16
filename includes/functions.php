<?php

//Inicia todo template do Site

function init() {
    require config('template_path') . '/template.php';
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

// Mostra o conteudo da pagina

function page_content() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path') . '/' . $page . '.php';
    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path') . '/404.php';
    }
    include_once($path);
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

//Donos do Castelo

function siege_magirita (){
  $PDO = db_connect_gamedata();
  $sql = "SELECT * FROM u_CastleWarInfo WHERE zone_idx = '101'";
  $result = $PDO->query($sql);
  $guild = $result->fetch(PDO::FETCH_ASSOC);
  echo  $guild["guild_name"];
}

function siege_mekrita (){
  $PDO = db_connect_gamedata();
  $sql = "SELECT * FROM u_CastleWarInfo WHERE zone_idx = '102'";
  $result = $PDO->query($sql);
  $guild = $result->fetch(PDO::FETCH_ASSOC);
  echo  $guild["guild_name"];
}

//Mini ranking

function mini_ranking (){
  $PDO = db_connect_gamedata();
  $sql = "SELECT name, baselevel FROM u_hero WHERE class <> '80' ORDER BY baselevel Desc Limit 6";
  $result = $PDO->query($sql);
  $guild = $result->fetchAll();
  $i = 1;
  echo '<div class="minibug"></div>';
  echo '<table width="153" height="0" border="0">';
  foreach($guild as $row) {
  echo '<tr>
    <td width="0" height="0" align="center"><div class="fonte">'.  $i++ . '</div></td>
    <td width="106"><div class="fonte">'. $row["name"] .'</div></td>
    <td width="20"><div class="fonte">'. $row["baselevel"] .'</div></td>
    <tr>';
  }
  echo '</table>';
}

//Slide do Shop na pagina inicial

function slide_shop (){
  $PDO = db_connect_web_data();
  $sql = "SELECT * FROM shopb ORDER BY rand() LIMIT 1";
  $result = $PDO->query($sql);
  $shop = $result->fetchAll(PDO::FETCH_ASSOC);
  echo '<div class="slidea9"><a href="/mixmall/home"><img src="/imagens/site/img43.png"></a></div>';
  foreach($shop as $row) {
    echo '<div class="slidea4">
    <div class="slidea5">
    <img src="/imagens/shop/'. $row["ItemId"] .'.gif"></div>
    <div class="slidea8">
    <div class="slidea6">Intem recomendado</div>
    <div class="slidea7">
    <div class="slideablack"> '. $row["Nome"] .' | <img src="/imagens/site/icon_money.png">'.
    $row["Lc"] .'LC</div><div class="slideawhite">- Limite de uso:'. $row["Tempo"] .'
    </br>- Level requerido: '. $row["Level"] .' </br>- Quantidade: '. $row["Quantidade"] .'
    </div></div>
    </div>
    </div>';
  }
}

//Tabelas de noticias da pagina inicial

function patch_notes () {
  $PDO = db_connect_web_data();
  $sql = "SELECT * FROM news WHERE Tabela = 'patch_notes' ORDER BY id Desc Limit 5";
  $result = $PDO->query($sql);
  $patch = $result->fetchAll(PDO::FETCH_ASSOC);
  $i = 1;
  echo '<table width="460" border="0">';
  foreach($patch as $row) {
  echo '<tr width="440">
  <td>
  <a class="classe2link2" href="popnew.php?noticia='. $row["Id"] .'">
  <div class="news5">';
  if ($i == 1){
    echo '<img src="imagens/site/img17.png">';
  }
  echo $row["Titulo"] .'</div>
  <td>
  <div class="news6">'. $row["Data"] .'</div>
  </td>
  </tr>';
  $i++;
  }
  echo '</table>';
}

//Tabela eventos da Pagina inicial

function eventos () {
  $PDO = db_connect_web_data();
  $sql = "SELECT * FROM news WHERE Tabela = 'eventos' ORDER BY id Desc Limit 5";
  $result = $PDO->query($sql);
  $eventos = $result->fetchAll(PDO::FETCH_ASSOC);
  $i = 1;
  echo '<table width="460" border="0">';
  foreach($eventos as $row) {
  echo '<tr width="440">
  <td>
  <a class="classe2link2" href="popnew.php?noticia='. $row["Id"] .'">
  <div class="news5">';
  if ($i == 1){
    echo '<img src="imagens/site/img17.png">';
  }
  echo $row["Titulo"] .'</div>
  <td>
  <div class="news6">'. $row["Data"] .'</div>
  </td>
  </td>
  </tr>';
  $i++;
  }
  echo '</table>';
}

//Script de cadastro no banco de dados

function registrar($nome, $usuario, $senha, $email, $data) {
    $pdo = db_connect_member();
    $cmd = $pdo->prepare("select id_idx from Player where PlayerID  = :usuario");
      $cmd->bindValue(":usuario",$usuario);
      $cmd->execute();
      if($cmd->rowCount() > 0) {
        echo "<script>alert('Nome de Usuario esta em uso.');history.back(); </script>" ;
        exit;
      } 
    $cmd = $pdo->prepare("select id_idx from Player where email = :email");
      $cmd->bindValue(":email",$email);
      $cmd->execute();
      if($cmd->rowCount() > 0) {
        echo "<script>alert('Endereço de e-mail esta em uso.');history.back();</script>" ;
        exit;
      }
   $cmd = $pdo->prepare("INSERT into Player (Name, PlayerID, Passwd, data, Email) VALUES (:nome, :usuario, :senha, :data, :email) ");
    $cmd->bindValue(":nome",$nome);
     $cmd->bindValue(":usuario",$usuario);
     $cmd->bindValue(":senha",$senha);
     $cmd->bindValue(":data",$data);
     $cmd->bindValue(":email",$email);
      $cmd->execute();
      echo "<script>alert('Registrado com sucesso.');history.back();</script>" ;
      exit;
}

function login($usuario, $senha){
   $pdo = db_connect_member();
   $cmd = $pdo->prepare("select id_idx from Player where PlayerID = :usuario AND  Passwd = :senha");
      $cmd->bindValue(":usuario",$usuario);
      $cmd->bindValue(":senha",$senha);
      $cmd->execute();
      if($cmd->rowCount() > 0) {
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      echo "<script>alert('Login efetuado com sucesso.'); window.location.href='painel'; </script>" ;
      exit;
    }else{
    unset ($_SESSION['usuario']);
    unset ($_SESSION['senha']);
      echo "<script>alert('Usuario ou senha incorretos.');history.back();</script>" ;
      exit;
  }
}

function logout(){
  unset ($_SESSION['usuario']);
  unset ($_SESSION['senha']);
  echo "<script>alert('Login efetuado com sucesso.'); window.location.href='home'; </script>" ;
  exit;
    }
?>