import Adafruit_DHT as dht
import urllib2
h,t = dht.read_retry(dht.DHT22,4)
temp=round(t,2)
humidity=round(h,2)
resp=urllib2.urlopen("http://argo-assist.rnxgsggs.com/dht22.php?humidity="+humidity+"&temperature="+temperature)
resp.read()
