<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><?= $title ?></li>
		</ol>
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