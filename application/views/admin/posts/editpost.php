        <div id="content-header">
            <h1><? echo $this->config->item('title'); ?></h1>
        </div>
        <div id="breadcrumb">
            <a href="/"><i class="icon-home"></i> Главная</a>
            <a href="/admin">Панель администратора</a>
            <a href="/admin/posts" class="current">Записи</a>
        </div>
        <div class="container-fluid">
            <form action="" method="post" class="form-horizontal">
                <div class="row-fluid">
                    <?php echo validation_errors(); ?>
                </div>
                <div class="row-fluid">
                    <div class="span8">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-pencil"></i>
                                </span>
                                <h5><? echo $this->config->item('title'); ?></h5>
                            </div>
                            <div class="widget-content">
                                <div class="control-group">
                                    <label class="control-label">Название</label>
                                    <div class="controls">
                                        <input type="text" name="post-name" value="<?php echo set_value('post-name', (isset($post['POST_NAME'])) ? $post['POST_NAME'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">ЧПУ код</label>
                                    <div class="controls">
                                        <input type="text" name="post-code" value="<?php echo set_value('post-code', (isset($post['POST_CODE'])) ? $post['POST_CODE'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <textarea name="post-text"><?php echo set_value('post-text', (isset($post['POST_TEXT'])) ? $post['POST_TEXT'] : ''); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="widget-box">
                            <div class="widget-title">
                                <h5>Действия</h5>
                            </div>
                            <div class="widget-content">
                                <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Сохранить</button>
                                <?if(isset($post['POST_ID'])):?>
                                    <a href="/admin/deletepost/<?=$post['POST_ID']?>" class="btn btn-danger delete-post"><i class="icon-remove icon-white"></i> Удалить</a>
                                <?endif;?>
                            </div>
                        </div>
                        <div class="widget-box">
                            <div class="widget-title">
                                <h5>Настройки</h5>
                            </div>
                            <div class="widget-content">
                                <div class="control-group">
                                    <label class="control-label">Дата публикации</label>
                                    <div class="controls">
                                        <input type="text" name="post-date" data-date-language="ru" data-date="<?=date("Y-m-d")?>" data-date-format="yyyy-mm-dd" value="<?php echo set_value('post-date', (isset($post['POST_DATE'])) ? $post['POST_DATE'] : date("Y-m-d")); ?>" class="datepicker"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Раздел</label>
                                    <div class="controls">
                                        <select name="post-category">
                                            <?if(isset($category) && count($category) > 0):?>
                                                <?foreach($category as $value):?>
                                                    <?if($value['ID'] != '0'):?>
                                                        <option value="<?=$value['ID']?>" <?php echo set_select('post-category', $value['ID'], (isset($post['POST_CATEGORY']) && $value['ID'] == $post['POST_CATEGORY'] ) ? true : false ); ?>><?=$value['NAME'];?></option>
                                                    <?endif;?>
                                                <?endforeach;?>
                                            <?endif;?>
                                        </select>
                                    </div>
                                </div>
                                <?if(isset($users) && count($users) > 0):?>
                                <div class="control-group">
                                    <label class="control-label">Автор</label>
                                    <div class="controls">
                                        <select name="post-author">
                                            <?foreach($users as $value):?>
                                                <option value="<?=$value['ID']?>" <?php echo set_select('post-author', (isset($post['POST_USER'])) ? $post['POST_USER'] : $this->session->userdata('id')); ?>><?=$value['EMAIL'];?></option>
                                            <?endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <?endif;?>
                                <div class="control-group">
                                    <label class="control-label">Тэги</label>
                                    <div class="controls">
                                        <input type="text" name="post-tags" value="<?php echo set_value('post-tags', (isset($post['POST_TAGS'])) ? $post['POST_TAGS'] : ''); ?>">
                                    </div>
                                </div>   
                                <div class="control-group">
                                    <label class="control-label">Просмотры</label>
                                    <div class="controls">
                                        <input type="text" name="post-view" value="<?php echo set_value('post-view', (isset($post['POST_VIEW'])) ? $post['POST_VIEW'] : 0); ?>">
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
        $(function() {
            $('.delete-post').live('click',function(){
                if (confirm("Удалить запись?"))
                    return true;
                else
                    return false;
            });
            $('.datepicker').datepicker();
            $('textarea').redactor({
                focus: true,
                plugins: ['fullscreen','more'],
                minHeight: 200,
                lang : 'ru'
            });
        });
        </script>