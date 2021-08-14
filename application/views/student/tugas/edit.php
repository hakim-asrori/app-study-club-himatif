<style type="text/css">
	#info {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	hr {
		margin: 10px 0;
	}

	.card-head {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	@media (max-width: 567px) {
		#info {
			flex-direction: column;
		}
	}
</style>
<div class="bg-title">
	<h2 class="page-title" id="title1"><b><?= $tugas->tugas ?></b></h2>

	<hr>
	<div id="info">
		<ul class="library col-lg-6">
		</ul>
		<button class="btn btn-warning" onclick="history.back(-1)">Kembali</button>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<center>
			<?= $tugas->soal ?>
		</center>

		<form action="/ajax/jawabanedit" method="post">
			<div class="form-group">
				<label for="jawaban">Ketik atau upload jawaban anda dibawah ini</label>
				<textarea name="jawaban" id="jawaban" class="form-control"><?= $jawaban->jawaban ?></textarea>
				<input type="hidden" required name="tugas" value="<?= $jawaban->tugas ?>">
			</div>
			<button class="btn btn-success">Simpan</button>
		</form>
	</div>
</div>

<script src="/assets/text-editor/editor.js"></script>