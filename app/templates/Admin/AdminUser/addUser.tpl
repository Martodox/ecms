<div class="modal-dialog">
    <div class="modal-content form-modal">

        <div class="modal-header bg-light-blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 id="notify-here" class="modal-title" id="myModalLabel">{$l_addUserModal}</h4>
        </div>

        <div class="modal-body" id="userData">

            <div class="box-body">
                <div class="row">

                    <div class="form-group col col-lg-6">
                        <label for="email">{$l_emailaddress}</label>
                        <input data-validate="email-ajax" autocomplete="false" type="text" name="emailaddress" class="form-control" id="email" placeholder="{$l_emailaddress}">
                    </div>

                    <div class="form-group col col-lg-6">
                        <label for="level">{$l_level}</label>
                        <select name="level" id="level" class="form-control">
                            <option value="10">{$l_accountTypeAdmin}</option>
                            <option value="7">{$l_accountTypeMod}</option>
                            <option value="5">{$l_accountTypeEditor}</option>
                            <option value="1">{$l_accountTypeNormal}</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-lg-6">
                        <label for="firstname">{$l_firstname}</label>
                        <input data-validate-range="3|50" type="text" name="firstname" class="form-control" id="firstname" placeholder="{$l_firstname}">
                    </div>
                    <div class="form-group col col-lg-6">
                        <label for="lastname">{$l_lastname}</label>
                        <input data-validate-range="3|50" type="text" name="lastname" class="form-control" id="lastname" placeholder="{$l_lastname}">
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="form-group col col-lg-6">
                        <label for="newpassword">{$l_newpassword}</label>
                        <input data-validate-match="repeatnewpassword" data-validate-range="5|50" type="password" name="newpassword" class="form-control" id="newpassword" placeholder="{$l_newpassword}">
                    </div>
                    <div class="form-group col col-lg-6">
                        <label for="repeatnewpassword">{$l_repeatnewpassword}</label>
                        <input data-validate-match="newpassword" data-validate-range="5|50" type="password" name="repeatnewpassword" class="form-control" id="repeatnewpassword" placeholder="{$l_repeatnewpassword}">
                    </div>
                </div>


            </div><!-- /.box-body -->


        </div>
        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{$l_close}</button>
            <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminSaveUser}" type="button" class="btn btn-primary useraddbutton" id="button-submit">{$l_add}</button>
        </div>

    </div>
</div>

<script>

    $('#userData').simpleValidator();
    $('#button-submit').bindSubmit();
</script>
