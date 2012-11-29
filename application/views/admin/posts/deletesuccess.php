        <div id="content-header">
            <h1><? echo $this->config->item('title'); ?></h1>
        </div>
        <div id="breadcrumb">
            <a href="/"><i class="icon-home"></i> Главная</a>
            <a href="/admin">Панель администратора</a>
            <a href="/admin/posts" class="current">Записи</a>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="alert alert-success">Запись удалена<br/><br/><a href="/admin/posts">вернуться</a></div>
            </div>
        </div>
<script type="text/javascript">
function redirect()
{
    location.replace("/admin/posts");
}
var temp = setInterval("redirect()", 2000);
</script>