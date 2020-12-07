<!DOCTYPE html>
<html lang="en">

<head>
	<title>QuesTi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!--===============================================================================================-->
</head>

<body>

	<?php
	//arrumando variaveis comusn que vem do banco com nomes diferentes
	if ($tipo_user == 0) {
		@$identificador = $cnpj;
		$id_d = $id;
	} elseif ($tipo_user == 1) {
		$identificador = $cpf_cli;
		$id_d = $id;
	} elseif ($tipo_user == 2) {
		$identificador = $cpf_tec;
		$id_d = $id_tec;
	}
	?>



	<div class="container-login100 " style="background-color:white;">
		<div class="col-md-6 col-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">


					<span style="color:white" class="login100-form-title ">
						Editar Cadastro

					</span>
				</div>
				<div class="panel-body">

					<form id="edit_cadastro" method="POST" action="altera">
						<!--
						<div class="form-group col-md-13 border-bottom">
							<div class="">
								<div class="">
									<div class="">
										<img class="border border-white rounded-circle" src="/assets/images/tec/tec2.jpg" height="120" width="120" />
									</div>
									<label for="inputPassword4">Alterar Foto</label>

									<div class="input-group col-md-6">


										<div class="input-group-prepend">
										</div>
										<input id="foto" name=foto type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
										<label class="custom-file-label " for="inputGroupFile01">Selecionar Arquivo</label>
										<br><br>
									</div>
								</div>
							</div>
						</div>

						<br>
-->

						<input value="<?php echo $tipo_user; ?>" name="tipo_user" type="number" hidden>
						<input value="<?php echo $id_d; ?>" name="id" type="number" hidden>
						<?php if ($tipo_user == 2) { ?>



							<div id="div_tec" style="visibility">
								<div class="form-group">
									<label for="inputState">Área de Atuação</label>
									<select id="inputState" class="form-control" name="area_atuacao" id="area_atuacao">
										<option disabled selected>Selecione uma opção</option>



										<?php

										//incluindo as areas de atuacao
										include_once("../../models/area_atuacao.php");

										$array = $this->AreaAtuacao->TodasAreas("areaatuacao");
										foreach ($array as $valor) {
											echo "<option>" . $valor['NomeArea'] . "</option>";
										}

										?>
										<option>Outros</option>
									</select>
								</div>
							</div>
							<br>
						<?php } ?>


						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword4">Nome</label>
								<input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo">
							</div>

							<div class="form-group col-md-6">
								<label for="inputEmail4">Email</label>
								<input value="<?php echo $email; ?>" name="email" type="email" class="form-control" id="email" placeholder="Email">
							</div>

						</div>
						<?php if ($tipo_user != 0) { ?>
							<div class="form-group" hidden>
								<label for="inputAddress">Cpf</label>
								<input value="<?php echo $identificador; ?>" id="cpf" name="cpf" type="text" class="form-control" id="inputAddress" placeholder="Ex:104.456.333-71">
							</div>
						<?php } else { ?>
							<div class="form-group" hidden>
								<label for="inputAddress">Cnpj</label>
								<input value="<?php echo $identificador; ?>" id="cpf" name="cpf" type="text" class="form-control" id="inputAddress" placeholder="Ex: 16.189.379/0003-04">
							</div>
						<?php } ?>

						<div class="form-group">
							<label for="inputAddress">Endereço</label>
							<input value="<?php echo $endereco; ?>" name="endereco" type="text" class="form-control" id="endereco" placeholder="Ex:Rua das Rosas 425">
						</div>

						<?php if ($tipo_user != 0) { ?>
							<div class="form-group">
								<label for="inputAddress">Cep</label>
								<input value="<?php echo $cep; ?>" id="cep" name="cep" type="text" class="form-control" id="inputAddress" placeholder="Ex:83070-611">
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">Telefone</label>
									<input value="<?php echo $telefone; ?>" id="tel" name="tel" type="text" class="form-control" id="inputEmail4" placeholder="Ex:41-3333-3706">
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Celular</label>
									<input id="cel" value="<?php echo $celular; ?>" name="cel" type="text" class="form-control" id="cel" placeholder="Ex:41-9687-4054">
								</div>





							<?php } ?>
							</div>


							<div class=" form-group ">
								<label for="inputPassword4">Alterar Senha</label>
								<input type='checkbox' id="escolha" name="escolha" value="true" />
							</div>

							<div class="form-group ">
								<div style="display:none" id="confirmacao">
									<label>Senha</label>
									<input id="senha" name="senha" class="form-control" type="password">
									<br>
									<label>Confirmar Senha</label>
									<input id="senha2" name="senha2" class="form-control" type="password">


								</div>
								<input hidden id="senha_antiga" name="senha_antiga" class="form-control" type="text" value="<?php echo $senha; ?>">
							</div>
				</div>


				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">
						Salvar
					</button>
				</div>

			</div>

			</form>
		</div>
	</div>
	</div>
	</div>


</body>
<script>
	$('#escolha').click(function() {
		$("#confirmacao").toggle(this.checked);
	});

	$('#escolha').click(function() {
		$("#confirmacao2").toggle(this.checked);
	});
</script>

<script src="../assets/js/jquery.validate.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#cpf").mask("999.999.999-99");
	});

	$(document).ready(function() {
		$("#cep").mask("99999-999");
	});

	$(document).ready(function() {
		$("#cel").mask("(99)99999-9999");
	});

	$(document).ready(function() {
		$("#tel").mask("(99)9999-9999");
	});
</script>


<script>
	$("#edit_cadastro").validate({
		rules: {
			nome: {
				required: true,
				minlength: 3
			},
			email: {
				required: true
			},
			endereco: {
				required: true
			},
			cep: {
				required: true
			},
			tel: {
				required: true
			},
			cel: {
				required: true
			},
			senha: {
				required: true
			},
			senha2: {
				equalTo: "#senha"
			},

		},
		messages: {
			nome: {
				required: "Por favor, informe seu nome",
				minlength: "O nome deve ter pelo menos 3 caracteres"
			},
			email: {
				required: "É necessário informar um email"
			},
			endereco: {
				required: "O Endereço é obrigatório"
			},
			cep: {
				required: "O Cep é obrigatório"
			},
			tel: {
				required: "O telefone é obrigatório"
			},
			cel: {
				required: "O celular é obrigatório"
			},
			senha: {
				required: "É necessário preencher a senha"
			},
			senha2: {
				equalTo: "É necessário  que as senhas sejam iguais"
			},


		}


	});
</script>
</body>

</html>
<style>
	.error {
		color: red
	}

	#label {
		color: blue
	}
</style>


<?php

//AQUI TRATA AS MENSAGENS DE RETORNO DO BACK-END 

if (isset($_GET['message'])) {
	$mensagem = $_GET['message'];

?>
	<?php if ($mensagem == "err_email") { ?>
		<script>
			$(document).ready(function() {

				swal("Email Duplicado!", "Impossivel realizar a edição pois já existe um cadastro com esse email!", "error", {
					confirmButtonText: "OK",
				}).then(function() {
					window.history.back();
				});
			});
		</script>
	<?php } ?>



	<?php if ($mensagem == "editado") { ?>
		<script>
			$(document).ready(function() {

				swal("Edição ok!", "Seu cadastro foi editado com sucesso!", "success", {
					confirmButtonText: "OK",
				}).then(function() {
					window.history.back();
				});
			});
		</script>
	<?php } ?>

	<?php if ($mensagem == "erro_edit") { ?>
		<script>
			$(document).ready(function() {

				swal("Erro ao Editar!", "Não foi possível concluir a edição do cadastro!", "error", {
					confirmButtonText: "OK",
				}).then(function() {
					window.history.back();
				});
			});
		</script>
	<?php } ?>


<?php } ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

<script src="http://digitalbush.com/files/jquery/maskedinput/rc3/jquery.maskedinput.js" type="text/javascript">
</script>

</html>