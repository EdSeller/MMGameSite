<div class="conteudoab">
<div class="namein">Painel do jogador</div>
<div class="namein2"></div>
<div class="namein4"></div>
<div class="meioauto">
<?php 
	tabelaconta(); 
	?>
</div>
<div class="namein4"></div>
<div align="center">
<a href="senha"> <button type="submit" name="" value="" class="css3button">Alterar Senha</button></a>
<a href="email"><button type="submit" name="" value="painel" class="css3button">Alterar Email</button></a>
<a href="<?php echo mall_url(); ?>"><button type="submit" name="" value="" class="css3button">Shop</button></a>
<form method="post" class="buttonline"> <button type="submit" name="logout" value="logout" class="css3button">Logout</button></form>
<div class="namein4"></div>
<?php 
	tabelaherois();
	?>
<div class="namein4"></div>
<?php 
	tabelacompras();
	?>
</div>
<div class="namein4"></div>
</div>
<?php 
	painelp ();
	?>
