import serial
import urllib2
ser = serial.Serial("/dev/ttyACM0",9600)
for i in range(1,2):
    s1=ser.readline()
moisture=str(s1)
resp=urllib2.urlopen("http://argo-assist.rnxgsggs.com/hygro.php?moisture="+mositure)
resp.read()
