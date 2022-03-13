Installed Environment:

    Python 3.8.2
    Aapche 2.4.52
    PHP 8.1.2

Python Scripts:
    
    getUserInfo.py
        > python3 getUserInfo.py [igusername] [igpassword]
        This python script gets the user's followers and posts list, and saves it to the database using the Java restful API. So when the user selects ‘follower’ after logging in, the webpage is able to show all the followers of this user; if the user selects ‘post’, it shows all the post images for the user to choose to establish a giveaway.
        
    getCommenters.py
        > python3 getCommenters.py [igusername] [igpassword] [igpostId]
        To get the comments of a post, this python script takes ‘igpostId’ as a parameter to refer to the post. After that, the script saves the comments to the database using the Java restful API.

Web Scripts:
    
    login.html
        First page where user put their instagram username and password
        
    select.php
        Second page where user gets to choose 'followers' or 'posts'
        
    followers.php
        Directed by select.php, this page sends a request to the Java restful API to query the followers list of the user, and shows it.
        
    posts.php
        Directed by select.php, this page sends a request to the Java restful API to query all the user’s posts, and shows the images of the posts for the user to select. Each post is an image with a hyperlink.

    comments.php
        Directed by posts.php, this page sends a request to the Java restful API to query the commenters of the selected post, and shows all the commenters' accounts. At the bottom of the page is a button to pick an account.

    chooseFollower.php
        Directed by followers.php, this page sends a request to the Java restful API to randomly pick one account within the followers list.

    chooseCommenter.php
        Directed by comments.php, this page sends a request to the Java restful API to randomly pick one account within the commenters of the selected post.
    
