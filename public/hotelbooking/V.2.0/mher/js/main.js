
var button = document.querySelector('.header-mobile')

button.onclick = function(event){

    if(button.classList.contains('open')){
        document.querySelector('.header__list').style.right = '-100%'
        button.classList.remove('open')
    }else{
        document.querySelector('.header__list').style.right = 0
        button.classList.add('open')
    }
}
if ( window.location !== window.parent.location ) {


  // The page is in an iframe
} else {
  // The page is not in an iframe

  document.querySelector('.container').style.height = '100vh'
}