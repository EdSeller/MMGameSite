<html>
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="play games;pokemon;download games;the game;games;adventure games;kids game;online games;game;internet games;rpg games;online multiplayer games;cool games;online rpg games;pc game;rpg game;computer games;pc games;download game;adventure game;best games;online game;kids games">
<meta name="Description" content="Jogo de fantasia online com muitos monstros. Faça o download do jogo gratis.">
<title><?php page_title(); ?> | <?php site_name(); ?></title>
<link href="<?php site_url(); ?>/template/mall/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="template/jquery-1.11.2.js"></script>
</head>
<body>
<div class="top">
<div class="menu" align="center">
<table width="595" border="0"><tr>
<td width="90" align="center"><a href="todos"><img src="imagens/mall/button/img1.png"></a></td>
<td width="119" align="center"><a href="premium"><img src="imagens/mall/button/img2.png"></a></td>
<td width="93" align="center"><a href="armas"><img src="imagens/mall/button/img3.png"></a></td>
<td width="98" align="center"><a href="armaduras"><img src="imagens/mall/button/img4.png"></a></td>
<td width="105" align="center"><a href="super"><img src="imagens/mall/button/img5.png"></a></td>
<td width="98" align="center"><a href="ofertas"><img src="imagens/mall/button/img6.png"></a></td>
</tr></table>
</div>
</div>
<?php 
logout();
mall_login();
mall_carrinho_func();
?>
<div class="tudo">
<div class="esquerda">
<?php 
mall_menu();
comprar();
page_content_mall(); 
?>
<div class="spacetds"></div>
<div class="iss">
</div>
<div class="eduardo">COPYRIGHT (C) <?php echo date('Y'); ?> MixMaster <?php site_version(); ?>. AuroraGames all rights reserved.</div></body>
</html>