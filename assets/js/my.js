$(document).ready(function(){

	$('#mhs').autocomplete({
		source: "/ajax/lecturerusers",
	});

	$('#mhs').change(function()
	{
		let nim = $(this).val().split(" ", 1);
		$('#nim').val(nim);
	});

	$('#dataTables').DataTable();
	$('#calender').fullCalendar()

});