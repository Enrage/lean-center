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

	$('.test').find('div:first').show();

	$('.paginat a').on('click', function() {
		if($(this).attr('class') == 'nav-active') return false;

		var link = $(this).attr('href');
		var prevActive = $('.paginat > a.nav-active').attr('href');

		$('.paginat > a.nav-active').removeClass('nav-active');
		$(this).addClass('nav-active');

		$(prevActive).fadeOut(25, function() {
			$(link).fadeIn();
		});
		return false;
	});

	// Блокировка кнопки следующий вопрос на последнем вопросе
	$('.paginat a:last').on('click', function() {
		$('.next_q').attr('disabled', 'disabled');
	});

	// Разблокировка кнопки следующий вопрос на предыдущих вопросах
	$('.paginat a:not(:last)').on('click', function() {
		$('.next_q').removeAttr('disabled');
	});

	// Переход к следующему вопросу при нажатии на кнопку Следующий вопрос, кроме последнего
	$('.next_q').click(function() {
		var length = $('.paginat a').length - 1;
		$('.paginat a').each(function(index) {
			if($(this).hasClass('nav-active') && index != length) {
				$(this).removeClass('nav-active').next('a').addClass('nav-active');
				$('.question').fadeOut(25).eq(index+1).fadeIn();
				return false;
			} else if (index == length - 2) {
				$('.next_q').attr('disabled', 'disabled');
			}
		});
	});

	$('#btn').click(function() {
		var test = $('#test_id').text();
		var res = {'test':test};
		$('.question').each(function() {
			var id = $(this).data('id');
			res[id] = $('input[name=question-' + id + ']:checked').val();
		});
		$.ajax({
			url: 'index.php?view=test&test_id=1',
			type: 'POST',
			data: res,
			cache: false,
			success: function(res) {
				$('.result').html($(res).find('.result_test'));
				$('#btn').attr('disabled', 'disabled');

				$('.questions > .ok').each(function() {
					if($(this).text() === '') {
				    $(this).remove();
					}
				});
			},
			error: function() {
				alert('Error');
			}
		});
	});

	// Исчезновение результата регистрации через 5 секунд
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
		var name = $('#reg_name');
		var pass = $('#reg_pass');
		if(email.val() === '' || name.val() === '' || pass.val() === '') {
			$('.error_reg').remove();
			email.after('<div class="error_reg" style="position:absolute; top:-200px; margin:0 auto; width:270px;">Вы не заполнили обязательные поля!</div>');
			abort = true;
		} else if(pass.val().length > 0 && pass.val().length < 6) {
			$('.error_reg').remove();
			pass.after('<div class="error_reg" style="position:absolute; top:-210px; margin:0 auto; width:270px;">Пароль должен содержать не менее 6 символов!</div>');
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
