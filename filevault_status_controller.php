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
    * Retrieve FileVault status
    *
    * @return JSON object
    * @author tuxudo
    **/
    public function get_filevault_status()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Filevault_status_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `filevault_status` = 1 AND `filevault_status` <> '' THEN 1 END) AS 'On',
                        COUNT(CASE WHEN `filevault_status` = 0 AND `filevault_status` <> '' THEN 1 END) AS 'Off',
                        COUNT(CASE WHEN `filevault_status` IS NULL THEN 1 WHEN `filevault_status` = '' THEN 1 END) AS 'Unknown'
                        FROM filevault_status
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve auth restart supported
    *
    * @return JSON object
    * @author tuxudo
    **/
    public function get_auth_restart_support()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Filevault_status_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `auth_restart_support` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `auth_restart_support` = 0 THEN 1 END) AS 'no',
                        COUNT(CASE WHEN `auth_restart_support` IS NULL THEN 1 END) AS 'unknown'
                        FROM filevault_status
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve if institutional recovery key is present supported
    *
    * @return JSON object
    * @author tuxudo
    **/
    public function get_institutional_recovery_key()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Filevault_status_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `has_institutional_recovery_key` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `has_institutional_recovery_key` = 0 THEN 1 END) AS 'no',
                        COUNT(CASE WHEN `has_institutional_recovery_key` IS NULL THEN 1 END) AS 'unknown'
                        from filevault_status
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve if personal recovery key is present
    *
    * @return JSON object
    * @author tuxudo
    **/
    public function get_personal_recovery_key()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Filevault_status_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `has_personal_recovery_key` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `has_personal_recovery_key` = 0 THEN 1 END) AS 'no',
                        COUNT(CASE WHEN `has_personal_recovery_key` IS NULL THEN 1 END) AS 'unknown'
                        FROM filevault_status
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve conversion state of HFS drives
    *
    * @return JSON object
    * @author tuxudo
    **/
    public function get_conversion_state()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Filevault_status_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `fv_progress_status` = '%Encryption%' THEN 1 END) AS 'encrypting',
                        COUNT(CASE WHEN `fv_progress_status` = '%Decryption%' THEN 1 END) AS 'decrypting',
                        COUNT(CASE WHEN `fv_progress_status` = 'FileVault is Off, but needs to be restarted to finish.' THEN 1 WHEN `fv_progress_status` = 'FileVault is On, but needs to be restarted to finish.' THEN 1 END) AS 'restart'
                        FROM filevault_status
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
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
