//login
let fromUser = document.querySelector('.formUser');
let fromAdmin = document.querySelector('.formAdmin');
let adminBtn = document.querySelector('#adminBtn');
let flagAdmin = 1;

adminBtn.addEventListener('click',function(){
    if(flagAdmin){
        fromUser.style.display = "none";
        fromAdmin.style.display = "flex";
        adminBtn.textContent = "User";
        flagAdmin = 0;
    }else{
        fromAdmin.style.display = "none";
        fromUser.style.display = "flex";
        adminBtn.textContent = "Admin";
        flagAdmin = 1;
    }
});
