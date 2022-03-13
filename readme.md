Installed Environment:
    Python 3.8.2
    Aapche 2.4.52
    PHP 8.1.2

Python Scripts:
    
    getUserInfo.py
        > python3 getUserInfo.py [igusername] [igpassword]
    
    getCommenters.py
        > python3 getCommenters.py [igusername] [igpassword] [igpostId]
    

Web Scripts:
    
    login.html
        First page where user put their instagram username and password
        
    select.php
        Second page where user gets to choose 'followers' or 'posts'
        
    followers.php
        Directed by select.php, runs getFollowers.py which generates .json file. followers.php then reads this .json file and shows all the followers
        
    posts.php
        Shows the posts of the user. Runs getFollowers.py which generates .jsonp file. posts.php then reads this .jsonp file and shows all the posts. Each posts is an image with hyperlink to its post at instagram.com


For followers.php and posts.php to properly run and save the json file, the running folder might need to change permission to allow access to everyone.
