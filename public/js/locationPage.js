const header = document.querySelector('header');
const id = document.querySelector('meta[name="placeID"]').content;
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const sessionID = document.querySelector('meta[name="user_id"]').content;
const postContent = document.querySelector('#post-text');
const postBtn = document.querySelector('#post-btn');
const errSpan = document.querySelector('#errMsg');
const contentCards = document.querySelector('#content-cards');

let modStatus;

fetch('http://localhost:8000/verifyMod')
.then(function(response){return response.text();})
.then(function(json){
    modStatus = json;
    genPosts();
});

fetch("http://localhost:8000/api/getLocationsByID/"+id)
.then(function(data){
    return data.json();
})
.then(function(json){
    header.style.backgroundImage = "url('/"+json.img+"')";
});

if(postBtn){
    postBtn.addEventListener('click', function(){
    let formData = new FormData();
    formData.append('_token', csrfToken);
    formData.append('placeID', id);
    formData.append('userID', sessionID);
    formData.append('content', postContent.value);

    fetch("http://localhost:8000/api/post", {method: 'POST', body: formData})
    .then(function(response){
        return response.json();
    })
    .then(function(json){
        if(json.success){
            errSpan.style.color = 'green';
            errSpan.innerText = 'Post inviato!';
        }else{
            errSpan.style.color = 'red';
            errSpan.innerText = 'Errore: ' + json.message;
        }
    });
    });
}

const apiBox = document.querySelector('#api-box');
const apiInfoBox = document.querySelector('#api-info-box');

fetch("http://localhost:8000/api/getLocationStats/"+id)
.then(function(json){
    return json.json();
})
.then(function(data){
    apiInfoBox.innerHTML = '';
    let p1 = document.createElement('p');
    let p2 = document.createElement('p');
    let p3 = document.createElement('p');
    p1.innerText = 'Visite: '+data.visits;
    p2.innerText = 'Posts: '+data.posts;
    p3.innerText = 'Clima: '+data.meteo;
    apiInfoBox.appendChild(p1);
    apiInfoBox.appendChild(p2);
    apiInfoBox.appendChild(p3);

    let visitBtn = document.createElement('button');
    visitBtn.innerText = 'Visita';
    visitBtn.classList.add('fancy-btn');
    apiBox.appendChild(visitBtn);

    visitBtn.addEventListener('click', function(){
        if(id){
            fetch('http://localhost:8000/makeVisit/'+id)
            .then(function(text){
                return text.text();
            }).then(function(thing){
                p1.innerText = 'Visite: ' + thing;
            });
        }
    });
});

/*-----------------------------------------------------*/

function genPosts(){
    fetch("http://localhost:8000/api/getLocationPosts/"+id)
    .then(function(json){
        return json.json();
    })
    .then(function(data){
        for(let i=0; i<data.length; i++){
            contentCards.appendChild(genCard(data[i].id, data[i].usrImg, data[i].usrName, data[i].user_id, data[i].content, data[i].nLikes, modStatus));
        }
    });
}


function genCard(cardID, usrImg, usrName, usrID, content, nLikes, mod){
    let newCard = document.createElement('div');
    let firstHalf = document.createElement('div');
    let secondHalf = document.createElement('div');
    let userImage = document.createElement('div');
    let userName = document.createElement('a');
    let comment = document.createElement('p');
    let interactiveBox = document.createElement('div');
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
    interactiveBox.appendChild(likes);
    likes.appendChild(likeCount);
    likes.appendChild(likeBtn);

    userImage.style.backgroundImage = "url('/"+usrImg+"')";
    userName.innerText = usrName;
    userName.href = "http://localhost:8000/profile/"+usrID;
    comment.innerText = content;
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