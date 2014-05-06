{include file='AdminHead.tpl'}

<aside class="right-side">                

    <section class="content-header">
        <h1>{$l_gallery} - {$l_categorylist}</h1>
    </section>

    <section class="content">

        <div class="col-md-2">

            <a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxAddGalleryCategory}" style="width: 90%;" class="btn btn-app removecontent" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
                {$l_addgallerycat}
            </a>
            {*            <button style="width: 90%;" class="btn btn-app">
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
            </button>*}
        </div>
        <div class="col-md-10">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{$l_allgallerycategories}</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody><tr>                        
                                <th>{$l_categoryname}</th>
                                <th>{$l_seoname}</th>
                                <th>{$l_activegallery}</th>
                                <th>{$l_changeorder}</th>
                                <th></th>
                            </tr>
                            {foreach from=$gallery_category name=catname item=category}
                                <tr>                           
                                    <td>{$category.name}</td>
                                    <td>{$category.slug}</td>
                                    <td>
                                        {if $category.active eq 1}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicktohide}" class="label label-success"><a class="text-white" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_AdminGalleryChangeStatus}/{$category.id}">{$l_yes}</a></span>
                                            {else}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicltomakeublic}" class="label label-danger"><a class="text-white" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_AdminGalleryChangeStatus}/{$category.id}">{$l_no}</a></span>
                                            {/if}
                                    </td>
                                    <td class="order-change">
                                        {if not $smarty.foreach.catname.last}
                                            <a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_moveCatDown}/{$category.id}"><i class="fa fa-arrow-down"></i></a>
                                            {else}
                                            <a><i class="fa fa-minus"></i></a>

                                        {/if}
                                        {if not $smarty.foreach.catname.first}
                                            <a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_moveCatUp}/{$category.id}"><i class="fa fa-arrow-up"></i></a>
                                            {else}
                                            <a><i class="fa fa-minus"></i></a>

                                        {/if}


                                    </td>
                                    <td><a class="btn btn-info btn-xs removecontent" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxEditGalleryCategory}/{$category.id}"  data-toggle="modal" data-target="#myModal">{$l_edit}</a></td>
                                </tr>
                            {/foreach}
                        </tbody></table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    </section>
</aside>
{include file='AdminFoot.tpl'}