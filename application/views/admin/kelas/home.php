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

<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label for="kelas">Tambah Kelas</label>
					<?= createToken() ?>
					<input type="text" id="kelas" class="form-control" placeholder="Format : D3TI.1C">
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
								<th>Kelas</th>
								<th>Mahasiswa</th>
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

		xhr.open("GET", url + "kelas", true);
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
								let kelas_cell = NewRow.insertCell(0); 
								let mahasiswa_cell = NewRow.insertCell(1); 
								let opsi_cell = NewRow.insertCell(2); 

								kelas_cell.innerHTML = val['kelas']; 
								mahasiswa_cell.innerHTML = '<span class="badge badge-success" style="text-transform: lowercase;">'+val['mahasiswa']+' mahasiswa</span>'; 
								opsi_cell.innerHTML = '<button onclick="hapus('+ val['id_kelas'] +')" class="btn btn-danger">Hapus</button>'; 

							}
						}
					}
				}
			}
		};
		xhr.send();
	}

	function hapus(kelas) {
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
					url: url+"kelas",
					type: "delete",
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

	$(document).ready(function () {

		$("#tambah").on("click", function () {
			let kelas = $("#kelas").val().trim();

			if (kelas != '') {
				$.ajax({
					url: url + "kelas",
					type: "post",
					data: {kelas: kelas},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal('Wooww!', 'Data berhasil di input!', 'success'));
							$("#kelas").val('')
							load();
						} else {
							$("#pesan").html(swal('Ooops!', 'Data gagal di input!', 'error'));
						}
					}
				});
			} else {
				$("#pesan").html(swal('Ooops!', 'Kelas tidak boleh kosong!', 'error'));
			}
		})

	})
</script>