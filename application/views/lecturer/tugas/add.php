<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/lecturers">Home</a></li>
			<li><a href="/lecturer/tugas">Tugas</a></li>
			<li><?= $title ?></li>
		</ol>
	</div>
</div>

<?= createToken() ?>
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label>Judul Tugas</label>
					<input type="text" id="tugas" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Soal</label>
					<textarea id="soal" rows="10" class="form-control" required></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label>Tanggal Mulai</label>
					<input type="datetime-local" class="form-control" id="created_at" required>
				</div>
				<div class="form-group">
					<label>Tanggal Tutup</label>
					<input type="datetime-local" class="form-control" id="stop_at" required>
				</div>
				<div class="form-group">
					<button class="btn btn-success" id="simpan">Simpan</button>
					<a href="/lecturer/tugas" class="btn btn-danger">Batal</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/assets/text-editor/editor.js"></script>
<script>
	$(document).ready(function () {
		$('#simpan').on('click', function () {
			let tugas = $("#tugas").val().trim();
			let soal = CKEDITOR.instances.soal.getData();
			let created_at = $("#created_at").val().trim();
			let stop_at = $("#stop_at").val().trim();
			let csrf_name = $("input[name='csrf_name']").val().trim();

			if (tugas != '', soal != '', created_at != '', stop_at != '') {
				$.ajax({
					url: "/ajax/tugasadd",
					type: "post",
					data: {tugas: tugas, csrf_name: csrf_name, soal: soal, created_at: created_at, stop_at: stop_at},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal({
								title: 'Wooww!',
								text: 'Data berhasil di input!',
								icon: 'success' 
							}).then((success) => {
								location = '/lecturer/tugas'
							}));
						} else {
							$("#pesan").html(swal('Ooops!', 'Data gagal di input!', 'error'));
						}
					}
				});
			} else {
				$("#pesan").html(swal('Ooops!', 'Data tidak boleh kosong!', 'error'));
			}
		})

	})
</script>