<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<script> 
    var csrf_token = $("input[name=csrf_token]").val();
    
    function dashbMenuPermission(checkList, user_id)
    {
        $.ajax({
            url : '<?= base_url("admin/dashboardMenuPermission/") ?>'+ user_id,
            type : 'POST',
            dataType : "json",
            async : false,
            data : {checkList : checkList, csrf_token},
            success : function(response) {
                if(response.err){
                    catchError(response.err);
                }
                if(response.msg){
                    catchSuccess(response.msg);
                }
                var i = 0;
                $.each(response['menuMaster'], function(index, myarr){
                    $("#dashboardMenuPermission").find("option[value="+response['menuPermitted'][i].menu_id+"]").prop("selected", "selected");
                    i++;
                });
            }
        });
    }
    var currentCheckList = [];
    function dashboardMenuPermission(currentCheck)
    {
        var menu_id = $('#dashboardMenuPermission').find(":selected").val();
        var checkList = $('#dashboardMenuPermission').val();
        var permission = 0;
        if(menu_id){
          permission = 1;
        }
        currentCheckList.push(permission);
        // console.log(checkList);
        var data = [{'checkList' : checkList, 'permission' : permission}];
        return data;
    }
    $(document).ready(function(){
        var List = "";
        dashbMenuPermission(List, <?= $this->uri->segment(2) ?>);
        $("#btnSubmit").click(function(){
            // var d = dashboardMenuPermission(currentCheck);
            // console.log(d);
            var checkList = $('#dashboardMenuPermission').val();
            dashbMenuPermission(checkList, <?= $this->uri->segment(2) ?>);
        });
        
    });
</script>