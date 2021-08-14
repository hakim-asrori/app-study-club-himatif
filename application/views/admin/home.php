<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?= $title ?></h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><?= $title ?></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Peserta</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="text-success" id="peserta"></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Pemateri</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash2"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="text-info" id="pemateri"></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Bidang Study</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash3"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-primary"></i> <span class="text-primary" id="study"></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Materi</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash4"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="text-purple" id="materi"></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Tugas</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash1"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-warning"></i> <span class="text-warning" id="tugas"></span></li>
			</ul>
		</div>
	</div>
</div>

<script>
	$(function(){
		$.ajax({
			url: url + "/admin",
			type: "GET",
			dataType: "JSON",
			success: function(response) {
				$('#peserta').html(response.peserta);
				$('#pemateri').html(response.pemateri);
				$('#study').html(response.study);
				$('#materi').html(response.materi);
				$('#tugas').html(response.tugas);
			}
		})
	})
</script>