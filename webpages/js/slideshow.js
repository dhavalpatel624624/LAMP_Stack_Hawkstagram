var slideimages = new Array() // create new array to preload images
slideimages[0] = new Image() // create new instance of image object
slideimages[0].src = "css/images/lifting.jpg" // set image object src property to an image's src, preloading that image in the process
slideimages[1] = new Image()
slideimages[1].src = "css/images/programming.jpg"
slideimages[2] = new Image()
slideimages[2].src = "css/images/football.jpg"
slideimages[3] = new Image()
slideimages[3].src = "css/images/basketball.jpg"
slideimages[4] = new Image()
slideimages[4].src = "css/images/traveling.jpg"

//variable that will increment through the images
var step = 0
var whichimage = 0

function slideit(){
    //if browser does not support the image object, exit.
    if (!document.images)
        return
    document.getElementById('slide').src = slideimages[step].src
    whichimage = step
    if (step<4)
        step++
    else
        step=0
    //call function "slideit()" every 2.5 seconds
    setTimeout("slideit()",5000)

   //document.getElementById('slide').addEventListener("click", myFunction);

}

slideit()