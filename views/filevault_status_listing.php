<?php $this->view('partials/head'); ?>

<?php //Initialize models needed for the table
new Machine_model;
new Reportdata_model;
new Filevault_status_model;
?>

<div class="container">
  <div class="row">
	<div class="col-lg-12">

	  <h3><span data-i18n="filevault_status.filevault_report"></span> <span id="total-count" class='label label-primary'>…</span></h3>

	  <table class="table table-striped table-condensed table-bordered">

		<thead>
		  <tr>
			<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
			<th data-i18n="serial" data-colname='reportdata.serial_number'></th>
			<th data-i18n="filevault_status.filevault_status_short" data-colname='filevault_status.filevault_status'></th>
			<th data-i18n="filevault_status.filevault_users_short" data-colname='filevault_status.filevault_users'></th>
			<th data-i18n="filevault_status.crypto_users_short" data-colname='filevault_status.crypto_users'></th>
			<th data-i18n="filevault_status.has_institutional_recovery_key_short" data-colname='filevault_status.has_institutional_recovery_key'></th>
			<th data-i18n="filevault_status.has_personal_recovery_key_short" data-colname='filevault_status.has_personal_recovery_key'></th>
			<th data-i18n="filevault_status.auth_restart_support_short" data-colname='filevault_status.auth_restart_support'></th>
			<th data-i18n="filevault_status.fv_progress_status_short" data-colname='filevault_status.fv_progress_status'></th>
		  </tr>
		</thead>

		<tbody>
		  <tr>
			<td data-i18n="listing.loading" colspan="8" class="dataTables_empty"></td>
		  </tr>
		</tbody>

	  </table>
	</div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                     d.mrColNotEmpty = "filevault_status";

                    // Check for column in search
                    if(d.search.value){
                        $.each(d.columns, function(index, item){
                            if(item.name == 'filevault_status.' + d.search.value){
                                d.columns[index].search.value = '> 0';
                            }
                        });

                    }
        		    // IDK what this does
                    if(d.search.value.match(/^\d+\.\d+(\.(\d+)?)?$/)){
                        var search = d.search.value.split('.').map(function(x){return ('0'+x).slice(-2)}).join('');
                        d.search.value = search;
                    }
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_filevault-status-tab');
	        	$('td:eq(0)', nRow).html(link);
                
                var colvar=$('td:eq(2)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('on') :
	        	(colvar === '0' ? i18n.t('off') : '')
	        	$('td:eq(2)', nRow).html(colvar)
                
                // Process stored JSON to extract usernames
                var colvar=$('td:eq(4)', nRow).html();
                if (colvar != ""){
                    var crypto_users = []
                    $.each(JSON.parse(colvar), function(i,d){
                        if (d['user_name'] != ""){
                            crypto_users.push(d['user_name'])
                        }
                    })
                    $('td:eq(4)', nRow).html(crypto_users.join(", "))
                } 
                
                var colvar=$('td:eq(5)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(5)', nRow).html(colvar)
                
                var colvar=$('td:eq(6)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(6)', nRow).html(colvar)
                
                var colvar=$('td:eq(7)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(7)', nRow).html(colvar)
		    }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
