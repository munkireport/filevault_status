// FileVault Status formatters and filters for URL hash support

// FileVault Status filter
var filevault_status_filter = function(colNumber, d) {
    
    // Look for 'filevault_on' keyword
    if (d.search.value.match(/^filevault_on$/)) {
        // Add column specific search - numeric comparison
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'filevault_off' keyword
    if (d.search.value.match(/^filevault_off$/)) {
        // Add column specific search - numeric comparison
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'filevault_unknown' keyword
    if (d.search.value.match(/^filevault_unknown$/)) {
        // For unknown, search for empty strings, NULL, or values that are not "0" or "1"
        d.columns[colNumber].search.value = '^(?!0$|1$).*';
        d.columns[colNumber].search.regex = true;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// Auth restart support filter (TINYINT column - can use numeric values)
var auth_restart_support_filter = function(colNumber, d) {
    
    // Look for 'auth_restart_supported' keyword
    if (d.search.value.match(/^auth_restart_supported$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'auth_restart_not_supported' keyword  
    if (d.search.value.match(/^auth_restart_not_supported$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'auth_restart_unknown' keyword
    if (d.search.value.match(/^auth_restart_unknown$/)) {
        // Search for values that are not 0 or 1 using a simpler pattern
        d.columns[colNumber].search.value = '^(?!0$|1$).*';
        d.columns[colNumber].search.regex = true;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// Institutional Recovery Key filter (TINYINT column - can use numeric values)
var institutional_recovery_key_filter = function(colNumber, d) {
    
    // Look for 'has_institutional_key' keyword
    if (d.search.value.match(/^has_institutional_key$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'no_institutional_key' keyword  
    if (d.search.value.match(/^no_institutional_key$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'institutional_key_unknown' keyword
    if (d.search.value.match(/^institutional_key_unknown$/)) {
        // Search for values that are not 0 or 1 using a simpler pattern
        d.columns[colNumber].search.value = '^(?!0$|1$).*';
        d.columns[colNumber].search.regex = true;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// Personal Recovery Key filter (TINYINT column - can use numeric values)
var personal_recovery_key_filter = function(colNumber, d) {
    
    // Look for 'has_personal_key' keyword
    if (d.search.value.match(/^has_personal_key$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'no_personal_key' keyword  
    if (d.search.value.match(/^no_personal_key$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'personal_key_unknown' keyword
    if (d.search.value.match(/^personal_key_unknown$/)) {
        // Search for values that are not 0 or 1 using a simpler pattern
        d.columns[colNumber].search.value = '^(?!0$|1$).*';
        d.columns[colNumber].search.regex = true;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// Bootstrap Token Supported filter (TINYINT column - can use numeric values)
var bootstraptoken_supported_filter = function(colNumber, d) {
    
    // Look for 'bootstraptoken_supported' keyword
    if (d.search.value.match(/^bootstraptoken_supported$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'bootstraptoken_not_supported' keyword  
    if (d.search.value.match(/^bootstraptoken_not_supported$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'bootstraptoken_unknown' keyword
    if (d.search.value.match(/^bootstraptoken_unknown$/)) {
        // For unknown, use IS NULL to match NULL values in the database
        d.columns[colNumber].search.value = 'IS NULL';
        d.columns[colNumber].search.regex = false;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// Bootstrap Token Escrowed filter (TINYINT column - can use numeric values)
var bootstraptoken_escrowed_filter = function(colNumber, d) {
    
    // Look for 'bootstraptoken_escrowed' keyword
    if (d.search.value.match(/^bootstraptoken_escrowed$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'bootstraptoken_not_escrowed' keyword  
    if (d.search.value.match(/^bootstraptoken_not_escrowed$/)) {
        // Add column specific search - TINYINT column can use numeric value
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'bootstraptoken_escrowed_unknown' keyword
    if (d.search.value.match(/^bootstraptoken_escrowed_unknown$/)) {
        // For unknown, use IS NULL to match NULL values in the database
        d.columns[colNumber].search.value = 'IS NULL';
        d.columns[colNumber].search.regex = false;
        d.columns[colNumber].search.smart = false;
        // Clear global search
        d.search.value = '';
    }
}

// FileVault Status formatter
var formatFileVaultStatus = function(col, row) {
    var cell = $('td:eq('+col+')', row),
        value = cell.text().trim();
    
    switch (value) {
        case '1':
            value = mr.label(i18n.t('on'), 'success');
            break;
        case '0':
            value = mr.label(i18n.t('off'), 'danger');
            break;
    }
    
    cell.html(value);
}

// Yes/No formatter for boolean fields
var formatYesNo = function(col, row) {
    var cell = $('td:eq('+col+')', row),
        value = cell.text().trim();
    
    switch (value) {
        case '1':
            value = mr.label(i18n.t('yes'), 'success');
            break;
        case '0':
            value = mr.label(i18n.t('no'), 'danger');
            break;
    }
    
    cell.html(value);
}

// Institutional Recovery Key formatter (inverted logic - yes = danger, no = success)
var formatInstitutionalRecoveryKey = function(col, row) {
    var cell = $('td:eq('+col+')', row),
        value = cell.text().trim();
    
    switch (value) {
        case '1':
            value = mr.label(i18n.t('yes'), 'danger');
            break;
        case '0':
            value = mr.label(i18n.t('no'), 'success');
            break;
    }
    
    cell.html(value);
}

// Crypto Users formatter
var formatCryptoUsers = function(col, row) {
    var cell = $('td:eq('+col+')', row),
        value = cell.text().trim();
    console.log(value)
    if (value != ""){
        var crypto_users = []
        $.each(JSON.parse(value), function(i,d){
            if (d['user_name'] != ""){
                crypto_users.push(d['user_name'])
            }
        })
    }

    cell.html(crypto_users);
} 