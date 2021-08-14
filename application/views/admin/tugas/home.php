<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/admins">Home</a></li>
			<li><?= $title ?></li>
		</ol>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="dataTables">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Materi</th>
						<th>Bidang Study</th>
						<th>Sudah Selesai</th>
						<th>Materi</th>
						<th>Mulai</th>
						<th>Tutup</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($tugas as $t): ?>
					<?php $count = $this->db->get_where('tb_tugas_upload', ['tugas' => $t->id_tugas])->num_rows(); ?>
					<tr>
						<th><?= $no++ ?></th>
						<td><?= $t->tugas ?></td>
						<td><?= $t->desc_study ?></td>
						<td><a href="/admin/tugas-jawaban/<?= $t->slug ?>" class="btn btn-primary"><?= $count ?> Orang</a></td>
						<td><a href="/tugas/view/<?= $t->slug ?>" class="btn btn-info">Lihat Tugas</a></td>
						<td><?= date('d F Y H:i:s', strtotime($t->created_at)) ?></td>
						<td><?= date('d F Y H:i:s', strtotime($t->stop_at)) ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</div>