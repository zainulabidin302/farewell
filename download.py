import urllib
import json
import urllib.request
val = 14024020050
for i in range(1,50):
    html = urllib.request.urlopen("http://picasaweb.google.com/data/entry/api/user/"+str(val)+"@umt.edu.pk?alt=json")
    html = html.read().decode("utf-8")
    js = json.loads(html)
    print(json.dumps(js['entry']['gphoto$thumbnail']['$t'], indent=4, sort_keys=True))
    path = js['entry']['gphoto$thumbnail']['$t']
    urllib.request.urlretrieve(str(path), "images/"+str(val)+".jpg")
    val+=1