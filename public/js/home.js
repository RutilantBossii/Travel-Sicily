const header = document.querySelector('header');
const contentCards = document.querySelector('#content-cards');
const sessionID = document.querySelector('meta[name="user_id"]').content;
let modStatus;

fetch('http://localhost:8000/api/randomCover')
.then(function(data){
    return data.text();
})
.then(function(text){
    header.style.backgroundImage = "url("+text+")";
});

fetch('http://localhost:8000/verifyMod')
.then(function(response){return response.text();})
.then(function(json){
    modStatus = json;
    genPosts();
});

function genPosts(){
    fetch("http://localhost:8000/api/getAllPosts")
    .then(function(json){
        return json.json();
    })
    .then(function(data){
        for(let i=0; i<data.length; i++){
            contentCards.appendChild(genCard(data[i].id, data[i].usrImg, data[i].usrName, data[i].user_id, data[i].content, data[i].location, data[i].place_id, data[i].nLikes, modStatus));
        }
    });
}

function genCard(cardID, usrImg, usrName, usrID, content, loc, locID, nLikes, mod){
    let newCard = document.createElement('div');
    let firstHalf = document.createElement('div');
    let secondHalf = document.createElement('div');
    let userImage = document.createElement('div');
    let userName = document.createElement('a');
    let comment = document.createElement('p');
    let interactiveBox = document.createElement('div');
    let location = document.createElement('a');
    let likes = document.createElement('div');
    let likeCount = document.createElement('p');
    let likeBtn = document.createElement('button');

    newCard.classList.add('card');
    firstHalf.classList.add('first-half');
    secondHalf.classList.add('second-half');
    userImage.classList.add('user-img');
    interactiveBox.classList.add('interaction-posts');
    likes.classList.add('likes');

    newCard.appendChild(firstHalf);
    newCard.appendChild(secondHalf);
    firstHalf.appendChild(userImage);
    firstHalf.appendChild(userName);
    secondHalf.appendChild(comment);
    secondHalf.appendChild(interactiveBox);
    interactiveBox.appendChild(location);
    interactiveBox.appendChild(likes);
    likes.appendChild(likeCount);
    likes.appendChild(likeBtn);

    userImage.style.backgroundImage = "url('/"+usrImg+"')";
    userName.innerText = usrName;
    userName.href = "http://localhost:8000/profile/"+usrID;
    comment.innerText = content;
    location.innerText = loc;
    location.href = "http://localhost:8000/luoghi/" + locID;
    likeCount.innerText = nLikes;
    likeBtn.innerText = 'Mi Piace';

    
    if(usrID == sessionID || mod === '1'){
        let removeBtn = document.createElement('button');
        let statusSpan = document.createElement('span');

        statusSpan.classList.add('error-msg');
        removeBtn.classList.add('rmv-btn');

        interactiveBox.appendChild(removeBtn);
        secondHalf.appendChild(statusSpan);

        removeBtn.innerText = 'Elimina';

        removeBtn.addEventListener('click', function(){
            fetch('http://localhost:8000/removePost/'+cardID)
            .then(function(thing){return thing.text()})
            .then(function(status){
                if(status === '1'){
                    statusSpan.style.color = 'green';
                    statusSpan.innerText = 'Messaggio eliminato con successo';
                }else{
                    statusSpan.style.color = 'red';
                    statusSpan.innerText = 'Errore: Messaggio non eliminato';
                }
            });
        });
    }

    likeBtn.addEventListener('click', function(){
        fetch('http://localhost:8000/likePost/'+cardID)
        .then(function(json){return json.json()})
        .then(function(data){
            likeCount.innerText = data;
        });
    });

    return newCard;
}