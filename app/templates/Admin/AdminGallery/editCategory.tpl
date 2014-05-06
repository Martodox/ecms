<div class="modal-dialog">
    <div class="modal-content form-modal">

        <div class="modal-header bg-light-blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 id="notify-here" class="modal-title" id="myModalLabel">{$l_addgallerycat}</h4>
        </div>

        <div class="modal-body" id="userData">

            <div class="box-body">
                <div class="row">

                    <div class="form-group col col-lg-6">
                        <label for="categoryname">{$l_categoryname}</label>
                        <input data-validate="false" autocomplete="false" type="text" name="categoryname" class="form-control" value="{$editinfo.name}" id="categoryname" placeholder="{$l_categoryname}">
                    </div>
                    <div class="form-group col col-lg-6">
                        <label for="seoname">{$l_seoname}</label>
                        <input data-validate="false" autocomplete="false" type="text" name="seoname" class="form-control" value="{$editinfo.slug}" id="seoname" placeholder="{$l_seoname}">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
        <input type="hidden" id="catid" name="catid" value="{$editinfo.id}">
        <div class="modal-footer">
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxDelGalleryCat}/{$editinfo.id}" data-toggle="tooltip" data-placement="left" id="button-remove" type="button" class="btn btn-danger pull-left">{$l_removecategory}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">{$l_close}</button>
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxEditGalleryCat}" id="button-edit" type="button" class="btn btn-primary">{$l_save}</button>
        </div>

    </div>
</div>

<script>

    $('#button-remove').bindSubmit();
    $('#button-edit').bindSubmit();
</script>
