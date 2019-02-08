<div id="filevault-status-tab"></div>
<h2 data-i18n="filevault_status.filevault_info"></h2>

<script>
$(document).on('appReady', function(){
    
    // Set the tab badge to blank
    $('#filevault-status-cnt').html("");
    
	$.getJSON(appUrl + '/module/filevault_status/get_status_data/' + serialNumber, function(data){
        
        // Check if we have data
        if( data.length == 0 ){
            $('#filevault-status-tab').html('<div id="filevault-status-tab"></div><h2 data-i18n="filevault_status.filevault_info"></h2><h4><i class="fa fa-link"></i> '+i18n.t('filevault_status.no_data')+"</h4>");
        } else { 
        
            var skipThese = ['id','serial_number'];
            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                var crypto_users_rows = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        if (d[prop] == '' || d[prop] == null){
                            // Do nothing for empty values to blank them
                        } else if(prop.indexOf('bytes') > -1 || prop == "volume_size"){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+fileSize(d[prop], 2)+'</td></tr>';

                        } else if(prop == 'conversion_percent'){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+d[prop]+'% </td></tr>';
                        } else if(prop == 'deferral_info'){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+d[prop].replace(/;/g, "<br>")+'</td></tr>';

                        } else if(d[prop] == 'Converting'){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('filevault_status.converting')+'</td></tr>';
                        } else if(d[prop] == 'Complete'){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('filevault_status.complete')+'</td></tr>';

                        } else if(prop == 'filevault_status' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('on')+'</td></tr>';
                            // Set the tab badge
                            $('#filevault-status-cnt').text(i18n.t('on'))
                        } else if(prop == 'filevault_status' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('off')+'</td></tr>';
                            // Set the tab badge
                            $('#filevault-status-cnt').text(i18n.t('off'))
                        }

                        else if(prop == 'auth_restart_support' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if(prop == 'auth_restart_support' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                        }

                        else if(prop == 'fv_master_keychain' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if(prop == 'fv_master_keychain' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                        }

                        else if(prop == 'has_institutional_recovery_key' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if(prop == 'has_institutional_recovery_key' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                        }

                        else if(prop == 'has_personal_recovery_key' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if(prop == 'has_personal_recovery_key' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                        }
                        
                        else if(prop == 'using_recovery_key' && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if(prop == 'using_recovery_key' && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';

                        } else if(prop == "crypto_users"){
                            
                            // Build out crypto_users table
                            var crypto_users_data = JSON.parse(d[prop]);
                            
                            // Make the table framework
                            var crypto_users_rows = '<br/><h4 style="margin-top: 18px;">'+i18n.t('filevault_status.crypto_users')+'</h4><table class="table table-striped table-condensed"><tbody><thead><tr><th>'+i18n.t('username')+'</th><th>'+i18n.t('filevault_status.user_guid')+'</th><th>'+i18n.t('filevault_status.user_type')+'</th></tr></thead>'
                            
                            $.each(crypto_users_data, function(i,d){
                                // Generate rows from data
                                crypto_users_rows = crypto_users_rows + '<tr><td>'+d['user_name']+'</td><td>'+d['user_guid']+'</td><td>'+d['user_type']+'</td></tr>';
                            })
                            
                            crypto_users_rows = crypto_users_rows + '</tbody></table></td></tr>'; // Close audit table framework and append to rows

                        } else {
                            rows = rows + '<tr><th>'+i18n.t('filevault_status.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }

                $('#filevault-status-tab')
                    .append($('<div>')
                        .addClass('col-md-5')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows)))
                        .append(crypto_users_rows))
            })
        }
	});
});
</script>
