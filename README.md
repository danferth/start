```
   SSSSSSSSSSSSSSS      tttt                                                        tttt          
 SS:::::::::::::::S  ttt:::t                                                     ttt:::t          
S:::::SSSSSS::::::S  t:::::t                                                     t:::::t          
S:::::S     SSSSSSS  t:::::t                                                     t:::::t          
S:::::S        ttttttt:::::ttttttt      aaaaaaaaaaaaa  rrrrr   rrrrrrrrr   ttttttt:::::ttttttt    
S:::::S        t:::::::::::::::::t      a::::::::::::a r::::rrr:::::::::r  t:::::::::::::::::t    
 S::::SSSS     t:::::::::::::::::t      aaaaaaaaa:::::ar:::::::::::::::::r t:::::::::::::::::t    
  SS::::::SSSSStttttt:::::::tttttt               a::::arr::::::rrrrr::::::rtttttt:::::::tttttt    
    SSS::::::::SS    t:::::t              aaaaaaa:::::a r:::::r     r:::::r      t:::::t          
       SSSSSS::::S   t:::::t            aa::::::::::::a r:::::r     rrrrrrr      t:::::t          
            S:::::S  t:::::t           a::::aaaa::::::a r:::::r                  t:::::t          
            S:::::S  t:::::t    tttttta::::a    a:::::a r:::::r                  t:::::t    tttttt
SSSSSSS     S:::::S  t::::::tttt:::::ta::::a    a:::::a r:::::r                  t::::::tttt:::::t
S::::::SSSSSS:::::S  tt::::::::::::::ta:::::aaaa::::::a r:::::r                  tt::::::::::::::t
S:::::::::::::::SS     tt:::::::::::tt a::::::::::aa:::ar:::::r                    tt:::::::::::tt
 SSSSSSSSSSSSSSS         ttttttttttt    aaaaaaaaaa  aaaarrrrrrr                      ttttttttttt  
```                                


# Boilerplate to Start anything
Start is a boilerplate with a bit of everything, but without anything at the same time. On one hand it has a secure database and login system, a dedicated page loader, and error handling for the site built in. But on the other, the pages are empty and how you want to create the site is up to you. I have included enough to get started but not enough to have every site created with the boilerplate look the same. If you have a client that wants a splash page put up to gather emails, it's already in place. Then when the site is ready to launch you can set it to maintenance mode to hide the splash page while you get the site installed. Versioning of scripts and css are there so when the site in not in production mode you don't have to worry about browsers caching your files.

## What's in the box?
It's got the GULP
It has a file or two
The head, foot, and back end are in PHP
SCSS variables for color and font
Foundation scss is baked in the workflow
GSAP and FontAwesome just cause their awesome
swal2, I ain't reinventing the wheel for a popup
also has localforage, hammer, & moment if you need it
all js 3rd parties can be turned on or off through config.php
easy versioning of css & js files
Oh and default functions for forms, databases using PDO
It has a pageloader if you're into that sort of thing (set it for whole site or per page)
secure login and user profiles
database and login system can be turned off and all files removed with a simple gulp command
Maintenance mode for when you're doing maintenance
Splash page more - displays a splash page to gather emails before the site is live
Install script to set up database and first admin user
Use all of it or turn off everything
Yeah this is starting to get out of hand
Let's talk about the gulp
You can also use gulp help to display all the tasks set up in gulpfile.js
```
****************************************************************************************
css                = sourcemaps | sass | prefix | minimize | filesize
jsCat              = concat js files
checkjs            = jslint
jsUgly             = uglify concatonated js file
image              = optimize images and save to build dir
----------------------------------------------------------------------------------------
watch (default)    = css, checkjs, jsCat, image, moves files
build              = css, ALLjs, & image + moves files to build
package            = all build files and files in root copied to package/ then .zip
clean              = deletes package and build directories and package.zip
nodb               = removes all files needed for db usage.
****************************************************************************************
```

Features in the login system
bcrypt secure login
Email verification with link
Forgot your password link
Page redirects for account setup on login
Profile page with user edit
admin page allows user addition/deletion
Splash & Maintenance modes
When you put the site in maintenance mode it will redirect to maintenance.php displaying a message that the site is in maintenance. You can use this for whatever reason you need, database updates. uploading a new version of the site.....

When the site is in splashPage mode it will redirect to a splash page to gather emails. This is the page that you would set up and deploy when the site is still under construction to gather emails and use as a placeholder before the full site is ready.

The features can be used or ignored but are there if you need them

Page Loader
If you have a site that will taek a bit to load or your fighting a bit of FOUC you can initialize the pageloader either for the full site or just a page or two.

How to get started
clone this repo into a new project
run npm install
run gulp watch
if you do NOT need database support or a login system run gulp nodb
start coding
