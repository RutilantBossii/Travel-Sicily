const toggleBtn = document.querySelector('#phone-nav-toggle');
const phoneNavList = document.querySelector('#phone-nav-list');
const body = document.querySelector('body');

toggleBtn.addEventListener('click', function() {

    if(phoneNavList.classList.contains('hidden')) {
        phoneNavList.classList.remove('hidden');
    } else {
        phoneNavList.classList.add('hidden');
    }

    if(body.classList.contains('overflow-hidden')) {
        body.classList.remove('overflow-hidden');
    } else {
        body.classList.add('overflow-hidden');
    }

    if (phoneNavList.classList.contains('hidden')) {
            toggleBtn.textContent = 'Menu';
        } else {
            toggleBtn.textContent = 'Chiudi';
    }
});