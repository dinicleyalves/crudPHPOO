<?php
	function __autoload($class_name){
		require_once 'classes/' . $class_name . '.php';
	}
?>

<!DOCTYPE HTML>
<html land="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>PHP OO - CRUD - Prof Dinicley</title>
  <meta name="description" content="PHP CRUD - PROFESSOR DINICLEY" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="Dinicley Alves"/>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" />
  <link rel="shortcut icon" href="img/fav/favicon.ico" type="image/x-icon"/>
  <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
</head>
<body>

	<div class="container">

		<?php
	
		$usuario = new Usuarios();

		if(isset($_POST['cadastrar'])):

			$nome  = $_POST['nome'];
			$email = $_POST['email'];
			$telefone = $_POST['telefone'];

			$usuario->setNome($nome);
			$usuario->setEmail($email);
			$usuario->setTelefone($telefone);

			# Insert
			if($usuario->insert()){
				echo "Dados Inseridos com sucesso!";
			}

		endif;

		?>
		<header class="masthead">			
			<h1 class="muted" style="color: red"><img src="img/logo.png" width="50 50"> PHP OO - CRUD - Professor Dinicley</h1>	
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href="./">HOME</a></li>
							<li class="none"><a href="https://www.youtube.com/channel/UCNFadfe0fkDVRKo9N-Rc8tQ?sub_confirmation=1" target="_blank">YouTube</a></li>
							<li class=""><a href="https://www.facebook.com/ProfDinicley/" target="_blank">Facebook</a></li>
							<li class=""><a href="https://github.com/Dinicley/PHP-OO---CRUD" target="_blank">GitHub</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<?php 
		if(isset($_POST['atualizar'])):

			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$telefone = $_POST['telefone'];

			$usuario->setNome($nome);
			$usuario->setEmail($email);
			$usuario->setTelefone($telefone);

			if($usuario->update($id)){
				echo "Atualizado com sucesso!";
			}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

			$id = (int)$_GET['id'];
			if($usuario->delete($id)){
				echo "Sucesso ao Deletar!";
			}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

			$id = (int)$_GET['id'];
			$resultado = $usuario->find($id);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-ok"></i></span>
				<input type="text" name="telefone" value="<?php echo $resultado->telefone; ?>" placeholder="telefone:" />
			</div>
			<input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
			<br />
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email" placeholder="E-mail:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-ok"></i></span>
				<input type="text" name="telefone" placeholder="Telefone:" />
			</div>
			<br />
			<input type="submit" name="cadastrar" class="btn btn-primary" value="Inserir Dados">					
		</form>

		<?php } ?>

		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome:</th>
					<th>E-mail:</th>
					<th>Telefone:</th>
					<th>Ações:</th>
				</tr>
			</thead>
			
			<?php foreach($usuario->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->nome; ?></td>
					<td><?php echo $value->email; ?></td>
					<td><?php echo $value->telefone; ?></td>
					<td>
						<?php echo "<a href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
						<?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>

<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>