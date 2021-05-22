<div class="col-lg-4 col-md-6">
    <div class="card" id="filevault_auth_restart_support-widget">
        <div id="filevault_auth_restart_support-widget" class="card-header" data-container="body" data-i18n="[title]filevault_status.auth_restart_support">
            <i class="fa fa-arrow-circle-right"></i> 
            <span data-i18n="filevault_status.auth_restart_support"></span>
            <a href="/show/listing/filevault_status/filevault_status" class="pull-right"><i class="fa fa-list"></i></a>
        </div>
        <div class="card-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/filevault_status/get_auth_restart_support', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#filevault_auth_restart_support-widget div.card-body'),
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
