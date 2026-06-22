const nickErr = document.querySelector('#nickname-error');
const pwdErr = document.querySelector('#password-error');
const submitBtn = document.querySelector('#login-button');
const nickIn = document.querySelector('#nickname');
const pwdIn = document.querySelector('#password');

submitBtn.addEventListener('click', function(event){

    nickErr.innerText = '';
    pwdErr.innerText = '';

    if(nickIn.value === ''){
        nickErr.innerText = "Il campo Nickname è obbligatorio";
        event.preventDefault();
    }else if(nickIn.value.length < 3){
        nickErr.innerText = "Il tuo Nick deve avere almeno 3 caratteri";
        event.preventDefault();
    }

    if(pwdIn.value === ''){
        pwdErr.innerText = "Il campo Password è obbligatorio";
        event.preventDefault();
    }else if(pwdIn.value.length < 3){
        pwdErr.innerText = "Password troppo corta";
        event.preventDefault();
    }
});

const header = document.querySelector('header');

fetch('http://localhost:8000/api/randomCover')
.then(function(data){
    return data.text();
})
.then(function(text){
    header.style.backgroundImage = "url("+text+")";
});

