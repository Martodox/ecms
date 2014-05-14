{include file='AdminHead.tpl'}

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{$l_headerSettingsPremissions}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <ul>
            {foreach from=$components item=component key=key}
                <li>{$key} : {$component|@print_r}</li>
            {/foreach}
        </ul>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
{include file='AdminFoot.tpl'}