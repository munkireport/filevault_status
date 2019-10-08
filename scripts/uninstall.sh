#!/bin/bash

# Remove filevaultstatus script
rm -f "${MUNKIPATH}preflight.d/filevaultstatus"

# Remove the filevault_status.plist cache file
rm -f "${CACHEPATH}filevault_status.plist"

