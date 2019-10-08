#!/bin/bash

# filevault_status_controller
FV_CTL="${BASEURL}index.php?/module/filevault_status/"

# Get the scripts in the proper directories
"${CURL[@]}" "${FV_CTL}get_script/filevaultstatus" -o "${MUNKIPATH}preflight.d/filevaultstatus" \

# Check exit status of curl
if [ $? = 0 ]; then
	# Make script executable
	chmod a+x "${MUNKIPATH}preflight.d/filevaultstatus"

	# Set preference to include this file in the preflight check
	setreportpref "filevault_status" "${CACHEPATH}filevault_status.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/filevaultstatus"
    
	# Set the exit status
	ERR=1
fi

