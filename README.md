```
____________              _____
__  ___/_  /______ _________  /_
_____ \_  __/  __ `/_  ___/  __/
____/ // /_ / /_/ /_  /   / /_  
/____/ \__/ \__,_/ /_/    \__/  
-----------------------------------------------------------------
```                                


Boilerplate to start a website.

- It's got the `GULP`
- It has a file or two
- I set up the head and foot in `PHP`
- so many pages on the easy
- `SCSS` variables are made for color and font
- the Foundation `scss` is baked in the workflow
- added `GSAP` and `FontAwesome` just cause their awesome
- and `swal2`, I ain't reinventing the wheel for a popup
- also has `localforage`, `hammer`, & `moment` if you need it
- all js 3rd parties can be turned on or off through `config.php`
- oh and it has a `pageloader` if you're into that sort of thing
- easy versioning of `css` & `js` files
- Oh and functions for databases using `PDO`
- secure `bcrypt` login and email verification, with an admin page for user addition and deletion
- database and login useage can be turned off and all files removed with a simple `gulp` command
- ah and maintenance mode
- use all of it or turn off everything
- and yeah this is starting to get out of hand lol



- clone this repo into a new project
- run `npm install`
- run `gulp watch`
- start coding

You can also use `gulp help` to display all the `tasks` set up in `gulpfile.js`

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
