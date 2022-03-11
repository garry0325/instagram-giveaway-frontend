from InstagramAPI import InstagramAPI
import json
import sys
import datetime as dt
import os
import requests

igusername = "iggiveaway295"
igpassword = "instagramgiveaway295p"
writeFilePath = ""
databasePath = "http://localhost:8088/"

def getPost(api, postId):
    
    commenters = []
    comments = []
    timestamps = []
    
    api.getMediaComments(postId)
    
    for comment in api.LastJson['comments']:
        commenters.append(comment['user']['username'])
        comments.append(comment['text'])
        timestamps.append(comment['created_at_utc'])
        
    return (commenters, comments, timestamps)

def writeCommentersToDB(api, postId, commenters, comments, timestamps):
    d = {}
    d['postOwner'] = api.username
    d['accountId'] = api.username_id
    d['postId'] = postId
    d['postURL'] = postId
    
    for i in range(0, len(commenters)):
        d['accountName'] = commenters[i]
        d['content'] = comments[i]
        d['timestamp'] = int(timestamps[i])
        req = requests.post(databasePath + "comments", json=d)
    
    postData = requests.get(databasePath + "posts/" + postId)
    
    p = {}
    p['postId'] = postId
    p['postURL'] = json.loads(postData.content)['postURL']
    p['accountName'] = api.username
    p['accountId'] = api.username_id
    p['commenters'] = commenters
    
    req = requests.post(databasePath + "posts", json=p)
    
        
def extractPostUrlId(posturl):
    if('/' in posturl):
        posturl = posturl.split('/')
        posturl = posturl[-1] if len(posturl[-1]) > len(posturl[-2]) else posturl[-2]
    
    return posturl


if __name__ == "__main__":
    print(sys.argv)
    if(len(sys.argv) == 4):
        igusername = sys.argv[1]
        igpassword = sys.argv[2]
        igpostId = sys.argv[3]
#        igposturl = extractPostUrlId(sys.argv[3])
        
        api = InstagramAPI(igusername, igpassword)
        api.login()
        
        commenters, comments, timestamps = getPost(api, igpostId)
        writeCommentersToDB(api, igpostId, commenters, comments, timestamps)
        
    else:
        api = InstagramAPI(igusername, igpassword)
        api.login()
    
