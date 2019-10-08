<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="filevault_status-widget">
        <div id="filevault_status-widget" class="panel-heading" data-container="body" data-i18n="[title]filevault_status.filevault_status">
            <h3 class="panel-title"><i class="fa fa-lock"></i> 
                <span data-i18n="filevault_status.filevault_status"></span>
                <list-link data-url="/show/listing/filevault_status/filevault_status"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/filevault_status/get_filevault_status', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#filevault_status-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/filevault_status/filevault_status/';
        panel.empty();
        
        // Set blocks, disable if zero
        if(data.Off != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.Off+'</span><br>'+i18n.t('disabled')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.Off+'</span><br>'+i18n.t('disabled')+'</a>');
        }
        if(data.Unknown != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.Unknown+'</span><br>'+i18n.t('unknown')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning disabled"><span class="bigger-150">'+data.Unknown+'</span><br>'+i18n.t('unknown')+'</a>');
        }
        if(data.On != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.On+'</span><br>'+i18n.t('enabled')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.On+'</span><br>'+i18n.t('enabled')+'</a>');
        }
    });

});

</script>
