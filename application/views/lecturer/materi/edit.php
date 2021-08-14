<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/lecturers">Home</a></li>
			<li><a href="/lecturer/materi">Materi</a></li>
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
				<div class="form-group">
					<label>Judul Materi</label>
					<input type="text" class="form-control" id="materi" value="<?= $materi->materi ?>">
				</div>
				<input type="hidden" id="id" class="form-control" value="<?= $materi->id_materi ?>" required>
				<div class="form-group">
					<label>Materi</label>
					<textarea id="file" class="form-control" rows="10"><?= $materi->file ?></textarea>
				</div>
				<button class="btn btn-success" id="simpan">Simpan</button>
				<a href="/lecturer/materi" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</div>
</div>

<script src="/assets/text-editor/editor.js"></script>
<script>
	$(document).ready(function () {
		$('#simpan').on('click', function () {
			let materi = $("#materi").val().trim();
			let file = CKEDITOR.instances.file.getData();
			let id = $("#id").val().trim();

			if (materi != '', file != '', id != '') {
				$.ajax({
					url: "/ajax/materiupdate",
					type: "post",
					data: {materi: materi, file: file, id: id},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal({
								title: 'Wooww!',
								text: 'Data berhasil di input!',
								icon: 'success' 
							}).then((success) => {
								location = '/lecturer/materi'
							}));
						} else {
							$("#pesan").html(swal('Ooops!', 'Data gagal di input!', 'error'));
						}
					}
				});
			} else {
				$("#pesan").html(swal('Ooops!', 'Data tidak boleh kosong!', 'error'));
			}
		});
	})
</script>