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
						<th>Nama Mahasiswa</th>
						<th>NIM</th>
						<th>Kelas</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($mahasiswa as $m): ?>
					<tr>
						<th><?= $no++ ?></th>
						<td><?= $m->nama_lengkap ?></td>
						<td><?= $m->nim ?></td>
						<td><?= $m->desc_kelas ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</div>