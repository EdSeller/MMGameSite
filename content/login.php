<div class="conteudoab">
<div class="namein">Login</div>
<div class="namein2"></div>
<div class="namein3"></div>
<div class="errorcenterlogin2">
</div>
<div class="errorloginhuehuebrbr" align="center">
<div class="errorloginhuehuebrbr2" align="center">
<form method="post">
<table width="238" height="91" border="0">
<tr>
<td width="78" height="34">Usuário
</td>
<td width="150"><input id="usuario" name="usuario" type="text" minlength="5" maxlength="15" required placeholder="Digite um Usuario" />
</td>
</tr>
<tr>
<td height="23">Senha</td>
<td><input id="senha" name="senha" type="password" required placeholder="Digite uma Senha" minlength="5" maxlength="15" title="Senha" class="input" />
</td>
</tr>
<tr>
<td height="26">
</td>
<td>
<button type="submit" name="" value="" class="css3button">Login
</button>
&nbsp;<a href="registro">
<button type="button" name="" value="" class="css3button">Registrar
</button>
</td>
</tr>
</table>
</form>
</div>
</div>
<div class="barlogin">
</div>
<div class="logintext">
<a href="recuperar.php" class="classe2link2">Recuperar conta.
</a>
</div>
</div>
<?php
 if(isset($_POST['usuario'])) { 
  $usuario = ($_POST['usuario']); 
  $senha = ($_POST['senha']); 
if (!empty($usuario) && !empty($senha)) {
	if ((strlen($usuario) < 5) || (strlen($usuario) > 15)) {
  echo "<script>alert('O campo Usuario precisa conter de 5 a 15 caracteres.'); history.back();</script>" ;
  exit;
	} elseif ((strlen($senha) < 5) || (strlen($senha) > 15)) {
  echo "<script>alert('O campo Senha precisa conter de 5 a 15 caracteres.'); history.back();</script>" ;
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
  ?>