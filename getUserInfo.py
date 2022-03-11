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

def getTotalFollowers(api, user_id):
    """
    Returns the list of followers of the user.
    It should be equivalent of calling api.getTotalFollowers from InstagramAPI
    """

    followers = []
    next_max_id = True
    while next_max_id:
        # first iteration hack
        if next_max_id is True:
            next_max_id = ''

        _ = api.getUserFollowers(user_id, maxid=next_max_id)
        followers.extend(api.LastJson.get('users', []))
        next_max_id = api.LastJson.get('next_max_id', '')
    return followers

def writeFollowersToDB(api, username, followers):
    d = {}
    d['accountName'] = username
    d['accountId'] = api.username_id
    d['followers'] = []
    
    for follower in followers:
        d['followers'].append(follower['username'])
    
    req = requests.post(databasePath + "followers", json=d)
        
def writePostsToDB(api, username, feed):
    d = {}
    
    for f in feed:
#        d['postId'] = f['code']
        d['postId'] = f['pk']
        d['postURL'] = f['image_versions2']['candidates'][1]['url']
        d['accountName'] = api.username
        d['accountId'] = api.username_id
        d['commenters'] = []
        
        req = requests.post(databasePath + "posts", json=d)

if __name__ == "__main__":
#    print(sys.argv)
    if(len(sys.argv) == 3):
        igusername = sys.argv[1]
        igpassword = sys.argv[2]
        
        api = InstagramAPI(igusername, igpassword)
        api.login()
        user_id = api.username_id
        
        print(user_id)
        
        # Save followers to database
        myFollowers = getTotalFollowers(api, user_id)
        writeFollowersToDB(api, igusername, myFollowers)
#        print(igusername + " has " + str(len(myFollowers)) + " followers")
        
        # Save posts data to database
        feed = api.getTotalSelfUserFeed()
        writePostsToDB(api, igusername, feed)
    
    else:
        api = InstagramAPI(igusername, igpassword)
        api.login()
    
