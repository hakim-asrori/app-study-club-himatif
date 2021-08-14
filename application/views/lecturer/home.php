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
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Peserta</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success" id="peserta"><?= $peserta ?></span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Pemateri</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash3"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info" id="pemateri"><?= $pemateri ?></span></li>
			</ul>
		</div>
	</div>
</div>

<script>
	load()
	function load() {
		$.ajax({
			url: "/ajax/inlecturer",
			type: "get",
			success: function (response) {
				let res = JSON.parse(response);
				for (let key in res) {
					if (res.hasOwnProperty(key)) {
						let val = res[key];

						$("#pemateri").html(val['pemateri'])
						$("#peserta").html(val['peserta'])
					}
				}
			}
		});
	}
</script>