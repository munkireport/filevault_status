FileVault Status module
=======================

Gathers FileVault users information by running various `fdesetup`, `diskutil`, and `profiles` command


Remarks
----

* Filevault status is no longer deprecated. It has been rewritten to support APFS and T2 Macs


Table Schema
----


The table provides the following information per 'machine':

* id (int) Unique id
* serial_number (string) Serial Number
* filevault_status (string) Status of FileVault (on/off)
* filevault_users (string) FileVault users
* auth_restart_support (boolean) If machines supports auth restarts
* fv_master_keychain (boolean) If FileVault Master Keychain is present
* has_institutional_recovery_key (boolean) If an institutional recovery key is set
* has_personal_recovery_key (boolean) If a personal recovery key is set
* using_recovery_key (boolean) If machine was booted using a recovery key (HFS, non-T2 only)
* conversion_percent (integer) Percent done with encryption/decryption (HFS, non-T2 only)
* bytes_converted (bigInt) How many bytes have been encryption/decrypted (HFS, non-T2 only)
* volume_size (bigInt) Size of volume in bytes (HFS only)
* conversion_state (string) State of conversion (HFS, non-T2 only)
* fv_progress_status (string) FileVault progress (HFS, non-T2 only)
* device_identifier (string) Device ID of FileVault volume (HFS only)
* pvdeviceid (string) Device ID of physical drive hosting FileVault volume (HFS only)
* volume_name (string) Name of FileVault volume (HFS only)
* lvf_uuid (string) Logical Volume Family UUID of FileVault volume (HFS only)
* lvg_uuid (string) Logical Volume Group UUID of FileVault volume (HFS only)
* pv_uuid (string) Physical Volume UUID of drive hosting FileVault volume (HFS only)
* uuid (string) CoreStorage UUID (HFS only)
* crypto_users (text) JSON string containing information about SecureToken enabled users (APFS only)
* deferral_info (text) Information about FileVault deferrals
* bootstraptoken_supported (boolean) If Bootstrap Token is supported (assigned to an MDM in ABM)
* bootstraptoken_escrowed (boolean) If the Bootstrap Token is escrowed on the MDM
