<!DOCTYPE html>
<html lang="en">

<head>
	<title>QuesTi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="wrapper"></div>

	<div class="container-login100 ">
		<div class="col-md-6 col-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">


					<span style="color:white" class="login100-form-title ">
						Cadastrar

					</span>
				</div>
				<div class="panel-body">

					<form id="cadastro" name="form1" METHOD="POST" action="/cadastro/cadastrar" enctype="multipart/form-data">

						<div onchange="esconde()" class="form-group">
							<label for="inputState">Tipo de Usuário *</label>
							<select name="tipo_usuario" id="tipo_usuario" class="form-control">
								<option selected>Comum</option>
								<option>Técnico</option>
							</select>
						</div>

						<div id="div_tec" style="display : none">
							<div class="form-group">
								<label for="inputState">Área de Atuação *</label>
								<select id="inputState" class="form-control" name="area_atuacao" id="area_atuacao">
									<option disabled selected>Selecione uma opção</option>



									<?php
									foreach ($array as $valor) {
										echo "<option>" . $valor['NomeArea'] . "</option>";
									}

									?>
									<option>Outros</option>
								</select>
							</div>

							<label for="inputState">Certificação </label>
							<div class="input-group">


								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupFileAddon01">Certificado</span>
								</div>
								<input name="certificado" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01">Selecionar Arquivo</label>
							</div>
						</div>
						<br>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword4">Nome *</label>
								<input required name="nome" type="text" class="form-control" id="inputPassword4" placeholder="Nome completo">
							</div>

							<div class="form-group col-md-6">
								<label for="inputEmail4">Email *</label>
								<input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
							</div>

						</div>
						<div class="form-group">
							<label for="inputAddress">Cpf *</label>
							<input name="cpf" type="text" class="form-control" id="cpf" placeholder="Ex:104.456.333-71">
						</div>

						<div class="form-group">
							<label for="inputAddress">Confirmar Cpf *</label>
							<input name="cpf2" type="text" class="form-control" id="cpf2" placeholder="Ex:104.456.333-71">
						</div>
						<div class="form-group">
							<label for="inputAddress">Senha *</label>
							<input name="senha" type="password" class="form-control" id="senha" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Confirmar Senha *</label>
							<input name="senha2" type="password" class="form-control" id="senha2" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Endereço *</label>
							<input name="endereco" type="text" class="form-control" id="inputAddress" placeholder="Ex:Rua das Rosas 425">
						</div>

						<div class="form-group">
							<label for="inputAddress">Cep *</label>
							<input name="cep" type="text" class="form-control" id="cep" placeholder="Ex:83070-611">
						</div>


						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Telefone *</label>
								<input name="tel" type="text" class="form-control" id="tel" placeholder="Ex:41-3333-3706">
							</div>



							<div class="form-group col-md-6">
								<label for="inputPassword4">Celular *</label>
								<input name="cel" type="text" class="form-control" id="cel" placeholder="Ex:41-9687-4054">
							</div>


							<div class="form-group col-md-6">
								<a href="#" data-toggle="modal" data-target="#termo">Aceito os Termos de Uso</a>
								&nbsp &nbsp
								<input type="checkbox" id="termo1" name="termo1">

							</div>
							&nbsp
							
							<a>Campos com (*) são Obrigatórios</a>

						</div>
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Cadastrar
							</button>
						</div>

					</form>
	

				</div>
			</div>
		</div>
	</div>
	</div>




	<div class="modal modal-fade" id="termo" role="dialog">
		<div class="modal-dialog modal-lg">

			<div class="modal-content">
				<div class="modal-body">

					<h5>TERMO DE USO DO SISTEMA
					</h5>
					<a>
						<h7>1-ACEITAÇÃO </h7>
						<p> Este “Termo de Uso de Sistema " rege o uso de todas as funcionalidades disponibilizadas pela QuestTi sejam para dispositivos móveis (Android, IOS, Windows Mobile), servidores, computadores pessoais (desktops) ou serviços web. Se
							você não concordar com estes termos não use este Sistema, Você reconhece ainda que analisou e aceitou as condições de uso. Leia-as atentamente pois o uso deste Sistema significa que você aceitou todos os termos e concorda em
							cumpri-los. Se você, usuário, for menor de idade ou declarado incapaz em quaisquer aspectos, precisará da permissão de seus pais ou responsáveis que também deverão concordar com estes mesmos termos e condições.</p>
						<h7>2-UTILIZAÇÃO</h7>
						<p> Ao executar e utilizar este Sistema em seu dispositivo. Você reconhece e concorda que a QuestTi concede ao usuário acesso exclusivo para uso e desta forma não lhe transfere os direitos sobre o produto. O Sistema deverá ser utilizado
							por você, usuário. A venda, transferência, modificação, engenharia reversa ou distribuição bem como a cópia de textos, imagens ou quaisquer partes nele contido é expressamente proibida.
						</p>
						<h7>3. ALTERAÇÕES, MODIFICAÇÕES E RESCISÃO</h7>
						<p> A QuestTi reserva-se no direito de, a qualquer tempo, modificar estes termos seja incluindo, removendo ou alterando quaisquer de suas cláusulas. Tais modificações terão efeito imediato. Após publicadas tais alterações, ao continuar
							com o uso do Sistema ,você terá aceitado e concordado em cumprir os termos modificados. A QuestiTi pode, de tempos em tempos, modificar ou descontinuar (temporária ou permanentemente) a distribuição ou a atualização deste Sitema.
						</p>
						<h7>CONSENTIMENTO PARA COLETA E USO DE DADOS</h7>
						<p> Você concorda que a QuestTi pode coletar e usar dados técnicos de seu dispositivo e também dados pessoais como armazenamento de fotos , documentos ,especificações, configurações, versões de sistema operacional, tipo de conexão
							à internet e afins.</p>
						<h7> ISENÇÃO DE GARANTIAS E LIMITAÇÕES DE RESPONSABILIDADE</h7>
						<P>Este Sistema estará em contínuo desenvolvimento e pode conter erros e, por isso, o uso é fornecido "no estado em que se encontra " e sob risco do usuário final. Na extensão máxima permitida pela legislação aplicável a QuestTi e
							seus fornecedores isentam-se de quaisquer garantias e condições expressas ou implícitas incluindo, sem limitação, garantias de comercialização, adequação a um propósito específico, titularidade e não violação no que diz respeito
							ao Sistema e qualquer um de seus componentes ou ainda à prestação ou não de serviços de suporte. A QuestiTi não garante que a operação deste Sistema seja contínua e sem defeitos. Exceto pelo estabelecido neste documento não
							há outras garantias, condições ou promessas ao Sistema expressas ou implícitas, e todas essas garantias, condições e promessas podem ser excluídas de acordo com o que é permitido por lei sem prejuízo à QuestTi e seus colaboradores.</P>
						<h7> I.</h7>
						<P>A QuestTi não garante, declara ou assegura que o uso deste Sistema será ininterrupto ou livre de erros e você concorda que a Sistema poderá remover por períodos indefinidos ou cancelar este Sistema a qualquer momento sem que você
							seja avisado.</P>
						<h7> II.</h7>
						<P> A QuestTi não garante, declara nem assegura que este Sistema esteja livre de perda, interrupção, ataque, vírus, interferência, pirataria ou outra invasão de segurança e isenta-se de qualquer responsabilidade em relação à essas
							questões.
						</P>
						<h7>
						</h7>III.</h7>
						<P> Em hipótese alguma a QuestTi bem como seus diretores, executivos, funcionários, afiliadas, agentes, contratados ou licenciadores responsabilizar-se-ão por perdas ou danos causados pelo uso do Sistema.
						</P>
						<br>
					</a> Curitiba, 19 de Novembro de 2020.



				</div>
				<div class="modal-footer ">

					<button type="submit" class="btn btn-success" id="aceito" name="aceito" data-dismiss="modal">Estou de Acordo</button>

				</div>
			</div>

		</div>
	</div>


	<style type="text/css">
		p {
			color: #4F4F4F;
			font-size: 16px;
		}
	</style>



</body>

<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script>



	function esconde() {

		var tipo_usuario = document.getElementById('tipo_usuario') //id do input nome item
		var div_tec = document.getElementById('div_tec')
		var tipo_usuario = String(tipo_usuario.value) //conversao do input nome item para string
		if (tipo_usuario == "Técnico") {
			div_tec.style.display = "block";
		} else {
			div_tec.style.display = "none"
		}
	}



	function verificacampo() {

		var tipo = form1.tipo_usuario.value

		var nome = form1.nome.value
		var email = form1.email.value
		var cpf = form1.cpf.value
		var senha = form1.senha.value
		var senha2 = form1.senha2.value
		var endereco = form1.endereco.value
		var cep = form1.cep.value
		var tel = form1.tel.value
		var cel = form1.cel.value




		if (tipo === "" || nome === "" || email === "" || cpf === "" || senha === "" || senha2 === "" || endereco === "" || cep === "" || tel === "" || cel === "") {

			;

			var $wrapper = document.querySelector('.Erros'),
				// Pega a string do conteúdo atual
				HTMLTemporario = $wrapper.innerHTML,
				// Novo HTML que será inserido
				HTMLNovo = '<div  align="center" id="alerta" class="alert alert-success" role="alert"><h4 style="color:red;">Preencha Todos campos !</h4></div>';

			// Concatena as strings colocando o novoHTML antes do HTMLTemporario
			HTMLTemporario = HTMLNovo + HTMLTemporario;

			// Coloca a nova string(que é o HTML) no DOM
			$wrapper.innerHTML = HTMLTemporario;


			return false;

		} else {

			alert("Cadastro feito com sucesso!");
			return true;
		}
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#cpf").mask("999.999.999-99");
	});
	$(document).ready(function() {
		$("#cpf2").mask("999.999.999-99");
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
	function valor() {

		var valor = document.getElementById('area_atuacao') //id do input nome item

		if (valor == "Selecione uma opção") {
			area_atuacao = false;
		}
	}
	$("#cadastro").validate({
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
			senha: "required",
			minlength: 6,
			senha2: {
				equalTo: "#senha",
				minlength: 6,
			},

			cpf: "required",
			cpf2: {
				equalTo: "#cpf"
			},

			termo1: {
				required:true,
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
			senha: {
				required: "É necessário informar a Senha",
				minlength: "A Senha deve ter pelo menos 6 caracteres",
			},
			senha2: {
				equalTo: "É necessário que as senhas sejam iguais",
				minlength: "A Senha deve ter pelo menos 6 caracteres",
			},
			cpf: {
				required: "É necessário informar o Cpf"
			},
			cpf2: {
				equalTo: "É necessário confirmar o Cpf"
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
			termo1: {
				required: "&nbsp Aceite os Termos"
			},


		}
	});
</script>


<?php

//AQUI TRATA AS MENSAGENS DE RETORNO DO BACK-END 

if (isset($_GET['message'])) {
	$mensagem = $_GET['message'];

?>
	<?php if ($mensagem == "cadastrado") { ?>
		<script>
			$(document).ready(function() {

				swal("Cadastrado com Sucesso!", "O usuário foi cadastrado com sucesso!", "success", {
					confirmButtonText: "OK",
				}).then(function() {
					window.location.href = "../welcome";
				});
			});
		</script>
	<?php } ?>



	<?php if ($mensagem == "erro_email") { ?>
		<script>
			$(document).ready(function() {

				swal("Error!", "Email ou cpf já cadastrados na base de dados!", "error", {
					confirmButtonText: "OK",
				}).then(function() {
					window.history.back();
				});
			});
		</script>
	<?php } ?>


	<?php if ($mensagem == "aguardar") { ?>
		<script>
			$(document).ready(function() {

				swal("Perfil Enviado para Análise!", "Seu cadastro foi feito com sucesso, por favor aguarde a liberação!", "success", {
					confirmButtonText: "OK",
				}).then(function() {
					window.location.href = "../welcome/tec";
				});
			});
		</script>
	<?php } ?>



<?php } // AQUI TERMINA O TRATAMENTO DAS MENSAGENS 
?>


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



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

<script src="http://digitalbush.com/files/jquery/maskedinput/rc3/jquery.maskedinput.js" type="text/javascript">
</script>

</html>