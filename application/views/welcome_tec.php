<!DOCTYPE html>
<html lang="en">

<head>
	<title>QuesTi</title>

	<!--===============================================================================================-->
</head>

<body>

	<div class="">
		<div class="container-login100">
			<div class="wrap-login100 p-t-90 p-b-30">
				<form METHOD="POST" class="login100-form validate-form" action="/login/logartec">
					<span class="login100-form-title p-b-40">
						QuestTi/Tecnico
					</span>
					<!--
					<div>
						<a href="#" class="btn-login-with bg1 m-b-10">
							<i class="fa fa-facebook-official"></i>
							Login with Facebook
						</a>

						<a href="#" class="btn-login-with bg2">
							<i class="fa fa-twitter"></i>
							Login with Twitter
						</a>
					</div>
-->


					<div class="wrap-input100 validate-input m-b-16" data-validate="Insira o Usuario">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate="Insira a Senha">
						<span class="btn-show-pass">
							<i class="fa fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="flex-col-c p-t-224">


						<a href="../cadastro" class="txt3 bo1 hov1">
							Cadastre-se
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	<input hidden value>
	<?php
	if (isset($_GET['message'])) {
		$mensagem = $_GET['message'];

	?>
		<?php if ($mensagem == "errorlogin") { ?>
			<script>
				$(document).ready(function() {

					swal("Erro Login", "Não foi possível fazer login , pode ser que seu usuário ainda esteja em análise , por favor aguarde!", "error", {
						confirmButtonText: "OK",
					}).then(function() {
						window.location.href = "../welcome/tec";
					});
				});
			</script>
		<?php } ?>
	<?php } ?>

</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>