<?php
require_once '../model/ElencoModel.php';
$elenco = new ElencoModel();
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html>

<head>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloPublico/elenco.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Elenco</title>


</head>
<body>

    <header>

        <?php
            include "inc/incMenuPrincipal.php";
        ?>

    </header>

		<main>
			<div class="container-fluid">

				<h3 class="font-weight-bold text-center m-4 p-4 border-bottom titulo-elenco">Elenco</h3>

				<div class="row p-0 m-0">

						<div class="col-12 m-0 p-0">

							<!--Elenco-->
							<div class="row elenco m-0 p-0 border-bottom">


								<div class="col-12 col-xl-10 m-auto text-center p-0 m-0">

									<!--Navegação do Slider-->
									<nav class="row">
										<div class="nav nav-tabs navegacao-elenco justify-content-center justify-content-lg-around" id="nav-tab" role="tablist">
											<a class="nav-item nav-link active ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-goleiro-tab" data-toggle="tab" href="#nav-goleiro" role="tab" aria-controls="nav-goleiro" aria-selected="true">Goleiro</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-lateral-tab" data-toggle="tab" href="#nav-lateral" role="tab" aria-controls="nav-lateral" aria-selected="false">Lateral</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-zagueiro-tab" data-toggle="tab" href="#nav-zagueiro" role="tab" aria-controls="nav-zagueiro" aria-selected="false">Zagueiro</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-volante-tab" data-toggle="tab" href="#nav-volante" role="tab" aria-controls="nav-volante" aria-selected="false">Volante</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-meio-campo-tab" data-toggle="tab" href="#nav-meio-campo" role="tab" aria-controls="nav-meio-campo" aria-selected="false">Meio Campo</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-atacante-tab" data-toggle="tab" href="#nav-atacante" role="tab" aria-controls="nav-atacante" aria-selected="false">Atacante</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-comissao-tecnica-tab" data-toggle="tab" href="#nav-comissao-tecnica" role="tab" aria-controls="nav-comissao-tecnica" aria-selected="false">Comissão Técnica</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-diretoria-tab" data-toggle="tab" href="#nav-diretoria" role="tab" aria-controls="nav-diretoria" aria-selected="false">Diretoria</a>
											<a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-apoio-tab" data-toggle="tab" href="#nav-apoio" role="tab" aria-controls="nav-apoio" aria-selected="false">Apoio</a>
										</div>
									</nav>

									<div class="tab-content p-4 mb-4" id="nav-tabContent">

										<!--Goleiros-->
										<div class="tab-pane active" id="nav-goleiro" role="tabpanel" aria-labelledby="nav-goleiro-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="prev-goleiro" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-goleiro" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-goleiro">

																<?php foreach ($elenco->selectJogadores(1,'goleiro') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>


															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>

												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-goleiro" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

											</div>


										</div>

										<!--Lateral-->
										<div class="tab-pane" id="nav-lateral" role="tabpanel" aria-labelledby="nav-lateral-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-lateral" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-lateral" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-lateral">


																<?php foreach ($elenco->selectJogadores(1,'lateral') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-lateral" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>


										</div>

										<!--Zagueiro-->
										<div class="tab-pane" id="nav-zagueiro" role="tabpanel" aria-labelledby="nav-zagueiro-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-zagueiro" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-zagueiro" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-zagueiro">

																<?php foreach ($elenco->selectJogadores(1,'zagueiro') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-zagueiro" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Volante-->
										<div class="tab-pane" id="nav-volante" role="tabpanel" aria-labelledby="nav-volante-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-volante" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-volante" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-volante">

																<?php foreach ($elenco->selectJogadores(1,'volante') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-volante" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Meio Campo-->
										<div class="tab-pane" id="nav-meio-campo" role="tabpanel" aria-labelledby="nav-meio-campo-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-meio-campo" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-meio-campo" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-meio-campo">

																<?php foreach ($elenco->selectJogadores(1,'meio-campo') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-meio-campo" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Atacante-->
										<div class="tab-pane" id="nav-atacante" role="tabpanel" aria-labelledby="nav-atacante-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-atacante" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-atacante" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-atacante">

																<?php foreach ($elenco->selectJogadores(1,'atacante') as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative" data-toggle="modal" data-target="#modal-jogador<?php echo $value->codigoElencado; ?>">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>
																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-atacante" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Comissão Técnica-->
										<div class="tab-pane" id="nav-comissao-tecnica" role="tabpanel" aria-labelledby="nav-comissao-tecnica-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-comissao-tecnica" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-comissao-tecnica" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-comissao-tecnica">

																<?php foreach ($elenco->selectGeral(2) as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>

																<?php endforeach;?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-comissao-tecnica" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Diretoria-->
										<div class="tab-pane" id="nav-diretoria" role="tabpanel" aria-labelledby="nav-diretoria-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-diretoria" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-diretoria" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-diretoria">

																<?php foreach ($elenco->selectGeral(3) as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>

																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-diretoria" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

										<!--Apoio-->
										<div class="tab-pane" id="nav-apoio" role="tabpanel" aria-labelledby="nav-apoio-tab">

											<div class="row d-flex justify-content-center">

												<!--Controlador PREV-->
												<div class="col-12 col-sm-1 text-sm-center align-self-center">

													<a class="prev-apoio" href="">
														<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<div class="col-12 col-sm-3 align-self-center">

													<div id="carrosel-apoio" class="carousel slide" data-ride="carousel">



														<!--Conteúdo principal do carrosel-->
														<div class="carousel-inner">

															<!--Itens do Carrosel-->
															<div class="carousel-item active carrosel-apoio">

																<?php foreach ($elenco->selectGeral(4) as $key => $value): ?>
																	<!--Imagem-->
																	<a class="img-perfil-jogador-link m-5 position-relative">

																		<figure>
																			<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>

																			<figcaption class='descricao-elencado'>
																				<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																				<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																			</figcaption>

																		</figure>

																	</a>

																<?php endforeach; ?>

															</div>

														</div><!--Fim do conteúdo principal do carrosel-->


													</div>
												</div>
												<!--Controlador NEXT-->
												<!--Controlador NEXT-->
												<div class="col-12 col-sm-1 text-center align-self-center">

													<a class="next-apoio" href="">
														<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
													</a>

												</div>

												<!--Controles do carrosel-->


											</div>

										</div>

									</div>

								</div>

							</div><!--Fim do elenco-->

							<?php foreach ($elenco->selectGeral(1) as $key => $value): ?>

								<!-- Modal Com Informações do jogador-->
							<div id="modal-jogador<?php echo $value->codigoElencado; ?>" class="modal fade modal-perfil-jogador" tabindex="-1" role="dialog" aria-labelledby="Modal Com Informações do Jogador" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-xl">
									<div class="modal-content">

										<div class="modal-header border-bottom">

											<h3 class="font-weight-bold"><?php echo $value->apelido ?> - <span class="font-weight-normal text-uppercase"><?= $value->funcao ?></span></h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="color: #000;">
												<i class="fas fa-window-close"></i>
											</button>

										</div>

										<div class="modal-body">

											<div class="container-fluid">

												<div class="row my-2">

													<!--Carrosel com fotos do jogador-->
													<div class="col-12 fotos-jogador m-0 p-0 d-block d-sm-flex justify-content-center">

														<!--Controlador PREV-->
														<div class="col-12 col-sm-1 text-center align-self-center">

															<a class="prev-fotos-carrosel-jogador" href="">
																<i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
															</a>

														</div>

														<!--Fotos-->
														<div class="fotos-jogador-carrosel col-12 col-sm-8">

															<!--Foto-->
															<div class="foto-jogador mx-2">

																<img src="img/elenco/<?php echo $value->fotoDePerfil; ?>" alt="Foto do Jogador"/>

															</div>



														</div>


														<!--Controlador NEXT-->
														<div class="col-12 col-sm-1 text-center align-self-center">

															<a class="next-fotos-carrosel-jogador" href="">
																<i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
															</a>

														</div>


													</div>

												</div>

												<div class="row justify-content-center border-top">

													<ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
														<li class="pb-1 font-weight-bold">Nome Completo</li>
														<li class="pt-1"><?php echo $value->nome; ?></li>
													</ul>

													<ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
														<li class="pb-1 font-weight-bold">Data de Nascimento</li>
														<li class="pt-1"><?php

															$data = new DateTime($value->dataNascimento);
															$dataAtual =  Date('Y/m/d');
															$dataIdade = new DateTime($dataAtual);
															$idade = $data->diff( $dataIdade );

															echo $data->format('d/m/Y');
															echo " ({$idade->y} anos)";


															?></li>
													</ul>

													<ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
														<li class="pb-1 font-weight-bold">Naturalidade</li>
														<li class="pt-1"><?php echo $value->naturalidade; ?></li>
													</ul>

													<ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
														<li class="pb-1 font-weight-bold">Nacionalidade</li>
														<li class="pt-1"><?php echo $value->nacionalidade; ?></li>
													</ul>


												</div>

											</div>

										</div>

									</div>
								</div>
							</div>

							<?php endforeach; ?>

						</div>

				</div>

			</div>
		</main>
	<footer>

        <?php
        include "inc/incRodapePrincipal.php";
        ?>

    </footer>


<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-migrate-1.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/moduloPublico/elenco.js"></script>
</body>

</html>