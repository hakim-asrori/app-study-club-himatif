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
<a href="/lecturer/tugas/add" class="btn btn-primary m-b-15">Tambah</a>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="dataTable">
				<thead>
					<tr>
						<th>Judul Tugas</th>
						<th>Pemateri</th>
						<th>Sudah Selesai</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<script>
	load();

	function load() {
		let xhr = new XMLHttpRequest();

		let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
		empTable.innerHTML = "";

		xhr.open("GET", "/ajax/tugasget", true);
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
								let selesai_cell = NewRow.insertCell(2); 
								let opsi_cell = NewRow.insertCell(3); 

								judul_cell.innerHTML = val['tugas']; 
								pemateri_cell.innerHTML = val['nama_lengkap'];
								selesai_cell.innerHTML =  '<a href="/lecturer/tugas-source/'+ val['slug'] +'" class="btn btn-primary">'+val['selesai']+' Orang</a>';
								opsi_cell.innerHTML = '<a href="/tugas/view/'+ val['slug'] +'" class="btn btn-info" target="_blank">Lihat</a>'; 
								opsi_cell.innerHTML += ' | <a href="/lecturer/tugas/'+ val['slug'] +'" class="btn btn-warning">Edit</a>'; 
								opsi_cell.innerHTML += ' | <button onclick="hapus('+ val['id_tugas'] +')" class="btn btn-danger">Hapus</button>'; 

							}
						}
					}
				}
			}
		};
		xhr.send();
	}

	function hapus(tugas) {
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
					url: "/ajax/tugasdestroy",
					type: "post",
					data: {tugas: tugas},
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

</script>