<?php

/**
 * Filevault_status module class
 *
 * @package munkireport
 * @author
 **/
class Filevault_status_controller extends Module_controller
{

    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author AvB
     **/
    public function index()
    {
        echo "You've loaded the filevault_status module!";
    }

    /**
     * Retrieve data in json format for filevault_escrow tab
     * (Will be removed once filevault_escrow tab is rewritten)
     *
     **/
    public function get_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        $filevault_escrow = new Filevault_escrow_model($serial_number);
        $filevault_status = new Filevault_status_model($serial_number);
        $disk_report = new Disk_report_model($serial_number);

        // Add relevant keys to escrow object
        $filevault_escrow->rs['filevault_status'] = $filevault_status->rs['filevault_status'];
        $filevault_escrow->rs['filevault_users'] = $filevault_status->rs['filevault_users'];
        
        $obj->view('json', array('msg' => $filevault_escrow->rs));
    }

    /**
     * Retrieve data in json format for filevault_status tab
     *
     **/
    public function get_status_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
        
        $sql = "SELECT filevault_status, filevault_users, auth_restart_support, fv_master_keychain, has_institutional_recovery_key, has_personal_recovery_key, using_recovery_key, fv_progress_status, conversion_percent, bytes_converted, volume_size, conversion_state, pvdeviceid, device_identifier, volume_name, pv_uuid, lvf_uuid, lvg_uuid, uuid, deferral_info, crypto_users
                        FROM filevault_status 
                        WHERE serial_number = '$serial_number'";
        
        $queryobj = new Filevault_status_model();
        $filevault_status_tab = $queryobj->query($sql);
        $obj->view('json', array('msg' => $filevault_status_tab)); 
    }

} // End class Filevault_status_controller
