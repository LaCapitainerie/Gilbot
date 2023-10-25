
const screen_size = document.querySelector("html").getBoundingClientRect();

document.addEventListener('contextmenu', async function(e) {
    var menu = document.querySelector('#rightclick-menu');

    if(document.querySelector("#music-sidebar").contains(e.target)){
        e.preventDefault();

        if(menu){
            menu.style.display = "block";
        } else {
            const rep = await fetch(`../php/rightclick-menu.php?cat=music`);
            const Data = await rep.text();
            const divdata = document.createElement('div');
            divdata.innerHTML = Data;
        
            document.querySelector('body').appendChild(divdata);

            document.querySelector(`input[type=range]`).value = document.querySelector("#sidebar > ul > audio").volume;
        };

        menu = document.querySelector('#rightclick-menu');

        var rect = menu.getBoundingClientRect();
        var width = rect.width;
        var height = rect.height;

        console.log(screen_size.height, e.y+height);
        if(screen_size.height > e.y+height){
            menu.style.top = `${e.y}px`;
            menu.style.bottom = null;
        } else {
            menu.style.bottom = `${screen_size.height - e.y}px`;
            menu.style.top = null;
        };

        console.log(screen_size.width, e.x+width);
        if(screen_size.width > e.x+width){
            menu.style.left = `${e.x}px`;
            menu.style.right = null;
        } else {
            menu.style.right = `${screen_size.width - e.x}px`;
            menu.style.left = null;
        };

    } else {
        if(menu)menu.style.display = "none";
    }
}, false);

document.addEventListener('click', (e) => {
    switch (e.target.classList.value) {
        case 'rightclick-menu-item':
            console.log(e.target.children[0]);
            break;

        // Right click on music album
        case 'pl-list':
            
            break;
        
        case 'rcml':
            console.log(e.target);
            break;
    
        default:
            break;
    };
    if(document.querySelector('#rightclick-menu'))document.querySelector('#rightclick-menu').style.display = "none";
});