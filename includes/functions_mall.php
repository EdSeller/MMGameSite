<?php 

// Exibe conteudo de mall/shop

function page_content_mall() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path_mall') . '/' . $page . '.php';
    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path_mall') . '/404.php';
    }
    include_once($path);
}

// Function para retornar pesquisa da pagina inicial/todos os items.

function mall_todos($limite , $pagina , $pdo) {
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
    return array($produtos, $numPaginas);
}

function mall_ofertas($limite , $pagina , $pdo) {
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE promocao > 0 ORDER BY ItemId Desc");
      $cmd->execute();
      $total = $cmd->rowCount(PDO::FETCH_ASSOC);
      $numPaginas = ceil($total / $limite); 
      $rank = ($pagina - 1) * $limite; 
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE promocao > 0 ORDER BY ItemID Desc limit :inicio , :limite");
      $cmd->bindParam(":inicio",$rank, PDO::PARAM_INT);
      $cmd->bindParam(":limite",$limite, PDO::PARAM_INT);
      $cmd->execute();
      $produtos = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return array($produtos, $numPaginas);
}

// Function para retornar pesquisa de pagina/items por seçao.

function mall_pagina($limite , $pagina , $pdo , $catpagina) {
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
    return array($produtos , $numPaginas);
}

// Function para retornar pesquisa de sub categoria

function mall_categoria($limite , $pagina , $pdo) {
      $subcategoria = ($_POST['categoria']);
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE categoria = :categoria ORDER BY ItemId Desc");
      $cmd->bindParam(":categoria",$subcategoria, PDO::PARAM_STR);
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
      return array($produtos, $numPaginas);
}

// Monta tabela de items a serem exibidos com base na pesquisa.

function table($produtos, $numPaginas){
    $itemloopcl = "1";
    $table = '<div class="mallitems">';
      foreach($produtos as $row) {
        if($itemloopcl++ % 2 == 0) {
      $table .= '<div class="ss2">';
    }else{
      $table .= '<div class="ss1">';
    }   
        $lc = ($row["Promocao"] / 100) * $row["Lc"];
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
          '. ($row["Lc"] - $lc) .'LC
          </div> <div class="ssb"><div class="ssb1">
          <div class="btdetalhes">Detalhes</div>
          <div class="descricao"><div class="descricaotxt">'.$row["Descricao"].'</div></div>
          </div> <div class="ssb2">
          <form method="POST">
          <input name="adicionar" type="hidden" value="'.$row["id_cart"].'">
          <input type="submit" class="btdetalhesb" value="Carinho +">
          </form>
          </a></div><div class="ssb3">
          <form method="POST">
          <input name="CompraId" type="hidden" value="'.$row["id_cart"].'">
          <input type="submit" class="btdetalhesr" value="Comprar"> 
          </form></div></div></div>';
          }
        if (isset($_POST['categoria'])){
        $subcategoria = ($_POST['categoria']);
        $table .= '<div class="navss"><form method="POST" ><input name="categoria" type="hidden" value="'.$subcategoria.'"></input>';
        } else {
        $table .= '<div class="navss"><form method="POST" >';
        }
        for($i = 1; $i < $numPaginas + 1; $i++) {
        $table .= '<input type="submit" class="resetform" id="pagina" name="pagina" value=" '.$i.'">';
        }
        $table .= '</form></div></div>';
        return $table;
}

//Script de compra para items 

function comprar_tudo(){
  if (isset($_POST['comprartudo'])){
    $pdo = db_connect_web_data();
    $pdom = db_connect_member();
    $infort = conta();
    $lcconta = $infort->getLc();
    $playerid = $infort->getId();
    $playeruser = $infort->getUsuario();
    $novolc = 0;
    foreach($_SESSION['carrinho'] as $id => $qtd) {
    $cmd = $pdo->prepare("SELECT * FROM shopb WHERE id_cart = :id");
    $cmd->bindParam(":id",$id, PDO::PARAM_INT);
    $cmd->execute();
    $item = $cmd -> fetchAll(PDO::FETCH_ASSOC); 
    foreach ($item as $row) {
    $promocao = $row["Promocao"];
    $preco = $row["Lc"];
    $lc = ($promocao / 100) * $preco;
    $lcitem = ($preco - $lc );
    $novolc += ($qtd * $lcitem);
    }
    }
  if ($lcconta >= $novolc) {
    $novolc = ($lcconta - $novolc);
    $cmdd = $pdom->prepare("UPDATE player SET Lc = :novolc where id_idx = :playerid");
    $cmdd->bindParam(":novolc",$novolc, PDO::PARAM_INT);
    $cmdd->bindParam(":playerid",$playerid);
    $cmdd->execute();
    foreach($_SESSION['carrinho'] as $id => $qty) {
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE id_cart = :iditem");
      $cmd->bindParam(":iditem",$id, PDO::PARAM_INT);
      $cmd->execute();
      $item = $cmd->fetchAll(PDO::FETCH_ASSOC);
      foreach($item as $row) {
        $promocao = $row["Promocao"];
        $itemqty = $row["Quantidade"];
        $idxitem = $row["ItemId"];
      }
        $cmdm = $pdom->prepare("INSERT INTO GameTail_Event (ServerFlag, num, PlayerID, IdIdx, ObjectIdx, Qty, ServerID, Flag) VALUES ('define', '1', :playeruser, :playerid, :itemid, :itemqty, '21', 'NEW')");
        $cmdm->bindParam(":playeruser",$playeruser);
        $cmdm->bindParam(":playerid",$playerid, PDO::PARAM_INT);
        $cmdm->bindParam(":itemid",$idxitem, PDO::PARAM_INT);
        $itemqty = ($itemqty * $qty);
        $cmdm->bindParam(":itemqty",$itemqty, PDO::PARAM_INT);
        $cmdm->execute();
      } 
    unset ($_SESSION['carrinho']);
    echo "<script>alert('Compra efetuada.'); history.back();</script>" ;
    exit;
    }else{
    echo "<script>alert('LC insuficiente!'); history.back();</script>" ;
    exit;
    }
   }
  }

function comprar() {
  if (isset($_POST['CompraId'])){
      $iditem = ($_POST['CompraId']);
      $pdo = db_connect_web_data();
      $pdom = db_connect_member();
      $infort = conta();
      $lcconta = $infort->getLc();
      $playerid = $infort->getId();
      $playeruser = $infort->getUsuario();
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE id_cart = :iditem");
      $cmd->bindParam(":iditem",$iditem, PDO::PARAM_INT);
      $cmd->execute();
      $item = $cmd->fetchAll(PDO::FETCH_ASSOC);
      foreach($item as $row) {
        $promocao = $row["Promocao"];
        $itemqty = $row["Quantidade"];
        $preco = $row["Lc"];
        $idxitem = $row["ItemId"];
      }
      $lc = ($promocao / 100) * $preco;
      $lcitem = ($preco - $lc );
      if ($lcconta >= $lcitem) {
        $novolc = ($lcconta - $lcitem);
        $cmdd = $pdom->prepare("UPDATE Player SET Lc = :novolc where id_idx = :playerid");
        $cmdd->bindParam(":novolc",$novolc, PDO::PARAM_INT);
        $cmdd->bindParam(":playerid",$playerid);
        $cmdd->execute();
        $cmdm = $pdom->prepare("INSERT INTO GameTail_Event (ServerFlag, num, PlayerID, IdIdx, ObjectIdx, Qty, ServerID, Flag) VALUES ('define', '1', :playeruser, :playerid, :itemid, :itemqty, '21', 'NEW')");
        $cmdm->bindParam(":playeruser",$playeruser);
        $cmdm->bindParam(":playerid",$playerid, PDO::PARAM_INT);
        $cmdm->bindParam(":itemid",$idxitem, PDO::PARAM_INT);
        $cmdm->bindParam(":itemqty",$itemqty, PDO::PARAM_INT);
        $cmdm->execute();
        echo "<script>alert('Compra efetuada.'); history.back();</script>" ;
        exit;
      } else {
        echo "<script>alert('LC insuficiente!'); history.back();</script>" ;
        exit;
      } 
    }
  }

// Functions para exibir seçoes do mall

function mall_produtos() {
    $limite = 20;
    $pdo = db_connect_web_data();
    $catpagina = isset($_GET['page']) ? $_GET['page'] : 'home';
    $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : '1';
    if (isset($_POST['categoria'])){
      list($produtos, $numPaginas) = mall_categoria($limite , $pagina , $pdo);
    } elseif ($catpagina == "todos") {
      list($produtos, $numPaginas) = mall_todos($limite , $pagina , $pdo);
    } elseif ($catpagina == "ofertas") { 
      list($produtos, $numPaginas) = mall_ofertas($limite , $pagina , $pdo);
    } else {
      list($produtos, $numPaginas) = mall_pagina($limite , $pagina , $pdo , $catpagina);
    }
    $table = table($produtos, $numPaginas);
    echo $table;
} 


// Formulario de login ou se estiver logado exibe o lc da conta.

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

// Pagina de detalhes do item

function mall_detalhes() { 
      $pdo = db_connect_web_data();
      $id = isset($_POST['ItemId']) ? $_POST['ItemId'] : '69';
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE id_cart = :id");
      $cmd -> bindParam(":id",$id, PDO::PARAM_INT);
      $cmd -> execute();
      $item = $cmd -> fetchAll(PDO::FETCH_ASSOC);
      foreach ($item as $row) {
        $table = '<div class="finalpatch"></div>  
        <div class="txtpopdet1">'.$row["Nome"].' | <img src="imagens/site/icon_money.png"> '.$row["Lc"].'LC </div>
        <div class="imgpopdet"><img src="imagens/shop/'. $row["ItemId"] .'.gif"></div>
        <div class="txtpopdet">
        <div class="txtpopdet2">'. $row["Descricao"] .' <br><br></div>
        </div>
        <div class="buttondetalhes">
       <form method="POST">
          <input name="adicionar" type="hidden" value="'.$row["id_cart"].'">
          <input type="submit" class="btdetalhesb" value="Carinho +">
        </form>
        <form method="POST">
          <input name="CompraId" type="hidden" value="'.$row["id_cart"].'">
          <input type="submit" class="btdetalhesr" value="Comprar"> 
          </form>
        <div>';
      }
      echo $table;
  }  

//Se estiver logado exibe o menu de usuario.

function mall_menu (){
  if(isset($_SESSION['usuario'])) {
  echo '<div class="meumenue"> 
    <div class="meumenueb">
    <a href="historico" class="classelink"><img src="imagens/mall/img20.png"> Historico de Compras</a><br/>
    <div class="ponti"></div>
    <a href="painel" class="classelink"><img src="imagens/mall/img20.png"> Painel</a><br/>
    <div class="ponti"></div>
    <a href="comprar" class="classelink"><img src="imagens/mall/img20.png"> Comprar LC</a><br/>
    <div class="ponti"></div><div class="carrinhoe" align="center">
    <a href="carrinho" class="classelink2">Carrinho</a>
    </div></div></div>';
  }
}

function mall_carrinho_func() {
// Cria se ja nao estiver criada a session/array para o carrinho de compras
    if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }
// Adiciona o item do carrinho de compras
    if (isset($_POST['adicionar'])){
      $id = ($_POST['adicionar']);
    if(!isset($_SESSION['carrinho'][$id])){
      $_SESSION['carrinho'][$id] = 1;
    }else{
      $_SESSION['carrinho'][$id] += 1;
    }
  }
//Remove o item do carrinho de compras
    if (isset($_POST['remover'])){
      $id = ($_POST['remover']);
    if(isset($_SESSION['carrinho'][$id])){
      unset($_SESSION['carrinho'][$id]);
    }
  }
}

// Altera a quantidade do item no carrinho de compras
    if (isset($_POST['prod'])){
    if(is_array($_POST['prod'])){
      foreach($_POST['prod'] as $id => $qtd){
        $id  = intval($id);
        $qtd = intval($qtd);
        if(!empty($qtd) || $qtd <> 0){
          $_SESSION['carrinho'][$id] = $qtd;
        }else{
          unset($_SESSION['carrinho'][$id]);
        }
      }
    }
  }

// Exibe conteudo do carrinho de compras

function mall_carrinho (){
     if(count($_SESSION['carrinho']) == 0){
       echo '
      <div class="carrinho"></div>
      <div class="conteudo">
      <div class="iss">
      <div class="incarrinho" align="center">
      <div class="txtnoitem"></div>
      </div></div></div>
       ';
     }else{ 
    $total = 0;
    $table = '
    <div class="carrinho"></div>
  <div class="conteudo">
<div class="iss">
<div class="incarrinho" align="center">
<div class="apk3">
<div class="apberror3"></div>
    ';
    $pdo = db_connect_web_data(); 
    foreach($_SESSION['carrinho'] as $id => $qtd) {
      $cmd = $pdo->prepare("SELECT * FROM shopb WHERE id_cart = :id");
      $cmd->bindParam(":id",$id, PDO::PARAM_INT);
      $cmd->execute();
      $item = $cmd -> fetchAll(PDO::FETCH_ASSOC); 
    foreach ($item as $row) {
      $promocao = $row["Promocao"];
      $preco = $row["Lc"];
      $lc = ($promocao / 100) * $preco;
      $lcitem = ($preco - $lc );
      $table .= '<div class="apb"><div class="apb2">
        <img src="imagens/shop/'.$row["ItemId"].'.gif"></div>
        <div class="apb3">
        '.$qtd.'x '.$row["Nome"].' - '.($lcitem * $qtd).'
        <img src="imagens\site\icon_money.png"></div>
        <div class="apb5"><div class="apb52">
        <form method="POST">
        <input type="text" class="marginbot" size="3" name="prod['.$id.']" value="'.$qtd.'" />
        <input type="submit" class="btdetalhesb" value="Alterar">
        </form>
        </div><div class="apb53">
        <form method="POST">
        <input name="remover" type="hidden" value="'.$row["id_cart"].'">
        <input type="submit" class="btdetalhesr" value="Remover"> 
        </form>
        </div></div><div class="apb4">
        <div class="apberror2"></div>
        '.$row["Descricao"].'
        </div></div><div class="apberror"></div>
        <div class="apberror"></div>';
    $total += ($qtd * $lcitem);
    }
  }
     $table .= '</div></div>
        <div class="barc" align="center">
        <div class="patchfinal"></div>
        <div class="barc2">
        <div class="barc4">'.$total.' LCs</div>
        </div>
        </div>
        </div>
        </div>
        <div class="comprartudo"><form method="POST">
        <input name="comprartudo" type="hidden" value="comprartudo">
        <input id="submit" name="submit" type="image" action="submit" class="left" src="imagens/mall/button/img12.png">
        </form>
        </div>
        ';
    echo $table;
    }
}
?>