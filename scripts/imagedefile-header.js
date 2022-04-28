const img = document.getElementById("image-carousel-header");
let i = 0;
let imgArray = ["photo5.jpg","photo10.jpg","photo11.jpg","photo6.jpg","photo7.jpg"]

function prev(){
  i--;
  if(i<0){
    i = imgArray.length-1;
  }
  let y;
  img.src = 'images/'+imgArray[i];
}

function next(){
  i++;
  if(i >= imgArray.length){
    i = 0;
  }
  img.src = 'images/'+imgArray[i];
}

/**
setInterval permet de déclencher une fonction toutes les N millis
  - 1er parametre: function
  - 2eme: Le nombre millis entre chaque call
*/
setInterval(next,10000);
