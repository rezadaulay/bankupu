$(function() {
	var processing = false;
	$(".kamga").css("min-height", $(window).height() - 310);
    $("form.table-index a[setindex]").click(function(event) {
        event.preventDefault();
        $("input[childcheckbox]").prop("checked",
            false);
        $("form.table-index input[checkbox_" + $(this).attr("href") + "]").prop("checked", true);
		$("#indexaction").val($(this).attr("setindex"));
        return $("form.table-index").submit();
    });
    $("select#actionoption").change(function(event) {
        event.preventDefault();
		$("input[childcheckbox]").prop("checked",false);
		if($(this).val() !== ''){
			var href = $(this).find('option:selected').attr('href');
			if($(this).val() === 'preview')
				window.open(href, "_blank", "scrollbars=1,toolbar=0,location=0,menubar=0");
			else if($(this).val() === 'link')
				window.location.href = href;
			else{
				$("form.table-index input[checkbox_" + href + "]").prop("checked", true);
				if ($(this).val() === "publish") $("#indexaction").val(1);
				else if ($(this).val() === "pending") $("#indexaction").val(2);
				else if ($(this).val() === "reject") $("#indexaction").val(3);
				else if ($(this).val() === "delete") $("#indexaction").val(4);
				$("form.table-index").submit();
			}
		}
		return $(this).val('');
    });
	$("[restore_btn]").click(function(e){
		e.preventDefault();
		$("#confirm").modal().one("click", "#modalyes", function(e) {window.location=$("[restore_btn]").attr('href')});
	});
	$( "input[slug]" ).focusout(function() {
		return $(this).val($(this).val().replace(/[^\w ]+/g,'').replace(/ +/g,'-').toLowerCase());
	})
	$( "input[nospace]" ).focusout(function() {
		return $(this).val($(this).val().replace(/ /g, '_'));
	})
	$( "input[lowercase]" ).focusout(function() {
		return $(this).val($(this).val().toLowerCase());
	});
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
	$('.selectpicker').selectpicker();
	var $from_user = $('#from_user').data('selectpicker').$newElement;
	$from_user.on('hide.bs.dropdown', function() {
		var max_balance = $('#from_user').find("option:selected").data('balance');
		$('#transfer-amount').attr('max',max_balance);
		$('.upu-help strong').html(max_balance);
		$('.upu-help').removeClass('hide');
		//alert(max_balance);
	});
	/* $('#from_user').on('change', function(){
		var max_balance = $(this).find("option:selected").data('balance');
		alert(selected);
	  }); */
});