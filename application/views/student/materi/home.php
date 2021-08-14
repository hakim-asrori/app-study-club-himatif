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
						<th>Judul Materi</th>
						<th>Pemateri</th>
						<th>Materi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($materi as $m): ?>
					<?php $materi_view = $this->db->get_where('tb_materi_view', ['materi' => $m->id_materi])->num_rows();
					if ($materi_view < 1) { ?>
						<tr class="bg-success text-white" title="Materi Baru">
						<?php } else { ?>
							<tr>
							<?php } ?>
							<td><strong><?= $no++ ?></strong></td>
							<td><?= $m->materi ?></td>
							<td><?= $m->nama_lengkap ?></td>
							<td><a href="/student/materi/<?= $m->slug ?>" class="btn btn-info">Lihat Materi</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>