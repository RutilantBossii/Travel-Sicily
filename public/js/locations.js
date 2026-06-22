const header = document.querySelector('header');
const content = document.querySelector('.places');
const allBtn = document.querySelector('#all-btn');
const visBtn = document.querySelector('#visited');
const sessionID = document.querySelector('meta[name="user_id"]').content;

allBtn.addEventListener('click', genLocations);
visBtn.addEventListener('click', genVisited);

function genVisited(){
    content.innerHTML = '';
    fetch('http://localhost:8000/api/getVisited/'+sessionID)
    .then(function(data){
        return data.json();
    })
    .then(function(json){
        for(let i=0; i<json.length; i++){
            let contentCard = document.createElement('a');
            let locationImage = document.createElement('div');
            let locationInfo = document.createElement('div');

            contentCard.classList.add('content-card');
            locationImage.classList.add('location-image');
            locationInfo.classList.add('location-info');

            contentCard.appendChild(locationImage);
            contentCard.appendChild(locationInfo);

            locationImage.style.backgroundImage = "url('/"+json[i].img+"')";

            let title = document.createElement('h1');
            title.innerText = json[i].name;
            locationInfo.appendChild(title);

            let visits = document.createElement('p');
            visits.innerText = "Visite: "+json[i].visits;
            locationInfo.appendChild(visits);

            let posts = document.createElement('p');
            posts.innerText = "Post: "+json[i].posts;
            locationInfo.appendChild(posts);

            content.appendChild(contentCard);

            contentCard.href = "http://localhost:8000/luoghi/"+json[i].id;
        }
    });
}

fetch('http://localhost:8000/api/randomCover')
.then(function(data){
    return data.text();
})
.then(function(text){
    header.style.backgroundImage = "url("+text+")";
});

genLocations();

function genLocations(){
    content.innerHTML = '';
    fetch('http://localhost:8000/api/getLocations')
    .then(function(data){
        return data.json();
    })
    .then(function(json){
        for(let i=0; i<json.length; i++){
            let contentCard = document.createElement('a');
            let locationImage = document.createElement('div');
            let locationInfo = document.createElement('div');

            contentCard.classList.add('content-card');
            locationImage.classList.add('location-image');
            locationInfo.classList.add('location-info');

            contentCard.appendChild(locationImage);
            contentCard.appendChild(locationInfo);

            locationImage.style.backgroundImage = "url('/"+json[i].img+"')";

            let title = document.createElement('h1');
            title.innerText = json[i].name;
            locationInfo.appendChild(title);

            let visits = document.createElement('p');
            visits.innerText = "Visite: "+json[i].visits;
            locationInfo.appendChild(visits);

            let posts = document.createElement('p');
            posts.innerText = "Post: "+json[i].posts;
            locationInfo.appendChild(posts);

            content.appendChild(contentCard);

            contentCard.href = "http://localhost:8000/luoghi/"+json[i].id;
        }
    });
}