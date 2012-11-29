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
							<h5>Добавить раздел</h5>
						</div>
						<div class="widget-content nopadding">
							<form action="" method="post" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Название раздела</label>
									<div class="controls">
										<input type="text" name="category-name" value="<?php echo set_value('category-name'); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ЧПУ код</label>
									<div class="controls">
										<input type="text" name="category-code" value="<?php echo set_value('category-code'); ?>"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Раздел</label>
									<div class="controls">
										<select name="category-parent">
											<?if(isset($category) && count($category) > 0):?>
												<?foreach($category as $value):?>
													<option value="<?=$value['ID']?>" <?php echo set_select('category-parent', $value['ID']); ?>><?=$value['NAME'];?></option>
												<?endforeach;?>
											<?endif;?>
										</select>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" name="submit" value="add" class="btn btn-primary">Добавить</button>
								</div>
							</form>
						</div>
					</div>						
				</div>
			</div>
			<?if(isset($category) && count($category) > 0):?>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<h5>Разделы</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Название</th>
											<th>Код</th>
											<th width="5%"></th>
										</tr>
									</thead>
									<tbody>
										<?foreach($category as $value):?>
											<?if($value['ID'] != 0):?>
											<tr>
												<td><?=$value['ID']?></td>
												<td><?=$value['NAME']?></td>
												<td><?=$value['CODE']?></td>
												<td nowrap><a href="/admin/categoryedit/<?=$value['ID']?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a> <a href="/admin/categorydelete/<?=$value['ID']?>" class="btn btn-danger delete-category"><i class="icon-remove icon-white"></i></a></td>
											</tr>
											<?endif;?>
										<?endforeach;?>
									</tbody>
								</table>  
							</div>
						</div>
					</div>
				</div>
			<?endif;?>
		</div>
<script>
	$(document).ready(function(){
		$('.delete-category').live('click',function(){
			if (confirm("Удалить категорию?"))
				return true;
			else
				return false;
		});
		$('.data-table').dataTable({
			"bSort": false,
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<""l>t<"F"fp>',
			"oLanguage": {
				"sLengthMenu": 		"Выводить по _MENU_",
				"sZeroRecords": 	"Ничего не найдено",
				"sInfo": 			"Показано с _START_ по _END_ из _TOTAL_ результатов",
				"sInfoEmpty": 		"0 результатов",
				"sInfoFiltered": 	"(filtered from _MAX_ total records)",
				"oPaginate": {
					"sFirst": 			"Начало",
					"sLast": 			"Конец",
					"sNext": 			"Вперед",
					"sPrevious": 		"Назад"
				},
				"sSearch": 			"Поиск:"
			}
		});
	});
</script>