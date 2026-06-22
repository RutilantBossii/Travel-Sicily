const contentPage = document.querySelector('.content');
const header = document.querySelector('header');

fetch('http://localhost:8000/api/getUsers')
.then(function(response){
    return response.json();
}).then(function(data){
    for(let i = 0; i<data.length; i++){
        contentPage.appendChild(genUserCard(data[i].id, data[i].cover, data[i].profile_pic, data[i].nickname, data[i].about, data[i].moderator, data[i].nPosts, data[i].nVisits));
    }
});

function genUserCard(id, cover, img, name, about, moderator, nPosts, nVisits){
    let card = document.createElement('div');
    let firstHalf = document.createElement('div');
    let secondHalf = document.createElement('div');
    let usrImg = document.createElement('div');
    let usrName = document.createElement('a');
    let desc = document.createElement('p');
    let info1 = document.createElement('p');
    let info2 = document.createElement('p');
    let infos = document.createElement('div');

    card.appendChild(firstHalf);
    card.appendChild(secondHalf);
    secondHalf.appendChild(desc);
    secondHalf.appendChild(infos);
    infos.appendChild(info1);
    infos.appendChild(info2);
    firstHalf.appendChild(usrImg);
    firstHalf.appendChild(usrName);

    infos.classList.add('info-box-2');
    card.classList.add('profile-card');
    secondHalf.classList.add('section-2');
    firstHalf.classList.add('first-half');
    usrImg.classList.add('usr-img');

    card.style.backgroundImage = "url('/"+cover+"')";
    usrImg.style.backgroundImage = "url('/"+img+"')";
    usrName.innerText = name;
    usrName.href = 'http://localhost:8000/profile/'+id;
    desc.innerText = about;
    info1.innerText = "Post: "+nPosts;
    info2.innerText = "Luoghi Visitati: "+nVisits;

    if(moderator == '1'){
        usrName.classList.add('status');
    }

    return card;
}

fetch('http://localhost:8000/api/randomCover')
.then(function(data){
    return data.text();
})
.then(function(text){
    header.style.backgroundImage = "url('"+text+"')";
});