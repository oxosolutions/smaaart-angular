$(function(){

	/*$("textarea").wysihtml5({
		"html": true
	});*/
	//CKEDITOR.replace('editor1');
	$("#file-3").fileinput({
	    showUpload: false,
	    showCaption: false,
	    browseClass: "btn btn-primary btn-sm",
	    fileType: "any",
	        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
	});
}());
