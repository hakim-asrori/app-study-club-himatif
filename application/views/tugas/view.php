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
<?php
if (date('d-m-Y H:i', strtotime($tugas->stop_at)) <= date('d-m-Y H:i')) { ?>
	<div class="alert alert-danger">Tugas sudah ditutup</div>
<?php } elseif (date('d-m-Y H:i', strtotime($tugas->created_at)) <= date('d-m-Y H:i')) { ?>
	<div class="alert alert-success">Tugas sedang berjalan</div>
<?php } else { ?>
	<div class="alert alert-danger">Tugas belum dibuka</div>
<?php } ?>
<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<h4 class="text-center"><?= $tugas->tugas ?></h4>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<?= $tugas->soal ?>
			</div>
		</div>
	</div>
</div>