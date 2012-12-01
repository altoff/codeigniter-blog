<?php echo validation_errors(); ?>
<form class="form-horizontal" action="" method="post">
	<div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
		<div class="controls">
			<input type="text" name="inputEmail" id="inputEmail" placeholder="Email" value="<?php echo set_value('inputEmail'); ?>"/>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Восстановить</button>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<a href="/personal/auth/" class="navbar-link">Авторизация</a> | <a href="/personal/reg/" class="navbar-link">Регистрация</a>
		</div>
	</div>
</form>