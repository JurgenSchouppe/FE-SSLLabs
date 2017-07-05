# FE-SSLLabs -  A front-end application for SSL labs
#               Written by jurgen Schouppe
              please feel free to contribute 

The program is based on the outbut (Json files) generated by the sslscan scripts of qualys labs (ssllabs-scan)

The basics are quite simple:

1 : Create a directory (inside the $HOMEDIR/scans directory) with as name the FQDN for each site that you want to test.
2 : The scan.sh will populate these directories with a json file and create a symbolic link for the latest scan, this link (name) will be used by our front end applcation in order to retreive the right arrays.
3 : change the 2 variables ($PROXYIP & $PROXYPORT inside the scan.sh file with your own proxy settings.
4 : this scan.sh script can be launched once a week or once a day depending on yur personal needs with crontab for instance.
5 : from that moment on, the only thing that you need is taht our webserver has access to the $HOMEDIR/scans directory 


