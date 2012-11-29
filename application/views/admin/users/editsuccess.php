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
                <div class="alert alert-success">Пользователь сохранен<br/><br/><a href="/admin/users">вернуться</a></div>
            </div>
        </div>
<script type="text/javascript">
function redirect()
{
    location.replace("/admin/users");
}
var temp = setInterval("redirect()", 2000);
</script>