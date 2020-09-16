<div class="conteudoab">
<div class="namein">Registrar uma nova conta</div>
<div class="namein2"></div>
</br>
<div class="meiocadastrob"> 
<div class="meiocadastro" align="center"> 
<form method="post">
	<label for="nome"><b>Nome Completo:</b></label><br />  
	<input minlength="5" maxlength="50" name="nome" type="text" required placeholder="Campo Obrigatorio" /> <br /> 
	<div class="textacc">(Entre 5-50 caracteres)</div>
	</br>
	<label for="usuario"><b>Usuario:</b></label><br /> 
	<input minlength="5" maxlength="15" name="usuario" type="text" required placeholder="Campo Obrigatorio" /> <br /> 
	<div class="textacc">(Entre 5-15 caracteres)</div>
	</br>
	<label for="senha"><b>Senha:</b></label><br /> 
	<input minlength="5" maxlength="15" name="senha" type="password" required placeholder="Campo Obrigatorio" /> <br /> 
	<div class="textacc">(Entre 5-15 caracteres)</div>
	</br>
	<label for="senhaconf"><b>Confirmar Senha:</b></label><br /> 
	<input minlength="5" maxlength="15" name="senhaconf" type="password" required placeholder="Campo Obrigatorio" /> <br /> 
	</br>
	<label for="email"><b>Endereço de E-mail:</b></label><br /> 
	<input minlength="8" maxlength="50" name="email" type="email" required placeholder="Campo Obrigatorio" /> <br /> 
	<div class="textacc">(Entre 8-50 caracteres)</div>
	<br />
	<label for="emailconf"><b>Confirmar E-mail:</b> </label><br /> 
	<input minlength="8" maxlength="50" name="emailconf" type="email" required placeholder="Campo Obrigatorio" /> <br /> 
	</br>
	<label for="data"><b>Data de Nascimento</b></label><br /> 
	<input minlength="10" maxlength="10" name="data" type="date" required placeholder="Campo Obrigatorio" /> <br /> 
	</br>
	<input name="term" type="checkbox" value="checado" required placeholder="Voce precisa aceitar o termos de uso."  /> Eu li e concordo com os <a href="termos-de-uso" target="_blank"  class="classe2link2">termos de uso.</a><br /> 
	</br>
<input id="submit" name="submit" type="image" action="submit" class="left" 
src="imagens/site/button/img23.png"onmouseover="this.src='imagens/site/button/img22.png'" onMouseOut="this.src='imagens/site/button/img23.png'" >
</form>
<div class="textacc">Já possui uma conta? <a href="download.php" class="classe2link2">Baixar o Jogo</a></div>
</div>
</div>
</div>
<?php
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
} elseif ((strlen($senha) < 5) || (strlen($senha) > 15)) {
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
 ?>