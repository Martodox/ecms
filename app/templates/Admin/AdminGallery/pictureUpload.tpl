{include file='AdminHead.tpl'}

<aside class="right-side">                

    <section class="content-header">
        <h1>{$l_youareaddinttocat}: {$catname}</h1>
    </section>

    <section class="content">


        <div class="col-md-3">

            <form id="upload" method="post" action="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxSimpleUpload}/{$g_vars.0}" enctype="multipart/form-data">


                <div id="drop" class="small-box bg-gray">
                    <div class="box-body">
                        <h4 class="pad">{$l_dropheretoupload}</h4>
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <input id="hiddenupload" type="file" name="upl" multiple />
                    </div>
                    <a id="dropbrowse" class="small-box-footer btn btn-primary btn-block">
                        {$l_browsefiles} <i class="fa fa-arrow-circle-right"></i>
                    </a>

                </div>
                <ul>

                </ul>

            </form>
        </div>

        <div id="picturelist" class="col-md-9">


            {foreach from=$gallerypictures item=picture}
                <div id="picture-{$picture.id}" class="col-lg-4 col-sm-6 col-xs-12">
                    <a class="removecontent" data-toggle="modal" data-target="#myModal" href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxShowEditPicture}/{$picture.id}">
                        <img alt="{$picture.filename}" src="{$rootpatch}storage/upload/gallery/{$picture.filename}" class="thumbnail removecontent img-responsive">
                    </a>
                </div>

            {/foreach}


        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    </section>
</aside>
{include file='AdminFoot.tpl'}