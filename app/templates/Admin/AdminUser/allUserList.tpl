{include file='AdminHead.tpl'}
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{$l_allUserList}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
        {*        <div class="col-lg-12">
        <div class="col-lg-3 alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        Dane zmienione
        </div>
        </div>*}
        <div class="col-md-2">
            <!-- Button trigger modal -->
            <a href="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_ajaxUserAdd}" style="width: 90%;" class="btn btn-app removecontent" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
                {$l_addUserModal}
            </a>
            <button style="width: 90%;" class="btn btn-app">
                <i class="fa fa-trash-o"></i>
                {$l_removeSelected}
            </button>
            <button style="width: 90%;" class="btn btn-app">
                <i class="fa fa-unlock"></i>
                {$l_activateSelected}
            </button>
            <button style="width: 90%;" class="btn btn-app">
                <i class="fa fa-lock"></i>
                {$l_deactivateSelected}
            </button>
        </div>
        <div class="col-md-10">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{$l_headerUserList}</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody><tr>
                                <th style="width: 10px"></th>                             
                                <th>{$l_name}</th>
                                <th>{$l_surname}</th>
                                <th>Email</th>
                                <th>{$l_active}</th>
                                <th>{$l_level}</th>
                                <th></th>
                            </tr>
                            {foreach from=$allUsers item=user}
                                <tr>                           
                                    <td><input name="selectetUsers[]" value="{$user.id}" type="checkbox"></td>
                                    <td>{$user.first_name}</td>
                                    <td>{$user.last_name}</td>
                                    <td>{$user.email}</td>
                                    <td>
                                        {if $user.active eq 1}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicktodeactivate}" class="label label-success"><a class="text-white" href="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminChangeStatus}/{$user.id}">{$l_active}</a></span>
                                            {else}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicktoactivate}" class="label label-danger"><a class="text-white" href="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminChangeStatus}/{$user.id}">{$l_notactive}</a></span>
                                            {/if}
                                    </td>
                                    <td>{$user.level}</td>
                                    <td><a class="btn btn-info btn-xs removecontent" href="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_ajaxUserEdit}/{$user.id}"  data-toggle="modal" data-target="#myModal">{$l_edit}</a></td>
                                </tr>
                            {/foreach}

                        </tbody></table>
                </div><!-- /.box-body -->
            </div>

        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        </div>





    </section><!-- /.content -->
</aside><!-- /.right-side -->
<!-- Modal -->

{include file='AdminFoot.tpl'}