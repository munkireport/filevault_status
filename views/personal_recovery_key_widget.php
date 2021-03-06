<div class="col-lg-4 col-md-6">
    <div class="card" id="filevault_personal_recovery_key-widget">
        <div id="filevault_personal_personal_key-widget" class="card-header" data-container="body" data-i18n="[title]filevault_status.has_personal_recovery_key">
            <i class="fa fa-user"></i> 
            <span data-i18n="filevault_status.has_personal_recovery_key"></span>
            <a href="/show/listing/filevault_status/filevault_status" class="pull-right"><i class="fa fa-list"></i></a>
        </div>
        <div class="card-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/filevault_status/get_personal_recovery_key', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#filevault_personal_recovery_key-widget div.card-body'),
        baseUrl = appUrl + '/show/listing/filevault_status/filevault_status/';
        panel.empty();
        
        // Set blocks, disable if zero
        if(data.no != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.no+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.no+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        }
        if(data.unknown != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.unknown+'</span><br>'+i18n.t('unknown')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning disabled"><span class="bigger-150">'+data.unknown+'</span><br>'+i18n.t('unknown')+'</a>');
        }
        if(data.yes != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.yes+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.yes+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;&nbsp;</a>');
        }
    });

});

</script>
