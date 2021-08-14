<style>
	#learner {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 0 20px;
	}

	span#no {
		font-size: 1.1em;
		font-weight: bold;
	}

	span#nama {
		font-weight: bold;
	}

	span#no, #learner #img {
		margin-right: 10px
	}
</style>

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

<h1 class="text-center" style="font-weight: bold; text-transform: uppercase;">Top Learner</h1>

<?php if ($this->session->userdata('role_id')==3): ?>
	<h2>Point anda <?= $user->skor ?></h2>
<?php endif ?>

<?php $no=1; foreach ($mahasiswa as $m): ?>
<div class="card">
	<div class="card-body">
		<div id="learner">
			<div>
				<span id="no"><?= $no++ ?></span>
				<img src="assets/img/profile/<?= $m->foto ?>" alt="<?= $m->nama_lengkap ?>" height="42" width="42" style="border-radius: 50%;" id="img">
				<span id="nama"><?= $m->nama_lengkap ?></span>
			</div>
			<div id="skor"><?= $m->skor ?> Point</div>
		</div>
	</div>
</div>
<?php endforeach ?>