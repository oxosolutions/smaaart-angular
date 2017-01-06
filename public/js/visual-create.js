$(function(){
	$(".select2").select2();
	$("#visual *").attr("disabled", "disabled").off('click');
	$('#getColumns').click(function(){
		if($('select[name=dataset_id]').val() == ''){
			$('#mesg').html('Please select dataset!');
			$('#mesg').fadeIn(200);
			return false;
		}else{
			$('#mesg').html('Getting columns from selected dataset, this step may take 10 to 20 seconds!');
			$('#mesg').fadeIn(200);
		}

		// $(this).attr('disabled','disabled').off('click');
		$('#floatingBarsG').fadeIn(200);
		var fadeEffect = setInterval(function(){
			$('#mesg').fadeToggle(300);
		},500);
		var DatasetID = $('select[name=dataset_id]').val();
		$.ajax({
			url:route()+"/dataset/columns/"+DatasetID,
			success:function(res){
				$('.datasetColumns').html(res);
				$("#visual *").attr("disabled", false);
				$('#mesg').fadeOut(200);
				$('#floatingBarsG').fadeOut(200);
				$(".select2").select2();
				clearInterval(fadeEffect);
			}
		});
	});

	$('.select2').change(function(){
		$('#mesg').html('');
		$('#mesg').fadeOut(200);
	});

	if($('.model_id').val() != '' && $('.model_id').val() != undefined){
		$("#visual *").attr("disabled", false);
		$(".select2").select2();
	}
}());