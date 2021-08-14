<style type="text/css">
	.badge {
		text-transform: capitalize;
		padding: 5px 10px;
	}
</style>

<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/students">Home</a></li>
			<li><?= $title ?></li>
		</ol>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Judul Tugas</th>
						<th>Dimulai</th>
						<th>Ditutup</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($tugas as $t): ?>
					<?php
					$tugas_view = $this->db->get_where('tb_tugas_upload', ['user' => $id_user, 'tugas' => $t->id_tugas])->num_rows(); ?>
					<tr>
						<th><?= $no++ ?></th>
						<td><?= $t->tugas ?></td>
						<td><?= date("l, d F Y H:i a", strtotime($t->created_at)) ?></td>
						<td><?= date("l, d F Y H:i a", strtotime($t->stop_at)) ?></td>
						<td>
							<?php 
							if (date('d-m-Y H:i', strtotime($t->stop_at)) <= date('d-m-Y H:i')) { ?>
								<a href="/tugas/view/<?= $t->slug ?>" class="badge badge-info">Lihat Tugas</a> | 
								<div class="badge badge-danger">Waktu tugas habis</div>
							<?php } elseif (date('d-m-Y H:i', strtotime($t->created_at)) <= date('d-m-Y H:i')) { ?>
								<?php if ($tugas_view < 1) { ?>
									<a href="/student/tugas/work/<?= $t->slug ?>" class="badge badge-success">Mulai Kerjakan</a>
								<?php } else { ?>
									<a href="/student/tugas/edit/<?= $t->slug ?>" class="badge badge-warning">Edit</a>
								<?php } ?>
							<?php } else { ?>
								<div class="badge badge-warning">Tunggu waktu tugas</div>
							<?php } ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</div>