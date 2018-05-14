import urllib
import json
import urllib.request
val = 14024020001
print("Starting Downloads")
#user_agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64)'
headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'}
url = "http://picasaweb.google.com/data/entry/api/user/"+str(val)+"@umt.edu.pk?alt=json"
for i in range(1,1000):
    try:
        req = urllib.request.Request(url,headers = headers)
        #req.add_header('Client',user_agent)
        html = urllib.request.urlopen(req)
        html = html.read().decode("utf-8")
        js = json.loads(html)
        print(json.dumps(js['entry']['gphoto$thumbnail']['$t'], indent=4, sort_keys=True))
        path = js['entry']['gphoto$thumbnail']['$t']
        urllib.request.urlretrieve(str(path), "images/"+str(val)+".jpg")
        val+=1
        url = "http://picasaweb.google.com/data/entry/api/user/"+str(val)+"@umt.edu.pk?alt=json"
    except:
        print("Error")
        val+=1
        url = "http://picasaweb.google.com/data/entry/api/user/"+str(val)+"@umt.edu.pk?alt=json"
