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

//Checa insformaçoes de registro

 if(isset($_POST['nome'])) { 
  $nome = ($_POST['nome']); 
  $usuario = ($_POST['usuario']); 
  $senha = ($_POST['senha']); 
  $senhaconf = ($_POST['senhaconf']); 
  $email = ($_POST['email']); 
  $emailconf = ($_POST['emailconf']);
  $data = ($_POST['data']); 
  $term = ($_POST['term']); 
if (!empty($nome) && !empty($usuario) && !empty($senha) && !empty($email) && !empty($data) && !empty($senhaconf) && !empty($emailconf)) {
if ($senha <> $senhaconf) {
   echo "<script>alert('Senhas nao coincidem.'); history.back();</script>" ;
   exit;
} elseif ($email <> $emailconf) {
   echo "<script>alert('Endereços de e-mail nao coincidem.'); history.back();</script>" ;
   exit; 
} elseif ((strlen($nome) < 5) || (strlen($nome) > 50)) {
  echo "<script>alert('O campo Nome Completo precisa conter de 5 a 50 caracteres.'); history.back();</script>" ;
  exit;
} elseif ((strlen($usuario) < 5) || (strlen($usuario) > 15)) {
  echo "<script>alert('O campo Usuario precisa conter de 5 a 15 caracteres.'); history.back();</script>" ;
  exit;
} elseif ((strlen($senha) < 10) || (strlen($senha) > 15)) {
  echo "<script>alert('O campo Senha precisa conter de 5 a 15 caracteres.'); history.back();</script>" ;
  exit;
} elseif ((strlen($email) < 8) || (strlen($email) > 50)) {
  echo "<script>alert('O campo E-mail Completo precisa conter de 5 a 50 caracteres.'); history.back();</script>" ;
  exit;
} elseif (strlen($data) <> 10) {
  echo "<script>alert('O campo Data precisa conter 10 caracteres.'); history.back();</script>" ;
  exit;
} elseif ($term <> "checado") {
  echo "<script>alert('Voce precisa aceitar o termos de uso para se registrar.'); history.back();</script>" ;
  exit;
} else {
  $senha = hash( 'sha256',$senha); 
  registrar ($nome, $usuario, $senha, $email, $data);
}
} else {
   echo "<script>alert('Preencha todos os campos para se registrar.'); history.back();</script>" ;
   exit;
}
}

//Faz cadastro no banco de dados

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

//Checa acesso a pagina de login

function doublelogin() {
  if(isset($_SESSION['usuario'])) {
      echo "<script>alert('Voce ja esta logado.'); window.location.href='painel'; </script>" ;
      exit;
  }
}

//Checa as informaçoes de login

if(isset($_POST['login'])) { 
  $usuario = ($_POST['login']); 
  $senha = ($_POST['senha']); 
if (!empty($usuario) && !empty($senha)) {
  if ((strlen($usuario) < 5) || (strlen($usuario) > 15)) {
  echo "<script>alert('O campo Usuario precisa conter de 5 a 15 caracteres.'); history.back();</script>" ;
  exit;
  } elseif ((strlen($senha) < 10) || (strlen($senha) > 15)) {
  echo "<script>alert('O campo Senha precisa conter de 10 a 15 caracteres.'); history.back();</script>" ;
  exit;
  } else {
  $senha = hash( 'sha256',$senha); 
  login ($usuario, $senha);
    } 
  } else {
   echo "<script>alert('Preencha todos os campos para fazer login.'); history.back();</script>" ;
   exit;
}
}

//Efetua login

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

//Get do logout

if(isset($_POST['logout'])) { 
 logout();
}

//Efetua logout

function logout(){
  unset ($_SESSION['usuario']);
  unset ($_SESSION['senha']);
  echo "<script>alert('Logout efetuado com sucesso.'); window.location.href='home'; </script>" ;
  exit;
    }

//Checa acesso as funçoes de painel

function painelp() {
  $usuario = $_SESSION['usuario'];
  $senha = $_SESSION['senha'];
   $pdo = db_connect_member();
   $cmd = $pdo->prepare("select id_idx from Player where PlayerID = :usuario AND  Passwd = :senha");
      $cmd->bindValue(":usuario",$usuario);
      $cmd->bindValue(":senha",$senha);
      $cmd->execute();
      if($cmd->rowCount() > 0) {
      exit;
    } else {
      unset ($_SESSION['usuario']);
      unset ($_SESSION['senha']);
      echo "<script>alert('Voce precisa efetuar login para acessar essa area.'); window.location.href='login'; </script>" ;
      exit;
  }
}

?>