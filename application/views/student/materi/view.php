<style type="text/css">
	#info {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	hr {
		margin: 10px 0;
	}

	.card-head {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	@media (max-width: 567px) {
		#info {
			flex-direction: column;
		}
	}
</style>
<div class="bg-title">
	<h2 class="page-title" id="title1"><b><?= $materi->materi ?></b></h2>

	<p><i class="fa fa-users"></i> <?= $count ?> Peoples joined</p>
	
	<hr>
	<div id="info">
		<ul class="library col-lg-6">
		</ul>
		<button class="btn btn-warning" onclick="history.back(-1)">Kembali</button>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<h4 class="text-center"><?= $materi->materi ?></h4>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<?= $materi->file ?>
			</div>
		</div>
	</div>
</div>