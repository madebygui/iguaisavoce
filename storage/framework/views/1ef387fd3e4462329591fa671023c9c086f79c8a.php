<!DOCTYPE html>

<html lang="pt-Br">

<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">

	<meta http-equiv="Content-Type" content="application/xml; charset=ISO-8859-1">

	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title>Iguais a Você</title>

	<!--Declaração de CSS-->
	
	<!--Bootstrap-->
	<link rel="stylesheet" href="<?php echo e(URL::asset('lib/bootstrap/css/bootstrap.min.css')); ?>">

	<!--Font Awesome-->
	<link rel="stylesheet" href="<?php echo e(URL::asset('lib/font-awesome/css/font-awesome.min.css')); ?>">

	<!-- Froala Editor -->
	<link rel="stylesheet" href="<?php echo e(URL::asset('lib/froala-editor/css/froala_editor.pkgd.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::asset('lib/froala-editor/css/froala_style.min.css')); ?>">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>">

</head>
<body>

	<div class="banner">
		<img src="<?php echo e(URL::asset('img/banner.png')); ?>" class="img-fluid">
	</div>


	<div class="row">

		<div id="navbar" class="navbar col-md-2">

			<ul class="nav navbar-nav" role="navigation">

				<li class="navbar-header"><img class="img-max-x" src="<?php echo e(URL::asset('img/logo.png')); ?>">
				</li>

				<div class="pos-f-t menu-tablet">

					<nav class="navbar navbar-inverse bg-inverse">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>
					<div class="collapse" id="navbarToggleExternalContent">
						
						<a href="<?php echo e(url('/')); ?>"><li><i class="fa fa-home" aria-hidden="true"></i> Início</li></a>
						<a href="<?php echo e(url('/sobre')); ?>"><li><i class="fa fa-users" aria-hidden="true"></i> Sobre</li></a>

						<a aria-expanded="false" data-toggle="collapse" data-target="#assuntos"><li><i class="fa fa-quote-left" aria-hidden="true"></i> Assuntos</li></a>
						<ul class="collapse" id="assuntos">
							<a href="<?php echo e(url('/assuntos/1')); ?>"><li>Comportamento</li></a>
							<a href="<?php echo e(url('/assuntos/2')); ?>"><li>Cotidiano</li></a>
							<a href="<?php echo e(url('/assuntos/3')); ?>"><li>Relacionamento</li></a>
							<a href="<?php echo e(url('/assuntos/4')); ?>"><li>Beleza e Saúde</li></a>
						</ul>

						<a href="<?php echo e(url('/audios')); ?>"><li><i class="fa fa-play-circle" aria-hidden="true"></i> Áudios</li></a>

						<a href="<?php echo e(url('/videos')); ?>"><li><i class="fa fa-youtube-play" aria-hidden="true"></i> Vídeos</li></a>

						<a href="<?php echo e(url('/contato')); ?>"><li><i class="fa fa-comments" aria-hidden="true"></i> Fale Conosco</li></a>

						<a href="<?php echo e(url('/shopping')); ?>"><li><i class="fa fa-shopping-basket" aria-hidden="true"></i> Loja</li></a>
					</div>
				</div>

				<div class="menu-desktop">
					<a href="<?php echo e(url('/')); ?>"><li><i class="fa fa-home" aria-hidden="true"></i> Início</li></a>

					<a href="<?php echo e(url('/sobre')); ?>"><li><i class="fa fa-users" aria-hidden="true"></i> Sobre</li></a>

					<a href="#" data-toggle="collapse" data-target="#assuntosdesk"><li><i class="fa fa-quote-left" aria-hidden="true"></i> Assuntos</li></a>
					<ul class="collapse" id="assuntosdesk">
						<a href="<?php echo e(url('/assuntos/1')); ?>"><li>Comportamento</li></a>
						<a href="<?php echo e(url('/assuntos/2')); ?>"><li>Cotidiano</li></a>
						<a href="<?php echo e(url('/assuntos/3')); ?>"><li>Relacionamento</li></a>
						<a href="<?php echo e(url('/assuntos/4')); ?>"><li>Beleza e Saúde</li></a>
					</ul>

					<a href="<?php echo e(url('/audios')); ?>"><li><i class="fa fa-play-circle" aria-hidden="true"></i> Áudios</li></a>

					<a href="<?php echo e(url('/videos')); ?>"><li><i class="fa fa-youtube-play" aria-hidden="true"></i> Vídeos</li></a>

					<a href="<?php echo e(url('/contato')); ?>"><li><i class="fa fa-comments" aria-hidden="true"></i> Fale Conosco</li></a>

					<a href="<?php echo e(url('/shopping')); ?>"><li><i class="fa fa-shopping-basket" aria-hidden="true"></i> Loja</li></a>
				</div>

			</ul>

		</div>

		<?php echo $__env->yieldContent('content'); ?>


		<div id="merchan" class="merchan col-md-2">
			<?php $__currentLoopData = $propaganda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<img class="img-max-x" src="<?php echo e(url('img/'.$prop->arquivo)); ?>"/>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>

	</div>

	<!--Declaração de bibliotecas javascript-->

	<!--JQuery-->
	<script type="text/javascript" src="<?php echo e(URL::asset('lib/jquery/jquery.min.js')); ?>"></script>

	<!--Bootstrap-->
	<script type="text/javascript" src="<?php echo e(URL::asset('lib/bootstrap/js/bootstrap.min.js')); ?>"></script>

	<script type="text/javascript" src="<?php echo e(URL::asset('js/script.js')); ?>"></script>

	<!-- Froala Editor -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('lib/froala-editor/js/froala_editor.pkgd.min.js')); ?>"></script>

	<!-- PagSeguro -->
	<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

</body>
</html>