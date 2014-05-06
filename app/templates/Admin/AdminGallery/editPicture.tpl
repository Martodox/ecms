<div class="modal-dialog">
    <div class="modal-content form-modal">

        <div class="modal-header bg-light-blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 id="notify-here" class="modal-title" id="myModalLabel">{$l_editsinglepicture}</h4>
        </div>

        <div class="modal-body" id="userData">

            <div class="box-body">
                <div class="col-lg-12">
                    <img alt="{$editinfo.filename}" src="{$rootpatch}storage/upload/gallery/{$editinfo.filename}" class="thumbnail img-responsive">
                </div>
                <div class="row">

                    <div class="form-group col col-lg-12">
                        <label for="description">{$l_picturedescription}</label>
                        <input data-validate="false" autocomplete="false" type="text" name="description" class="form-control" value="{$editinfo.description}" id="description" placeholder="{$l_picturedescription}">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
        <input type="hidden" id="catid" name="pictureid" value="{$editinfo.id}">
        <div class="modal-footer">
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxRemovePicture}/{$editinfo.id}" id="button-remove" type="button" class="btn btn-danger pull-left">{$l_removesinglepicture}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">{$l_close}</button>
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxEditGalleryCat}" id="button-edit" type="button" class="btn btn-primary">{$l_save}</button>
        </div>

    </div>
</div>
<script>

    $('#button-remove').delPictureBind();

</script>
