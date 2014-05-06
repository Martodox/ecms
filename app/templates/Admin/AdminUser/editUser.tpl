<div class="modal-dialog">
    <div class="modal-content form-modal">

        <div class="modal-header bg-light-blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 id="notify-here" class="modal-title" id="myModalLabel">{$l_userbeeingedited}: <b>{$user.first_name} {$user.last_name}</b></h4>
        </div>

            <div class="modal-body">

                <div class="box-body">
                    <div class="row">

                        <div class="form-group col col-lg-6">
                            <label for="email">{$l_emailaddress}</label>
                            <input type="text" name="emailaddress" class="form-control" id="email" value="{$user.email}" placeholder="{$l_emailaddress}">
                        </div>

                        <div class="form-group col col-lg-2">
                            <label for="level">{$l_level}</label>
                            <select name="level" id="level" class="form-control">
                                {for $lv=1 to 10}
                                    <option {if $lv eq $user.level}selected="true"{/if} >{$lv}</option>
                                {/for}
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col col-lg-6">
                            <label for="email">{$l_firstname}</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" value="{$user.first_name}" placeholder="{$l_firstname}">
                        </div>
                        <div class="form-group col col-lg-6">
                            <label for="email">{$l_lastname}</label>
                            <input type="text" name="lastname" class="form-control" id="email" value="{$user.last_name}" placeholder="{$l_lastname}">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="form-group col col-lg-6">
                            <label for="newpassword">{$l_newpassword}</label>
                            <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="{$l_newpassword}">
                        </div>
                        <div class="form-group col col-lg-6">
                            <label for="repeatnewpassword">{$l_repeatnewpassword}</label>
                            <input type="password" name="repeatnewpassword" class="form-control" id="repeatnewpassword" placeholder="{$l_repeatnewpassword}">
                        </div>
                    </div>


                </div><!-- /.box-body -->


            </div>
            <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
            <input type="hidden" name="removeemail" value="{$user.email}">
            <div class="modal-footer">
                <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_ajaxRemoveUser}" data-toggle="tooltip" data-placement="left" title="jakies info" id="button-remove" type="button" class="btn btn-danger pull-left">{$l_removeuser}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{$l_close}</button>
                <button data-id="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminSaveUser}" id="button-add" type="button" class="btn btn-primary">{$l_save}</button>
            </div>

    </div>
</div>
<script>

    $('#button-remove').bindSubmit();

</script>