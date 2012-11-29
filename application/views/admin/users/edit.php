		<div id="content-header">
			<h1><? echo $this->config->item('title'); ?></h1>
		</div>
		<div id="breadcrumb">
			<a href="/"><i class="icon-home"></i> Главная</a>
			<a href="/admin">Панель администратора</a>
			<a href="/admin/users" class="current">Пользователи</a>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<?php echo validation_errors(); ?>
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="icon-align-justify"></i>									
							</span>
							<h5><? echo $this->config->item('title'); ?></h5>
						</div>
						<div class="widget-content nopadding">
							<form action="" method="post" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="text" name="email" value="<?php echo set_value('email', (isset($user['EMAIL'])) ? $user['EMAIL'] : ''); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Пароль</label>
									<div class="controls">
										<input type="text" name="password" value="<?php echo set_value('password'); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Группа</label>
									<div class="controls">
										<select name="group">
											<option value="0" <?php echo set_select('group', 0, (isset($user['GROUP']) && $user['GROUP'] === '0') ? true : false); ?>>Пользователь</option>
											<option value="99" <?php echo set_select('group', 99, (isset($user['GROUP']) && $user['GROUP'] == '99') ? true : false); ?>>Администратор</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Фамилия</label>
									<div class="controls">
										<input type="text" name="fname" value="<?php echo set_value('fname', (isset($user['FNAME'])) ? $user['FNAME'] : ''); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Имя</label>
									<div class="controls">
										<input type="text" name="lname" value="<?php echo set_value('lname', (isset($user['LNAME'])) ? $user['LNAME'] : ''); ?>"/>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" name="submit" value="add" class="btn btn-primary">Сохранить</button>
	                                <?if(isset($user['ID'])):?>
	                                    <a href="/admin/deleteuser/<?=$user['ID']?>" class="btn btn-danger delete-user"><i class="icon-remove icon-white"></i> Удалить</a>
	                                <?endif;?>
								</div>
							</form>
						</div>
					</div>						
				</div>
			</div>
		</div>
        <script>
        $(function() {
            $('.delete-user').live('click',function(){
                if (confirm("Удалить запись?"))
                    return true;
                else
                    return false;
            });
        });
        </script>