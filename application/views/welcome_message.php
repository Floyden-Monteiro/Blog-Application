<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<title>Blog</title>
	<style>
		body {
			background-color: #f8f9fa;
		}

		.navbar {
			margin-bottom: 20px;
		}

		.card-container {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			gap: 20px;
		}

		.card {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			transition: transform 0.3s, box-shadow 0.3s;
		}

		.card:hover {
			transform: translateY(-10px);
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
		}

		.card-img-top {
			width: 100%;
			height: 200px;
			object-fit: cover;
		}

		.card-title {
			font-size: 1.25rem;
			font-weight: bold;
		}

		.card-text {
			color: #6c757d;
		}

		.footer {
			background-color: #343a40;
			color: #ffffff;
			text-align: center;
			padding: 20px 0;
			margin-top: 40px;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">Blog</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<?php if ($this->session->userdata('role') == 'admin') { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="card-container">
			<?php foreach ($articles as $article) { ?>
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="<?= base_url($article->image) ?>" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title"><?= $article->title ?></h5>
						<p class="card-text"><?= $article->content ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p>&copy; <?= date('Y') ?> Blog. All rights reserved.</p>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>