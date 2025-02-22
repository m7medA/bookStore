//admin 
//for media query
let id = document.querySelector('#show');
let left = document.querySelector('.left');
let showFlag = 1;
id.addEventListener('click',function(){
    if(showFlag){
        console.log(4);
        left.style.display = 'block';
        showFlag = 0;
    }else{
        left.style.display = 'none';
        showFlag = 1;
    }
});








