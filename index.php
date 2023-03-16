<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Accueil</title>
    </head>
	<body>
		<?php include('includes/header.php'); ?>
		
		<main>
			<h1>Accueil</h1>
			<?php
			if (isset($_GET['message']) && !empty($_GET['message'])){
				echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
			}
			?>
			<p>
			<?php
			echo isset($_SESSION['email']) ? 'Voici votre contenu privé.' : 'Contenu non disponible.';	
			?>
			</p>		
		</main>

		<?php include('includes/footer.php'); ?>
	</body>
</html>