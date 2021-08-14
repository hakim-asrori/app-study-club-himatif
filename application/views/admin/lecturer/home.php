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
					<label for="mhs">Tambah Pemateri</label>
					<input type="text" id="mhs" name="mhs" class="form-control" placeholder="Input nama/nim mahasiswa">
					<input type="hidden" id="nim" class="form-control">
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
								<th>Nama Mahasiswa</th>
								<th>Email</th>
								<th>Kelas</th>
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

		xhr.open("GET", "/ajax/lecturerget", true);
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
								let mahasiswa_cell = NewRow.insertCell(0); 
								let email_cell = NewRow.insertCell(1); 
								let kelas_cell = NewRow.insertCell(2); 
								let opsi_cell = NewRow.insertCell(3); 

								mahasiswa_cell.innerHTML = val['nama_lengkap']; 
								email_cell.innerHTML = val['email']; 
								kelas_cell.innerHTML = val['kelas']; 
								opsi_cell.innerHTML = '<button onclick="hapus('+ val['id_user'] +')" class="btn btn-danger">Hapus</button>'; 

							}
						}
					}
				}
			}
		};
		xhr.send();
	}

	function hapus(user) {
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
					url: "/ajax/lecturerdestroy",
					type: "post",
					data: {user: user},
					success: function (response) {
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
			let nim = $("#nim").val().trim();

			if (nim != '') {
				$.ajax({
					url: "/ajax/lectureradd",
					type: "post",
					data: {nim: nim},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal('Wooww!', 'Data berhasil di input!', 'success'));
							$("#mhs").val('')
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