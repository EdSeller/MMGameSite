<?php

//Exibe conteudo de site

function page_content_site() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path_site') . '/' . $page . '.php';
    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path_site') . '/404.php';
    }
    include_once($path);
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
  echo '<div class="slidea9"><a href="mall.site/home"><img src="/imagens/site/img43.png"></a></div>';
  foreach($shop as $row) {
    echo '<div class="slidea4">
    <div class="slidea5">
    <img src="/imagens/shop/'. $row["ItemId"] .'.gif"></div>
    <div class="slidea8">
    <div class="slidea6">Intem recomendado</div>
    <div class="slidea7">
    <div class="slideablack"> '. $row["Nome"] .' | <img src="/imagens/mall/icon_money.png">'.
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
   $cmd = $pdo->prepare("select PlayerID, Passwd from Player where PlayerID = :usuario AND Passwd = :senha Limit 1");
      $cmd->bindValue(":usuario",$usuario);
      $cmd->bindValue(":senha",$senha);
      $cmd->execute();
      if($cmd->rowCount() > 0) {
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      $inforl = conta();
      $_SESSION['id'] = $inforl->getId();
      echo "<script>alert('Login efetuado com sucesso.'); window.location.href='painel'; </script>" ;
      exit;
    }else{
    unset ($_SESSION['usuario']);
    unset ($_SESSION['senha']);
      echo "<script>alert('Usuario ou senha incorretos.');history.back();</script>" ;
      exit;
  }
}

//Efetua logout

function logout(){
  if(isset($_POST['logout'])) { 
  unset ($_SESSION['usuario']);
  unset ($_SESSION['senha']);
  unset ($_SESSION['id']);
  echo "<script>alert('Logout efetuado com sucesso.'); window.location.href='home'; </script>" ;
  exit;
  }
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
    } else {
      unset ($_SESSION['usuario']);
      unset ($_SESSION['senha']);
      echo "<script>alert('Voce precisa efetuar login para acessar essa area.'); window.location.href='login'; </script>" ;
      exit;
   }
}

//Monta Classe com inforçoes da conta. (Nao inclui herois)
 
function conta(){    
      $usuario = $_SESSION['usuario'];
      $senha = $_SESSION['senha'];
      $pdo = db_connect_member();
      $cmd = $pdo->prepare("select Name, PlayerID, Passwd, data, Email, Lc, id_idx from Player where PlayerID = :usuario AND Passwd = :senha");
      $cmd->bindValue(":usuario",$usuario);
      $cmd->bindValue(":senha",$senha);
      $cmd->execute();
      $infor = $cmd->fetchAll(PDO::FETCH_ASSOC);
      foreach($infor as $row) {
          $nome = $row["Name"];
          $usuario =  $row["PlayerID"];
          $email =  $row["data"];
          $data =  $row["Email"];
          $lc =  $row["Lc"];
          $id = $row["id_idx"];
          $infort = new contagroup($nome, $usuario, $email, $data, $lc, $id);
          return $infort;
        }
}

//Constroi a tabela que contem informaçoes da conta. Faz uso da classe montada pela function "tabelaconta".

function tabelaconta (){
      $infort = conta();
      echo'<table border="0" ><tr><td width="152"><strong>Nome:</strong></td><td width="300">';
      echo $infort->getNome();
      echo'</td></tr><tr><td><strong>Usuario:</strong></td><td>';
      echo $infort->getUsuario();
      echo'</td></tr><tr><td><strong>Email:</strong></td><td>';
      $infort->getEmail();
      echo'</td></tr><tr><td><strong>Data de Nascimento:</strong></td><td>';
      $infort->getData();
      echo'</td></tr><tr><td><strong>Lc</strong></td><td>';
      echo $infort->getLc();
      echo'</td></tr></table>';
}

//Monta a tabela de personagens

function tabelaherois () {
      $id = $_SESSION['id'];
      $pdo = db_connect_gamedata();
      $cmd = $pdo->prepare("SELECT id_idx, name, hero_type, baselevel, exp FROM u_hero WHERE id_idx = :id ORDER BY baselevel Desc Limit 3");
      $cmd->bindValue(":id",$id);
      $cmd->execute();
      $herois = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '<table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
                <tr bgcolor="#FFFF99">
                <td width="613px" align="center"><strong>Herois da Conta</strong></tr></tbody></table>
                <table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
                <tbody><tr bgcolor="#FFFF99">
                <td width="240" align="center"><strong>Nick</strong></td>
                <td width="56" align="center"><strong>Heroi</strong></td>
                <td width="56" align="center"><strong>Level</strong></td>
                <td width="240" align="center"><strong>Exp</strong></td></tr>';
      foreach($herois as $row) {
         $table .= '<tr>
              <td align="center">'.$row["name"].'</td>
              <td align="center"><img src="imagens/site/hero/'.$row["hero_type"].'.gif"></td>
              <td align="center">'.$row["baselevel"].'</td>
              <td align="center">'.$row["exp"].'</td>
          </tr>';
      }  
      $table .= '</tbody></table>';
      echo $table;
}

//Monta a tabela de compras recentes

function tabelacompras () {
      $id = $_SESSION['id'];
      $pdo = db_connect_web_data();
      $cmd = $pdo->prepare("SELECT id, data, hora, valor, lc FROM shopl WHERE id_idx = :id ORDER BY id Desc Limit 6");
      $cmd->bindValue(":id",$id);
      $cmd->execute();
      $logs = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '<table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
        <tr bgcolor="#FFFF99">
        <td width="613px" align="center"><strong>Compras Recentes</strong></tr></tbody></table>
        <table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
        <tbody><tr bgcolor="#FFFF99">
        <td width="147" align="center"><strong>Id</strong></td>
        <td width="176" align="center"><strong>Data</strong></td>
        <td width="100" align="center"><strong>Hora</strong></td>
        <td width="76" align="center"><strong>Valor</strong></td>
        <td width="86" align="center"><strong>Lc</strong></td>
        </tr>';
     foreach($logs as $row) {
         $table .= '<tr>
            <td>'.$row["id"].'</td> 
            <td>'.$row["data"].'</td> 
            <td>'.$row["hora"].'</td> 
            <td>'.$row["valor"].'</td> 
            <td>'.$row["lc"].'</td> 
            </tr>';
        }
    $table .= '</tbody></table>';
    echo $table;
}

//Exibe a Tabela de Ranking

function ranking(){
      $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : '1';
      $pdo = db_connect_gamedata();
      $limite = 50;
      $cmd = $pdo->prepare("SELECT * FROM u_hero WHERE class <> 80 ORDER BY baselevel Desc limit 500");
      $cmd->execute();
      $total = $cmd->rowCount(PDO::FETCH_ASSOC);
      $numPaginas = ceil($total / $limite); 
      $rank = ($pagina - 1) * $limite; 
      $cmd = $pdo->prepare("SELECT * FROM u_hero WHERE class <> 80 ORDER BY baselevel Desc limit :inicio , :limite");
      $cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
      $cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
      $cmd->execute();
      $herois = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '
          <div align="center">
          <table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
          <tbody><tr bgcolor="#FFFF99">
          <td width="77" align="center"><strong>Rank</strong></td>
          <td width="353" align="center"><strong>Nick</strong></td>
          <td width="76" align="center"><strong>Hero</strong></td>
          <td width="86" align="center"><strong>Level</strong></td>
          </tr></tbody></table>
          <table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" id="DataGrid1" bgcolor="White">
          <tbody>';
      foreach($herois as $row) {
         $table .= ' 
          <tr>
          <td width="77" height="31" align="center">'.++$rank.'</td>
          <td width="353" align="center">'.$row["name"].'</td>
          <td width="76" align="center"><img src="imagens/site/hero/'.$row["hero_type"].'.gif"></td>
          <td width="86" align="center">'.$row["baselevel"].'</td>
          </tr>';
         }
        $table .= ' </tbody>
        <table cellspacing="0" cellpadding="3" rules="all" bordercolor="#CCCCCC" border="1" bgcolor="White"><tbody><tr align="right" bgcolor="#F0F0F0">
        <td width="613" colspan="2"><font color="#000066"><form action"ranking" method="post" >';
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="pagina" name="pagina" value="'.$i.'"> ';
        }
        $table .= ' </form></font></td></tr></tbody></table>
        </div>';
        echo $table;
}

?>