

var a = [1,2,3,4,5,6,1,2,3,4,5,6] // liste des images avec un doublon d'images
    .map (p => [p,Math.random()]) //création d'un nouveau tableau afin de mélanger les cartes
    .sort ((a,b)=> a[1]-b[1])//trier le tableau en comparant
    .map(p => p[0]) //nouveau tableau commençant pas la deuxieme valeur du tableau

console.log(a);

var pics = document.getElementsByTagName('img'); //recherche les images
var finalscore = document.getElementById('score'); //recherche l'id dont le nom est score
var score = 0;
var step = 1; //étape du jeu
var p1,p2;
var timer = null;


for (let i = 0; i < pics.length; i++) {
  pics[i].src2 = 'pics/pic' + a[i] + '.jpg'; //ajoute les images en  fonction de leur chiffre
}


document.addEventListener('click', function(e){ //va s'active lors d'un click sur une image
       switch(step){ //menu du jeu par étape
           case 1 : // lors du première click
               if (e.target.tagName=='IMG'){ //la cible recherche est une image de la grille
                 e.target.src = e.target.src2; //la cible sera les images ajouté caché
                 p1 = e.target;
                 step = 2; // premiere étape du jeu
               }
               break;
            case 2 : //lors du deuxieme click
            if (e.target.tagName=='IMG'){ //la cible recherche est une image de la grille
               e.target.src = e.target.src2;
              p2 = e.target;
              step = 3; // deuxieme étape du jeu
            }
            timer = setTimeout(check,1700);
            break;
            case 3 : //comparaison entre les deux étape du jeu
             clearTimeout(timer);
             check();
            break;
}
});

function check(){ //fuonction qui permet de vérifier si les carte sont identiques ou non
  if ((p1.src2==p2.src2)) {
    p1.replaceWith(document.createElement('span')) //fait disparaitre la carte  en la remplaçant
    p2.replaceWith(document.createElement('span'))//fait disparaitre la carte  en la remplaçant
    score += 10;
  }else {
    p2.src = p1.src = 'pics/pic0.jpg';
    score = Math.max(0, score-30);
  }
  step = 1;
  finalscore.textContent = score;
  if (document.getElementsByTagName('img').length==0) {//condition pour determiner si toutes les images ont bien été trouver
  finalscore.textContent += 'Gagné !!';
  }
}
