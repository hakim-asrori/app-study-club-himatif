<style>
	ul#materi li {
		margin: 10px 0;
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

<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Credit Point</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?= $skor ?></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Pemateri</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash3"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?= $pemateri ?></span></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4>Daftar Materi Baru</h4>
				<ul id="materi">
					<?php foreach ($materi as $m): ?>
						<?php
						$materi_view = $this->db->get_where('tb_materi_view', ['user' => $id_user, 'materi' => $m->id_materi])->num_rows();
						if ($materi_view < 1 && $m->file != '') { ?>
							<li><a href="/student/materi/<?= $m->slug ?>"><b><?= $m->materi ?></b></a></li>
						<?php } ?>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4>Daftar Tugas Baru</h4>
				<ul id="materi">
					<?php foreach ($tugas as $t): ?>
						<?php 
						if (date('d-m-Y H:i', strtotime($t->stop_at)) <= date('d-m-Y H:i')) { ?>
							
						<?php } elseif (date('d-m-Y H:i', strtotime($t->created_at)) <= date('d-m-Y H:i')) { ?>
							<?php
							$tugas_view = $this->db->get_where('tb_tugas_view', ['user' => $id_user, 'tugas' => $t->id_tugas])->num_rows();
							if ($tugas_view < 1) { ?>
								<li><a href="/student/tugas/<?= $t->slug ?>"><b><?= $t->tugas ?></b></a></li>
							<?php } ?>
						<?php } else { ?>
							<?php
							$tugas_view = $this->db->get_where('tb_tugas_view', ['user' => $id_user, 'tugas' => $t->id_tugas])->num_rows();
							if ($tugas_view < 1) { ?>
								<li><a href="#" title="Harap tunggu waktu tugas"><b><?= $t->tugas ?></b></a></li>
							<?php } ?>
						<?php } ?>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>