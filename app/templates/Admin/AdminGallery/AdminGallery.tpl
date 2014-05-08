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

        </div>
        <div class="col-md-10">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{$l_allgallerycategories}</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>     
                                <th>#</th>
                                <th>{$l_categoryname}</th>
                                <th>{$l_totalpicturenumber}</th>
                                <th>{$l_seoname}</th>
                                <th>{$l_activegallery}</th>
                                <th>{$l_changeorder}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$gallery_category name=catname item=category}
                                <tr> 
                                    <td><a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_uploadGalleryPhotos}/{$category.id}"><i class="fa fa-plus-square"></i></a></td>
                                    <td><a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_uploadGalleryPhotos}/{$category.id}">{$category.name}</a></td>
                                    <td>{$category.total}</td>                                    
                                    <td>{$category.slug}</td>
                                    <td>
                                        {if $category.active eq 1}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicktohide}" class="label label-success"><a class="text-white changeVisibility" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_AdminGalleryChangeStatus}/{$category.id}">{$l_yes}</a></span>
                                            {else}
                                            <span data-toggle="tooltip" data-placement="right" title="{$l_clicltomakeublic}" class="label label-danger"><a class="text-white changeVisibility" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_AdminGalleryChangeStatus}/{$category.id}">{$l_no}</a></span>
                                            {/if}
                                    </td>
                                    <td data-id="{$category.id}" class="order-change">
                                        {if not $smarty.foreach.catname.last}
                                            <a  class="changeorder categoryDown" ><i class="fa fa-arrow-down"></i></a>
                                            {else}
                                            <a class="changeorder" ><i class="fa fa-minus"></i></a>

                                        {/if}
                                        {if not $smarty.foreach.catname.first}
                                            <a  class="changeorder categoryUp" ><i class="fa fa-arrow-up"></i></a>
                                            {else}
                                            <a class="changeorder"  ><i class="fa fa-minus"></i></a>

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