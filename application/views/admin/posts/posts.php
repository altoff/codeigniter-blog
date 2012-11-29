        <div id="content-header">
            <h1><? echo $this->config->item('title'); ?></h1>
        </div>
        <div id="breadcrumb">
            <a href="/"><i class="icon-home"></i> Главная</a>
            <a href="/admin">Панель администратора</a>
            <a href="/admin/posts" class="current">Записи</a>
        </div>
        <div class="container-fluid">
            <?if(isset($posts) && count($posts) > 0):?>
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
                                            <th width="5%">ID</th>
                                            <th>Название</th>
                                            <th>Код</th>
                                            <th>Раздел</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach($posts as $value):?>
                                            <tr>
                                                <td><?=$value['POST_ID']?></td>
                                                <td><?=$value['POST_NAME']?></td>
                                                <td><?=$value['POST_CODE']?></td>
                                                <td>
                                                    <?=(isset($category[$value['POST_CATEGORY']]['NAME'])) ? $category[$value['POST_CATEGORY']]['NAME'] : 'Раздел не найден' ;?>
                                                </td>
                                                <td nowrap><a href="/admin/editpost/<?=$value['POST_ID']?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a> <a href="/admin/deletepost/<?=$value['POST_ID']?>" class="btn btn-danger delete-post"><i class="icon-remove icon-white"></i></a></td>
                                            </tr>
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
        $('.delete-post').live('click',function(){
            if (confirm("Удалить запись?"))
                return true;
            else
                return false;
        });
        $('.data-table').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "oLanguage": {
                "sLengthMenu":      "Выводить по _MENU_",
                "sZeroRecords":     "Ничего не найдено",
                "sInfo":            "Показано с _START_ по _END_ из _TOTAL_ результатов",
                "sInfoEmpty":       "0 результатов",
                "sInfoFiltered":    "(filtered from _MAX_ total records)",
                "oPaginate": {
                    "sFirst":           "Начало",
                    "sLast":            "Конец",
                    "sNext":            "Вперед",
                    "sPrevious":        "Назад"
                },
                "sSearch":          "Поиск:"
            }
        });
    });
</script>