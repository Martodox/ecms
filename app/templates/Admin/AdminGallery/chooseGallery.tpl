{include file='AdminHead.tpl'}

<aside class="right-side">                

    <section class="content-header">
        <h1>{$l_gallery} - {$l_categorylist}</h1>
    </section>

    <section class="content">


        <div class="col-md-10 col-md-offset-1">

            {foreach from=$categories item=cat}

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_uploadGalleryPhotos}/{$cat.id}" class="text-white">
                                    {$cat.name}
                                </a>
                            </h3>
                            <p>
                                {$cat.slug}
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_uploadGalleryPhotos}/{$cat.id}" class="small-box-footer">
                            {$l_addpicturestocategory} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            {/foreach}
        </div>

    </section>
</aside>
{include file='AdminFoot.tpl'}