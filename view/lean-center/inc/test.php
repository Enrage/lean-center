<?php defined('LEAN') or die('Access Denied');
$get_test = $this->get_test();
if(isset($_GET['test_id'])) $test_id = (int)$_GET['test_id'];
$post = $this->get_post();
?>
<div id="content">
	<?php if ($_GET['view'] == 'test' && !isset($_GET['test_id'])): ?>

	<?php foreach ($content as $item): ?>
	<h3><a href="?view=test&amp;test_id=<?=$item['id']?>"><?=$item['test_name']?></a></h3>
	<?php endforeach ?>

	<?php else: ?>

	<?php if(isset($get_test)): ?>
		<?php if(is_array($get_test)): ?>
		<section class="tests">
			<h2>Тестирование</h2>

			<article class="test">
				<h3 class="ntest">Тест по бережливому производству №<span id="test_id"><?=$test_id?></span></h3>
					<?php foreach($get_test as $id_question => $item): ?>
					<div class="question" data-id="<?=$id_question?>" id="question-<?=$id_question?>">
						<?php foreach($item as $id_answer => $answer): ?>
							<?php if(!$id_answer): ?>
							<p class="q"><?=$answer?></p>
							<?php else: ?>
							<p class="a">
								<?php if ($id_answer != 'value'): ?>
								<input type="radio" name="question-<?=$id_question?>" id="answer-<?=$id_answer?>" value="<?=$id_answer?>">
								<label for="answer-<?=$id_answer?>"><?=$answer?></label>
								<?php endif ?>
							</p>
							<?php endif; ?>
						<?php endforeach; // $item ?>
					</div>
					<?php endforeach; // $res ?>
				<div class="next_button">
					<button class="next_q">Следующий вопрос</button>
				</div>
			</article>

			<?=$this->nav()?>

			<div class="buttons">
				<button class="btn2" id="btn">Закончить тест</button>
				<!-- <input type="submit" name="submit_test" value="Закончить тест" class="btn" id="btn"> -->
			</div>

		</section>

		<div class="result"><?php $post ?></div>
		<?php else: // is_array($this->get_test()) ?>
		<p>Тест в разработке.</p>
		<?php endif // is_array($this->get_test()) ?>
	<?php else: ?>
		<p>Выберите тест.</p>
	<?php endif; ?>

	<?php endif ?>
</div> <!-- #content -->
