<div class="col-lg-4 col-md-6">
    <div class="card" id="filevault_conversion_state-widget">
        <div id="filevault_conversion_state-widget" class="card-header" data-container="body" data-i18n="[title]filevault_status.conversion_state">
            <i class="fa fa-refresh"></i> 
            <span data-i18n="filevault_status.conversion_state"></span>
            <a href="/show/listing/filevault_status/filevault_status" class="pull-right"><i class="fa fa-list"></i></a>
        </div>
        <div class="card-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/filevault_status/get_conversion_state', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#filevault_conversion_state-widget div.card-body'),
        baseUrl = appUrl + '/show/listing/filevault_status/filevault_status/';
        panel.empty();
        
        // Set blocks, disable if zero
        if(data.decrypting != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.decrypting+'</span><br>'+i18n.t('filevault_status.decrypting')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.decrypting+'</span><br>'+i18n.t('filevault_status.decrypting')+'</a>');
        }
        if(data.restart != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.restart+'</span><br>'+i18n.t('filevault_status.restart')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning disabled"><span class="bigger-150">'+data.restart+'</span><br>'+i18n.t('filevault_status.restart')+'</a>');
        }
        if(data.encrypting != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.encrypting+'</span><br>'+i18n.t('filevault_status.encrypting')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.encrypting+'</span><br>'+i18n.t('filevault_status.encrypting')+'</a>');
        }
    });

});

</script>
