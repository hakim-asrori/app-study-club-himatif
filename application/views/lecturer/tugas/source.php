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

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>Nama Lengkap</th>
						<th>NIM</th>
						<th>Kelas</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="lihatJawaban" tabindex="-1" aria-labelledby="lihatJawabanLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="lihatJawabanLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="jawaban"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	load();

	function load() {
		const xhr = new XMLHttpRequest();

		let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
		empTable.innerHTML = "";

		xhr.open("GET", "/ajax/jawabanget/<?= $this->uri->segment(3) ?>", true);
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						let NewRow = empTable.insertRow(0); 
						let nama_cell = NewRow.insertCell(0); 
						let kelas_cell = NewRow.insertCell(1); 
						let nim_cell = NewRow.insertCell(2); 
						let opsi_cell = NewRow.insertCell(3); 

						nama_cell.innerHTML = val['nama_lengkap']; 
						kelas_cell.innerHTML = val['nim'];
						nim_cell.innerHTML = val['desc_kelas'];
						opsi_cell.innerHTML = '<button class="btn btn-primary" onclick="lihat('+val['id_user']+')" data-toggle="modal" data-target="#lihatJawaban">Lihat</button>';
					}
				}
			}
		};
		xhr.send();
	}

	function lihat(user) {
		const xhr = new XMLHttpRequest();
		let data = new FormData();

		data.append('user', user);

		xhr.open("POST", "/ajax/jawabanview", true);

		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				let response = JSON.parse(this.responseText);
				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						$("#lihatJawabanLabel").html('Jawaban '+val['nama_lengkap'])
						$("#jawaban").html(val['jawaban'])
					}
				}
			}
		};

		xhr.send(data);
	}
</script>