#!/bin/bash
 
 
url="www.rybnikowo.pl"
date=`date +'%FT%k:%M:%S+00:00'`
freq="weekly"
prio="0.5"
 
rm sitemap.xml
 
list=`wget -r --delete-after $url --reject=.rss.gif,.png,.jpg,.css,.js,.txt,.ico 2>&1 |grep "\-\-"  |grep http | awk '{ print $3 }'`
array=($list)
 
echo ${#array[@]} "pages detected for $url" 
 
echo '<?xml version="1.0" encoding="UTF-8"?> 
   <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' >> sitemap.xml;
   for ((i=0;i<${#array[*]};i++)); do
        echo "<url>
        <loc>${array[$i]:0}</loc>
        <priority>$prio</priority>
        <lastmod>$date</lastmod>
        <changefreq>$freq</changefreq>
   </url>" >> sitemap.xml
   done
echo "</urlset>" >> sitemap.xml
 
#notify google
wget  -q --delete-after http://www.google.com/webmasters/tools/ping?sitemap=http://$url/sitemap.xml
 
rm -r ${url}
exit 0
