		<div id="content-header">
			<h1><? echo $this->config->item('title'); ?></h1>
		</div>
		<div id="breadcrumb">
			<a href="/"><i class="icon-home"></i> Главная</a>
			<a href="/admin">Панель администратора</a>
			<a href="/admin/category" class="current">Разделы</a>
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
							<h5>Раздел "<?=$ccategory['NAME']?>"</h5>
						</div>
						<div class="widget-content nopadding">
							<form action="" method="post" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Название раздела</label>
									<div class="controls">
										<input type="text" name="category-name" value="<?php echo set_value('category-name', $ccategory['NAME']); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ЧПУ код</label>
									<div class="controls">
										<input type="text" name="category-code" value="<?php echo set_value('category-code', $ccategory['CODE']); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Раздел</label>
									<div class="controls">
										<select name="category-parent">
											<?if(isset($category) && count($category) > 0):?>
												<?foreach($category as $value):?>
													<?if($value['ID'] != $ccategory['ID']):?>
														<option value="<?=$value['ID']?>" <?php echo set_select('category-parent', $value['ID'], $ccategory['PARENT_ID']); ?>><?=$value['NAME'];?></option>
													<?endif;?>
												<?endforeach;?>
											<?endif;?>
										</select>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" name="submit" value="save" class="btn btn-primary">Сохранить</button>
								</div>
							</form>
						</div>
					</div>						
				</div>
			</div>
		</div>