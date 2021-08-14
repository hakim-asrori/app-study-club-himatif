<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/lecturers">Home</a></li>
			<li><?= $title ?></li>
		</ol>
	</div>
</div>
<?= $this->session->flashdata('message'); ?>
<div id="pesan2"></div>
<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label for="materi">Tambah Materi</label>
					<input type="text" id="materi" class="form-control" placeholder="">
				</div>
				<button id="tambah" class="btn btn-success">Tambah</button>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable">
						<thead>
							<tr>
								<th>Judul Materi</th>
								<th>Pemateri</th>
								<th>Materi</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	load();

	function load() {
		let xhr = new XMLHttpRequest();

		let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
		empTable.innerHTML = "";

		xhr.open("GET", "/ajax/materiget", true);
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let response = this.responseText;
				if (response) {
					if (this.readyState == 4 && this.status == 200) {

						let response = JSON.parse(this.responseText);

						for (let key in response) {
							if (response.hasOwnProperty(key)) {
								let val = response[key];

								let NewRow = empTable.insertRow(0); 
								let judul_cell = NewRow.insertCell(0); 
								let pemateri_cell = NewRow.insertCell(1); 
								let materi_cell = NewRow.insertCell(2); 
								let opsi_cell = NewRow.insertCell(3); 

								judul_cell.innerHTML = val['materi']; 
								pemateri_cell.innerHTML = val['nama_lengkap'];
								if (val['file'] == '' ) {
									materi_cell.innerHTML = '<span class="badge badge-danger">Silahkan edit materi untuk upload materi!</span>'; 
								} else {
									materi_cell.innerHTML = '<a href="/materi/view/'+val['slug']+'" target="_blank" class="btn btn-info">Lihat Materi</a>'; 
								}
								opsi_cell.innerHTML = '<a href="/lecturer/materi/'+val['slug']+'" class="btn btn-warning">Edit</a>';

								opsi_cell.innerHTML += ' | <button onclick="hapus('+ val['id_materi'] +')" class="btn btn-danger">Hapus</button>'; 

							}
						}
					}
				}
			}
		};
		xhr.send();
	}

	function hapus(materi) {
		swal({
			title: "Apakah anda yakin?",
			text: "Data ini akan dihapus!",
			icon: "warning",
			buttons: {
				cancel: "Batal",
				danger: {
					text: "Hapus",
				}
			},
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "/ajax/materidestroy",
					type: "post",
					data: {materi: materi},
					success: function (response) {
						console.log(response);
						if (response == 1) {
							swal("Selamat!", "Data anda berhasil dihapus", "success");
							load();
						} else {
							swal("Ooops", "Data gagal terhapus!", "error");
						}
					}
				});
			} else {
				swal("Ooops", "Data tidak jadi dihapus!", "error");
			}
		});
	}

	function upload(materi) {
		$("[name='id']").val(materi)
	}


	$(document).ready(function () {

		$("#tambah").on("click", function () {
			let materi = $("#materi").val().trim();

			if (materi != '') {
				$.ajax({
					url: "/ajax/materiadd",
					type: "post",
					data: {materi: materi},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal('Wooww!', 'Data berhasil di input!', 'success'));
							$("#pesan2").html('<div class="alert alert-danger" role="alert">Silahkan edit materi untuk upload materi!</div>')
							$("#materi").val('')
							load();
						} else {
							$("#pesan").html(swal('Ooops!', 'Data gagal di input!', 'error'));
						}
					}
				});
			} else {
				$("#pesan").html(swal('Ooops!', 'Materi tidak boleh kosong!', 'error'));
			}
		})

	})
</script>