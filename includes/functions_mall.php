<?php 

// Exibe conteudo de mall/shop

function page_content_mall() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'todos';
    $path = getcwd() . '/' . config('content_path_mall') . '/' . $page . '.php';
    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path_mall') . '/404.php';
    }
    include_once($path);
}

// Functions para exibir seçoes do mall

function mall() {
	$catpagina = isset($_POST['page']) ? $_POST['page'] : 'armas';
	$itemloopcl = "1";
	$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : '1';
	$limite = 20;
	$pdo = db_connect_web_data();
	if (isset($_POST['categoria'])){
		$subcategoria = ($_POST['categoria']);
    	$cmd = $pdo->prepare("SELECT * FROM shopb WHERE pagina = :pagina AND categoria = :categoria ORDER BY ItemId Desc");
    	$cmd->bindParam(":pagina",$catpagina, PDO::PARAM_STR);
    	$cmd->bindParam(":categoria",$subcategoria, PDO::PARAM_STR);
    	$cmd->execute();
    	$total = $cmd->rowCount(PDO::FETCH_ASSOC);
    	$numPaginas = ceil($total / $limite); 
    	$rank = ($pagina - 1) * $limite; 
    	$cmd = $pdo->prepare("SELECT * FROM shopb WHERE pagina = :pagina AND categoria = :categoria ORDER BY ItemID Desc limit :inicio , :limite");
    	$cmd->bindParam(":pagina",$catpagina, PDO::PARAM_STR);
   	 	$cmd->bindParam(":categoria",$subcategoria, PDO::PARAM_STR);
   		$cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
   		$cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
   		$cmd->execute();
    	$produtos = $cmd->fetchAll(PDO::FETCH_ASSOC);
    	$table = '<div class="mallitems">';
    	foreach($produtos as $row) {
      	if($itemloopcl++ % 2 == 0) {
			$table .= '<div class="ss2">';
		}else{
			$table .= '<div class="ss1">';
		}
        $table .= ' <div class="ssn"><div class="sst"> '.$row["Nome"].'
          </div></div><div class="ssimg"><div class="ssimg2">
          <img src="imagens/shop/'.$row["ItemId"].'.gif" width="84" height="78">
          </div></div><div class="ssd">
          <p>Level requerido: '.$row["Level"].'</p>
          <p>Trocavel: '.$row["Trade"].'</p>
          <p>Limite de uso: '.$row["Tempo"].'</p>
          <p>Quantidade: '.$row["Quantidade"].' Unidades</p>
          <p>Desconto: '.$row["Promocao"].'%</p>
          </div>  <div class="ssp"><div class="ssp2"></div>
          '.$row["Lc"].'LC
          </div> <div class="ssb"><div class="ssb1">
          <img src="imagens/mall/button/img9.png"></div> <div class="ssb2">
          <img src="imagens/mall/button/img10.png"></a></div><div class="ssb3">
          <img src="imagens/mall/button/img11.png"></a></div></div></div>';
          }
        $table .= '<div class="navss"><form method="POST" ><input name="categoria" type="hidden" value="'.$subcategoria.'"></input>';
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="mall" name="pagina" value=" '.$i.' ">';
        }
        $table .= '</form></div></div>';
        echo $table;
	  	} else {
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE pagina = :pagina ORDER BY ItemId Desc");
      $cmd->bindParam(":pagina",$catpagina, PDO::PARAM_STR);
      $cmd->execute();
      $total = $cmd->rowCount(PDO::FETCH_ASSOC);
      $numPaginas = ceil($total / $limite); 
      $rank = ($pagina - 1) * $limite; 
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE pagina = :pagina ORDER BY ItemID Desc limit :inicio , :limite");
      $cmd->bindParam(":pagina",$catpagina, PDO::PARAM_STR);
      $cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
      $cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
      $cmd->execute();
      $produtos = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '<div class="mallitems">';
      foreach($produtos as $row) {
      	if($itemloopcl++ % 2 == 0) {
		   $table .= '<div class="ss2">';
	  }else{
		   $table .= '<div class="ss1">';
		}
         $table .= ' <div class="ssn"><div class="sst"> '. $row["Nome"] .'
          </div> </div> <div class="ssimg"><div class="ssimg2">
          <img src="imagens/shop/'.$row["ItemId"].'.gif" width="84" height="78">
          </div></div><div class="ssd">
          <p>Level requerido: '.$row["Level"].'</p>
          <p>Trocavel: '.$row["Trade"].'</p>
          <p>Limite de uso: '.$row["Tempo"].'</p>
          <p>Quantidade: '.$row["Quantidade"].' Unidades</p>
          <p>Desconto: '.$row["Promocao"].'%</p>
          </div>  <div class="ssp"><div class="ssp2"></div>
          '.$row["Lc"].'LC
          </div> <div class="ssb"><div class="ssb1">
          <img src="imagens/mall/button/img9.png"></div> <div class="ssb2">
          <img src="imagens/mall/button/img10.png"></a></div><div class="ssb3">
          <img src="imagens/mall/button/img11.png"></a></div></div></div>';
         }
        $table .= '<div class="navss"><form method="POST" >';
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="pagina" name="pagina" value=" '.$i.'">';
        }
        $table .= '</form></div></div>';
        echo $table;
	  	}
	}

function mall_all() {
	$catpagina = isset($_POST['page']) ? $_POST['page'] : 'armas';
	$itemloopcl = "1";
	$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : '1';
	$pdo = db_connect_web_data();
    $limite = 20;
	if (isset($_POST['categoria'])) {
	  $subcategoria = ($_POST['categoria']);
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE categoria = :categoria ORDER BY ItemId Desc");
      $cmd->bindParam(":categoria",$subcategoria);
      $cmd->execute();
      $total = $cmd->rowCount(PDO::FETCH_ASSOC);
      $numPaginas = ceil($total / $limite); 
      $rank = ($pagina - 1) * $limite;
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE categoria = :categoria ORDER BY ItemID Desc limit :inicio , :limite");
      $cmd->bindParam(":categoria",$subcategoria, PDO::PARAM_STR);
      $cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
      $cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
      $cmd->execute();
      $produtos = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '<div class="mallitems">';
      foreach($produtos as $row) {
      	if($itemloopcl++ % 2 == 0) {
		   $table .= '<div class="ss2">';
		}else{
		   $table .= '<div class="ss1">';
		}
         $table .= ' <div class="ssn"><div class="sst"> '.$row["Nome"].'
          </div></div><div class="ssimg"><div class="ssimg2">
          <img src="imagens/shop/'.$row["ItemId"].'.gif" width="84" height="78">
          </div></div><div class="ssd">
          <p>Level requerido: '.$row["Level"].'</p>
          <p>Trocavel: '.$row["Trade"].'</p>
          <p>Limite de uso: '.$row["Tempo"].'</p>
          <p>Quantidade: '.$row["Quantidade"].' Unidades</p>
          <p>Desconto: '.$row["Promocao"].'%</p>
          </div>  <div class="ssp"><div class="ssp2"></div>
          '.$row["Lc"].'LC
          </div> <div class="ssb"><div class="ssb1">
          <img src="imagens/mall/button/img9.png"></div> <div class="ssb2">
          <img src="imagens/mall/button/img10.png"></a></div><div class="ssb3">
          <img src="imagens/mall/button/img11.png"></a></div></div></div>';
         }
        $table .= '<div class="navss"><form method="POST"><input name="categoria" type="hidden" value="'.$subcategoria.'"></input>';
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="pagina" name="pagina" value=" '.$i.' ">';
        }
        $table .= '</form></div></div>';
        echo $table;
    }else {
      $cmd = $pdo->prepare("SELECT * FROM shopb ORDER BY ItemId Desc");
      $cmd->execute();
      $total = $cmd->rowCount(PDO::FETCH_ASSOC);
      $numPaginas = ceil($total / $limite); 
      $rank = ($pagina - 1) * $limite; 
      $cmd = $pdo->prepare("SELECT * FROM shopb ORDER BY ItemID Desc limit :inicio , :limite");
      $cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
      $cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
      $cmd->execute();
      $produtos = $cmd->fetchAll(PDO::FETCH_ASSOC);
      $table = '<div class="mallitems">';
      foreach($produtos as $row) {
      	if($itemloopcl++ % 2 == 0) {
		   $table .= '<div class="ss2">';
		}else{
		   $table .= '<div class="ss1">';
		}
         $table .= ' <div class="ssn"><div class="sst"> '.$row["Nome"].'
          </div></div><div class="ssimg"><div class="ssimg2">
          <img src="imagens/shop/'.$row["ItemId"].'.gif" width="84" height="78">
          </div></div><div class="ssd">
          <p>Level requerido: '.$row["Level"].'</p>
          <p>Trocavel: '.$row["Trade"].'</p>
          <p>Limite de uso: '.$row["Tempo"].'</p>
          <p>Quantidade: '.$row["Quantidade"].' Unidades</p>
          <p>Desconto: '.$row["Promocao"].'%</p>
          </div>  <div class="ssp"><div class="ssp2"></div>
          '.$row["Lc"].'LC
          </div> <div class="ssb"><div class="ssb1">
          <img src="imagens/mall/button/img9.png"></div> <div class="ssb2">
          <img src="imagens/mall/button/img10.png"></a></div><div class="ssb3">
          <img src="imagens/mall/button/img11.png"></a></div></div></div>';
         }
        $table .= '<div class="navss"><form method="POST" >';
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="pagina" name="pagina" value=" '.$i.' ">';
        }
        $table .= '</form></div></div>';
        echo $table;
    	}
	}

function mall_login(){
	if(isset($_SESSION['usuario'])) {
		$infort = conta();
		$table = '<div class="loginoff"><div class="login"><div class="login2"><div class="logins2" align="center"><div class="lclogoff" align="center"> <b>LC: '.$infort->getLc().'</b></div></div><div class="loginb"><form method="post"><input class="logoutbb" type="submit" id="logout" name="logout" class="left" value=""></form></div></div></div>';
		}else {
			$table = '<form method="post">
			<div class="loginoff"><div class="login"><div class="login2"><form method="post" action="?go=logarmall">
			<div class="logins" align="center">
			<td width="150"><input id="login" name="login" type="text" minlength="5" maxlength="15" required placeholder="Digite um Usuario" />
			<input id="senha" name="senha" type="password" required placeholder="Digite uma Senha" minlength="10" maxlength="15" title="Senha" class="input" />
			</div><div class="loginb"><input id="submit" name="submit" type="image" action="submit" class="left" src="imagens/mall/button/img8.png"></form></div></div></div>
			</form>';
		}
	echo $table;
	}
?>