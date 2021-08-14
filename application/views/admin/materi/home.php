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
						<th>Materi</th>
						<th>Dibuat</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($materi as $m): ?>
					<tr>
						<th><?= $no++ ?></th>
						<td><?= $m->materi ?></td>
						<td><?= $m->desc_study ?></td>
						<td><a href="/materi/view/<?= $m->slug ?>" class="btn btn-info">Lihat Materi</a></td>
						<td><?= date('d F Y H:i:s', strtotime($m->created_at)) ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</div>