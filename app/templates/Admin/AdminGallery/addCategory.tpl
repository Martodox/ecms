<div class="modal-dialog">
    <div class="modal-content form-modal">

        <div class="modal-header bg-light-blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 id="notify-here" class="modal-title" id="myModalLabel">{$l_addgallerycat}</h4>
        </div>

        <div class="modal-body" id="userData">

            <div class="box-body">
                <div class="row">

                    <div class="form-group col col-lg-12">
                        <label for="categoryname">{$l_categoryname}</label>
                        <input autocomplete="false" type="text" name="name" class="form-control" id="categoryname" placeholder="{$l_categoryname}">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{$l_close}</button>
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_ajaxSaveGalleryCat}" type="button" class="btn btn-primary useraddbutton" id="button-submit">{$l_add}</button>
        </div>

    </div>
</div>

<script>


    $('#button-submit').bindSubmit();
</script>
