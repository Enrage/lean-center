$(document).ready(function() {

	// Подтверждение удаления
  $('.del_article a').click(function() {
    var res = confirm('Удалить?');
    if(!res) return false;
  });

	CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
});