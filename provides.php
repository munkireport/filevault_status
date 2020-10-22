<?php

return array(
    'client_tabs' => array(
        'filevault-status-tab' => array('view' => 'filevault_status_tab', 'i18n' => 'filevault_status.filevault_info', 'badge' => 'filevault-status-cnt'),
    ),
    'listings' => array(
        'filevault_status' => array('view' => 'filevault_status_listing', 'i18n' => 'filevault_status.filevault_info'),
    ),
    'reports' => array(
        'filevault_status_report' => array('view' => 'filevault_status_report', 'i18n' => 'filevault_status.filevault_report'),
    ),
    'widgets' => array(
        'filevault_status' => array('view' => 'filevault_status_widget', 'i18n' => 'filevault_status.filevault_status'),
        'auth_restart_support' => array('view' => 'auth_restart_support_widget', 'i18n' => 'filevault_status.auth_restart_support'),
        'institutional_recovery_key' => array('view' => 'institutional_recovery_key_widget', 'i18n' => 'filevault_status.has_institutional_recovery_key'),
        'personal_recovery_key' => array('view' => 'personal_recovery_key_widget', 'i18n' => 'filevault_status.has_personal_recovery_key'),
        'conversion_state' => array('view' => 'conversion_state_widget', 'i18n' => 'filevault_status.conversion_state'),
        'bootstraptoken_supported' => array('view' => 'bootstraptoken_supported', 'i18n' => 'filevault_status.bootstraptoken_supported'),
        'bootstraptoken_escrowed' => array('view' => 'bootstraptoken_escrowed', 'i18n' => 'filevault_status.bootstraptoken_escrowed'),
    )
);
