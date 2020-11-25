<!DOCTYPE html>
<html lang="en">

<head>
	<title>QuesTi</title>

	<!--===============================================================================================-->
</head>

<body>



	<div class="container-login100 " style="background-color:white">
		<div class="col-md-6 col-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">


					<span style="color:white" class="login100-form-title ">
						Abrir Solicitação

					</span>
				</div>
				<div class="panel-body">
					<form id="chamado" METHOD="POST" class="login100-form validate-form" action="/chamados/cadastra_chamado" enctype="multipart/form-data">

						<div class="form-group">
							<div class="form-row">
								<label for="inputState">Categoria</label>
								<select id="inputState" class="form-control" name="categoria">
									<<option disabled selected>Selecione uma opção</option>



										<?php
										foreach ($array as $valor) {
											echo "<option>" . $valor['NomeArea'] . "</option>";
										}

										?>
										<option>Outros</option>

								</select>
							</div>


							<div class="form-row">
								<label for="inputPassword4">Assunto*</label>
								<input name="assunto" type="text" class="form-control" id="assunto">
								<div class="form-row"></div>

							</div>
							<label for="inputPassword4">Descrição*</label>
							<div class="form-row">
								<textarea class="form-control" id="info" name="info" cols="80" rows="5" style="resize:none"></textarea>

							</div>
							<br>
							<label for="inputState">Anexo </label>
							<div class="input-group">


								<div class="input-group-prepend">

								</div>
								<input name="arquivo" type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01">Selecionar Arquivo</label>
							</div>
						</div>
						<a>Campos com (*) são Obrigatórios</a>
						<?php
						//pegando o id do tecnico

						if (isset($_GET['id'])) {
							$tecnico = $_GET['id'];
						}

						?>
						<input hidden name="id_tec" type="text" value="<?php echo @$tecnico ?>">
						<br><br>
						<div class="container-login100-form-btn">

							<button id="mensagem-sucesso" onclick="return redirect(this)" class="login100-form-btn">
								Enviar
							</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</form>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../assets/js/jquery.validate.min.js"></script>
	<script src="../assets/js/jquery.validate.min.js"></script>

	<script>
		$("#chamado").validate({
			rules: {
				assunto: {
					required: true,
					minlength: 3
				},
				info: {
					required: true,
				},
			},
			messages: {
				assunto: {
					required: "Por favor, informe o assunto",
					minlength: "Deve ter pelo menos 4 letras"
				},
				info: {
					required: "Preencha a descrição"
				},

			}
		});
	</script>

	<?php

	//AQUI TRATA AS MENSAGENS DE RETORNO DO BACK-END 

	if (isset($_GET['message'])) {
		$mensagem = $_GET['message'];

	?>
		<?php if ($mensagem == "erro_envio") { ?>
			<script>
				$(document).ready(function() {

					swal("Erro ao Enviar!", "Impossivel realizar o envio da Solicitação!", "error", {
						confirmButtonText: "OK",
					}).then(function() {
						window.history.back();
					});
				});
			</script>

		<?php } ?>


		<?php if ($mensagem == "enviada") { ?>
			<script>
				$(document).ready(function() {

					swal("Enviado!", "Solicitação Enviada com Sucesso!", "success", {
						confirmButtonText: "OK",
					}).then(function() {
						window.location.href = "../home";
					});
				});
			</script>

		<?php } ?>


	<?php } ?>

	<style>
		.error {
			color: red
		}

		#label {
			color: blue
		}
	</style>


</body>

</html>