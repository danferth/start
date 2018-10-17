```
____________              _____ 
__  ___/_  /______ _________  /_
_____ \_  __/  __ `/_  ___/  __/
____/ // /_ / /_/ /_  /   / /_  
/____/ \__/ \__,_/ /_/    \__/  
----------------------------------------------------------------- 
```                                


Just a basic boilerplate to start a website.

- It's got the `GULP`
- It has a file or two
- I set up the head and foot in `PHP`
- so many pages on the easy
- `SCSS` variables are made for color and font
- added `GSAP` and `FontAwesome` just cause their awesome
- and `swal2`, I ain't reinventing the wheel for a popup

You can use this if you want, I use Cloud9 for an IDE:

- clone this repo into a new project
- run `npm install`
- run `gulp watch`
- start

You can also use `gulp help` to display all the `tasks` set up in `gulpfile.js`

```
*****************************************************************************
css                = sourcemaps | sass | prefix | minimize | filesize
checkjs            = jslint | filesize (only site.js)
js                 = concat | uglify | filesize
image              = optimize images and save to build dir
-----------------------------------------------------------------------------
watch (default)    = css, checkjs, js
clear              = delete css & js from build/
build              = css, js, & image
package            = copies all relavent files to package/ (use build first)
*****************************************************************************
```


