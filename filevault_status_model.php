<?php

use CFPropertyList\CFPropertyList;

class Filevault_status_model extends \Model {
    
    public function __construct($serial = '')
    {
        parent::__construct('id', 'filevault_status'); //primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial;
        $this->rs['filevault_status'] = '';
        $this->rs['filevault_users'] = '';
        $this->rs['auth_restart_support'] = null; // True or False
        $this->rs['fv_master_keychain'] = null; // True or False
        $this->rs['has_institutional_recovery_key'] = null; // True or False
        $this->rs['has_personal_recovery_key'] = null; // True or False
        $this->rs['using_recovery_key'] = null; // True or False
        $this->rs['conversion_percent'] = '';
        $this->rs['bytes_converted'] = '';
        $this->rs['volume_size'] = '';
        $this->rs['conversion_state'] = '';
        $this->rs['fv_progress_status'] = '';
        $this->rs['device_identifier'] = '';
        $this->rs['pvdeviceid'] = '';
        $this->rs['volume_name'] = '';
        $this->rs['lvf_uuid'] = '';
        $this->rs['lvg_uuid'] = '';
        $this->rs['pv_uuid'] = '';
        $this->rs['uuid'] = '';
        $this->rs['crypto_users'] = '';
        $this->rs['deferral_info'] = '';

        if ($serial) {
            $this->retrieve_record($serial);
        }
        
        $this->serial = $serial;
    }
    
    // ------------------------------------------------------------------------

    /**
     * Process data sent by postflight
     *
     * @param string data
     * @author gmarnin, rewritten by tuxudo
     **/
    public function process($data)
    {
        // If data is empty, throw error
        if (! $data) {
            throw new Exception("Error Processing FileVault Status Module Request: No data found", 1);
        } else if (substr( $data, 0, 30 ) != '<?xml version="1.0" encoding="' ) { // Else if old style text, process with old text based handler
         
            // Process copied from network model. Translate strings to db fields. needed? . error proof?
            $translate = array('fv_users = ' => 'filevault_users');

            // Clear any previous data we had
            foreach ($translate as $search => $field) {
                $this->$field = '';
            }
            // Parse data
            foreach (explode("\n", $data) as $line) {
                // Translate standard entries
                foreach ($translate as $search => $field) {
                    if (strpos($line, $search) === 0) {
                        $value = substr($line, strlen($search));

                        $this->$field = $value;
                        break;
                    }
                }
            } //end foreach explode lines
            $this->save();
        
        } else { // Else process with new XML handler
         
            // Process incoming filevault_status.plist
            $parser = new CFPropertyList();
            $parser->parse($data, CFPropertyList::FORMAT_XML);
            $plist = $parser->toArray();

            // Process each key, if it exists
            foreach (array('filevault_status', 'filevault_users', 'auth_restart_support', 'fv_master_keychain', 'has_institutional_recovery_key', 'has_personal_recovery_key', 'using_recovery_key', 'conversion_percent', 'bytes_converted', 'volume_size', 'conversion_state', 'fv_progress_status', 'device_identifier', 'pvdeviceid', 'volume_name', 'lvf_uuid', 'lvg_uuid', 'pv_uuid', 'uuid', 'filevault_users', 'crypto_users', 'deferral_info') as $item) {

                // If key does not exist in $plist, null it
                if ( ! array_key_exists($item, $plist)) {
                    $this->$item = null;
                } else if ($item == "crypto_users") {
                // Process the crypto users into a JSON
                    
                    $this->$item = json_encode($plist[$item]);
                    
                } else {
                // Set the db fields
                    $this->$item = $plist[$item];
                }
            }
            
            // Save the data, we needs it
            $this->save(); 
        }
    }
}
