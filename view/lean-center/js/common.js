$(document).ready(function() {

	// Top Slider
	$("#slider3").responsiveSlides({
    manualControls: '#slider3-pager',
    speed: 1800,
    pager: false,
    timeout: 5000,
    nav: false,
    prevText: "<",
    nextText: ">"
  });

	// Появление блока поиска
	$('.search').click(function() {
		$('.form_search').fadeToggle(600);
	});

	// Профиль пользователя
	$('.profile').click(function() {
		$('.profile_blok').fadeToggle(600);
	});

	/*$('#submit_comment').click(function(e) {
		e.preventDefault();
		var name = $(this).attr('data');
		var comment = $('#add_comment').val();
		var id = $(this).attr('class');
		console.log(comment);
		$.ajax({
			// url: 'index.php?view=article&id=' + id,
			url: './',
			type: 'POST',
			data: {name: name, comment: comment},
			success: function(res) {
				if(res) {
					$('#comment').append('<div class="block_comment"></div>');
					$('.block_comment:last-child').html('<p class="comment_author">' + name + '</p><p class="comment">' + comment + '</p>');
				}
				// $('.comment_author').text(name);
				// $('.comment').text(comment);
				// alert('Коммент добавлен');
			},
			error: function() {
				alert('Ошибка добавления комментария!');
			}
		});
	});*/

	// Исчезновение результата регистрации через 3 секунды
	$('.success').delay(5000).fadeOut('slow');
	$('.err').delay(5000).fadeOut('slow');

	// Удаление картинок
	$('.user_img').on('click', function() {
		var res = confirm('Подтвердите удаление');
		if(!res) return false;
		var img = $(this).attr('alt'); // Имя картинки
		$.ajax({
			url: 'index.php?view=settings&img=' + img,
			type: 'get',
			data: {img: img},
			success: function(res) {
				$('.img_profile').fadeOut(500, function() {
					$('.img_profile').empty().fadeIn(500).html(res);
				});
			},
			error: function() {
				alert('Error');
			}
		});
	});

	// Проверка на заполненность полей при регистрации
	$('#registr_form').submit(function() {
		var abort = false;
		var email = $('#reg_email');
		var pass = $('#reg_pass');
		if(email.val() === '' && pass.val() !== '') {
			$('.error').remove();
			email.after('<div class="error" style="position:absolute; top:-200px; margin:0 auto; width:270px;">Вы не заполнили email!</div>');
			abort = true;
		}
		if(pass.val() === '' && email.val() !== '') {
			$('.error').remove();
			pass.after('<div class="error" style="position:absolute; top:-200px; margin:0 auto; width:270px;">Вы не заполнили пароль!</div>');
			abort = true;
		} else if(email.val() === '' && pass.val() === '') {
			$('.error').remove();
			pass.after('<div class="error" style="position:absolute; top:-200px; margin:0 auto; width:270px;">Вы не заполнили email и пароль!</div>');
			abort = true;
		} else if(pass.val().length > 0 && pass.val().length < 6) {
			$('.error').remove();
			pass.after('<div class="error" style="position:absolute; top:-210px; margin:0 auto; width:270px;">Пароль должен содержать не менее 6 символов!</div>');
			abort = true;
		}
		if(abort) return false;
		else return true;
	});

	// Проверка email и пароль на правильность ввода
	/*var email = $('#reg_email');
	var pass = $('#reg_pass');
	var pattern_email = /^[a-z]+[a-z0-9\._-]?[a-z0-9\.]+@[a-z0-9]+[a-z0-9-]?[a-z0-9]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
	$('#submit_reg').prop('disabled', true);
	email.blur(function() {
		if(email.val().search(pattern_email) !== 0) {
			email.css('boxShadow', '0 0 5px red');
			$('#submit_reg').prop('disabled', true);
		} else {
			email.css('boxShadow', '0 0 5px #55ff55');
			if(pass.val() !== '' && pass.val().length > 5) {
				$('#submit_reg').prop('disabled', false);
			}
		}
	});
	pass.blur(function() {
		if(pass.val() === '' || pass.val().length > 0 && pass.val().length < 6) {
			pass.css('boxShadow', '0 0 5px red');
			$('#submit_reg').prop('disabled', true);
		} else {
			pass.css('boxShadow', '0 0 5px #55ff55');
			if(email.val().search(pattern_email) === 0) {
				$('#submit_reg').prop('disabled', false);
			}
		}
	});*/

	$("a.single_image").fancybox();
	$('a.gallery_image').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		helpers: {
			overlay: {
				locked: false
			}
		}
	});
	$('a[rel=pictures]').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		helpers: {
			overlay: {
				locked: false
			}
		}
	});
});