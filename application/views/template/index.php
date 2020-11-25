<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!DOCTYPE html>
<html lang="en">

<body>

	<header style="background-color:#1C1C1C;">

		<div class="container">
			<div class="side">
				<nav class="dr-menu">

					<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label" style="color:white;">Olá ,<?php echo $_SESSION['login']; ?> </a></div>
					<ul>
						<?php if ($_SESSION['tipo_user'] == 1) { ?><li><a class="dr-icon dr-icon-heart" href="../home">Home</a></li><?php } elseif ($_SESSION['tipo_user'] == 0) { ?><li><a class="dr-icon dr-icon-heart" href="../home/hometec">Home</a></li><?php } ?>
						<li><a class="dr-icon dr-icon-user" href="/cadastro/editar_cadastro">Editar Perfil </a></li>

						<?php if ($_SESSION['tipo_user'] == 0) { ?> <li><a class="dr-icon dr-icon-bullhorn" href="/gerencia_cadastro/gerencia">Gerenciar Cadastros</a></li><?php } ?>


						<?php if ($_SESSION['tipo_user'] == 1 || $_SESSION['tipo_user'] == 2) { ?>
							<div class="w3-dropdown-hover">

								<?php if ($_SESSION['tipo_user'] == 1) {
									$sub1 = "Minhas Solicitações";
									$sub2 = "Solicicitações Finalizadas";
									$sub3 = "Relatório de Solicitações";
								?>
									<li><a class="w3-button   dr-icon dr-icon-settings" href="#">Solicitação de Serviços</a>
									<?php } elseif ($_SESSION['tipo_user'] == 2) {
									$sub1 = "Meus Chamados";
									$sub2 = "Chamados Finalizados";
									$sub3 = "";
									?>
									<li><a class="w3-button   dr-icon dr-icon-settings" href="#">Gerenciar Chamados</a>
									<?php } ?>
									<div class="w3-dropdown-content w3-bar-block w3-border dropdown-menu-right">
										<a href="/chamados/ver_solicitacao?status=aberto" class="w3-bar-item w3-button"><?php echo $sub1; ?> </a>
										<a href="/chamados/ver_solicitacao?status=finalizado" class="w3-bar-item w3-button"><?php echo $sub2; ?></a>
										<?php if ($sub3 != "") { ?><a href="/graficos" class="w3-bar-item w3-button"><?php echo $sub3; ?></a><?php } ?>


									</div>
							</div>

							</li>

						<?php } ?>

						<?php if ($_SESSION['tipo_user'] == 0) { ?>

							<div class="w3-dropdown-hover">
								<li><a class="w3-button   dr-icon dr-icon-settings" href="#">FeedBack</a>
									<div class="w3-dropdown-content w3-bar-block w3-border dropdown-menu-right">
										<a href="../Graficos/TopTec" class="">Acompanhamento de Técnicos</a>

									</div>
							</div>
							</li>
						<?php } ?>


						<?php if ($_SESSION['tipo_user'] == 1) { ?>
							<li><a class="dr-icon dr-icon-switch" href="../HistoricoPag">Histórico Pagamento</a></li><?php } elseif ($_SESSION['tipo_user'] == 2) { ?>
							<li><a class="dr-icon dr-icon-switch" href="../HistoricoPag">Histórico de Recebimentos</a></li> <?php } ?>
						<li><a class="dr-icon dr-icon-switch" href="/login/logof">Sair</a></li>
			</div>

			</ul>
			</nav>
		</div>
	</header>

</body>
<!--
			<header class="clearfix">
				<h1>Simple YouTube Menu Effect <span>A simple drop-down menu as seen on YouTube</span></h1>	
			</header>
			
		
			
			<div class="main">
				<p>This menu is inspired by the left side menu found on YouTube. When clicking on the menu label and icon, the main menu appears beneath and the menu icon slides to the right side while the label slides up. To close the menu, the menu icon needs to be clicked again.</p>
			
			</div>
			-->
</div><!-- /container -->
<script src="/assets/js/ytmenu.js"></script>




</html>