	//Form Validate Function
function formValidate($form , newRules , newMessages , submitAction){
	var parentDiv = "div.field-div",
		errorDiv = "div.error";
	$form.validate({
		errorClass: "errormessage",
		focusInvalid: false,
		ignoreTitle: true,
		onkeyup: false,
		errorElement: 'em',
		errorClass: 'error-txt',
		validClass: 'valid',
		rules: newRules,
		messages: newMessages,
		onfocusout: function (element) {
			$(element).valid();
			$(element).parents(parentDiv).children('.help-txt').remove();
			$(element).parents(parentDiv).children('.error').css("display","block")
		},
		errorPlacement: function(error, element) {
			//error message position
			var parentEle = element.parents(parentDiv);
			var parentEleWdth = parentEle.width();
			parentEle.children(errorDiv).css("display","block").css("left",(parentEleWdth + 6) +"px");
			if(parentEle.children(errorDiv).has('span').length == 0){
				parentEle.children(errorDiv).append("<span></span>");
			}
			if(parentEle.children(errorDiv).has('strong').length == 0){
				parentEle.children(errorDiv).append("<strong></strong>");
			}
			//Append error message
			error.appendTo( parentEle.children(errorDiv));
			//Remove error message container
		},
		onfocusin: function (element) {
			var parentEleWdth = $(element).parents(parentDiv).width();
			var gtTitle = $(element).attr('title');
			$(element).parents(parentDiv).children('.help-txt').remove();
			if($(element).is( ":focus" )){
				if(!gtTitle == ''){
					$(element).parents(parentDiv).children(errorDiv).css("display","none")
					$(element).parents(parentDiv).append('<div class="help-txt" style="left:'+ (parentEleWdth + 6)+'px"><span></span><strong></strong>'+gtTitle+'</div>');
				}
			}
		},
		submitHandler: function() {
			submitAction();
		},
		success: function(label, element) {
			// set &nbsp; as text for IE
			//label.html("&nbsp;").addClass("checked");
			if(label.parent().children('em').length <= 1 ){
				label.parent().children('span').remove();
				label.parent(errorDiv).removeClass('haserror').addClass('success');
				label.remove();
			} else{
				label.remove();
			}
		},
		highlight: function (element, errorClass) {
			$(element).parents(parentDiv).children(errorDiv).addClass('haserror').removeClass('success');
		}
	});
}

//Initialize Qtip Dialog Box
function initDialog(contentDiv , titleTxt){
	$('<div/>').qtip({
		//id: 'login', // Since we're only creating one modal, give it an ID so we can style it
		content: {
			text: $(contentDiv),
			title: {
				text: titleTxt,
				button: $('<a class="qtip-close qtip-dialog-close"><strong>Close</strong><span></span></a>')
			}
		},
		position: {
			my: 'center', // ...at the center of the viewport
			at: 'center',
			target: $(window)
		},
		show: {
			event: 'click', // Show it on click...
			ready: true, // Show it immediately on page load.. force them to login!
			modal: {
				on: true,
				// Don't let users exit the modal in any way
				blur: false, escape: false
			}
		},
		hide: false,
		style: {
			classes: 'qtip-light qtip-rounded qtip-dialog',
			tip: false
		}
	});
};

function loadingStart(id) {
	$(id).removeClass('hidden');
}
function loadingStop(id){
	$(id).addClass('hidden');
}

function resetForm($form) {
	var id = '#' + $form.attr('id');
	$form.validate().resetForm();
	$form[0].reset();
	$(id +  " div.error").removeClass("haserror , success");
	$("select").uniform();//Reseting Select Uniform Value to Default
}
