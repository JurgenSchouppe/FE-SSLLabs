#!/bin/bash

http_proxy=$proxyIP:$ProxyPort
export http_proxy
HOMEDIR=/data/sslscan

TMPDIR=$HOMEDIR/tmp
SCANDIR=$HOMEDIR/scans
SCANCMD=$HOMEDIR/bin/ssllabs-scan
JQCMD=/usr/bin/jq
JQGRADEFILTER=".[0].endpoints[0].grade"

HOSTS=$(cd $SCANDIR; ls -1d *)

for site in $HOSTS; do
        echo "Processing $site"
        echo "$site" > $TMPDIR/site.$$.txt
        scandate=$(date +"%Y%m%d-%H%M%S")
        scanresult=$($SCANCMD -hostfile $TMPDIR/site.$$.txt 2>$TMPDIR/scanerror.$$.txt)
        res=$?
        if [ $res -ne 0 ]; then
                echo "Error scanning $site ($res)"
                cat $TMPDIR/scanerror.$$.txt
                continue
        fi
        echo "Scanning $site complete"
        grade=$(echo "$scanresult" | $JQCMD $JQGRADEFILTER)
        grade=${grade//\"/}
        echo "$scanresult" > $SCANDIR/$site/$scandate.json
        if [ -e $SCANDIR/$site/latest.json ]; then
                ln -fs $(readlink $SCANDIR/$site/latest.json) $SCANDIR/$site/previous.json
        fi
        ln -fs $SCANDIR/$site/$scandate.json $SCANDIR/$site/latest.json
        echo "$grade" > $SCANDIR/$site/$scandate.grade
        if [ -e $SCANDIR/$site/latest.grade ]; then
                ln -fs $(readlink $SCANDIR/$site/latest.grade) $SCANDIR/$site/previous.grade
        fi
        ln -fs $SCANDIR/$site/$scandate.grade $SCANDIR/$site/latest.grade
done
rm $TMPDIR/site.$$.txt
rm $TMPDIR/scanerror.$$.txt
