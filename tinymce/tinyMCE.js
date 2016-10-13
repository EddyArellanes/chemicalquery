tinyMCE.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
		language : "es_MX",
		
		theme : "modern",
		
		
		
		plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imgsurfer"
    ],
    toolbar: "insertfile undo redo | styleselect fontselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | imgsurfer | sizeselect | fontselect | fontsizeselect",
	
		fontsize_formats: "8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt",			
		
		skin: "lightgray",
		
        keep_styles : false,
		
		width : 626,
		height : 200,
});