function myFunction() {
    navigator.clipboard.writeText(document.getElementById('discordname').textContent);
    document.getElementById("myTooltip").innerHTML = "Copied!";
};
  
function outFunc() {
    document.getElementById("myTooltip").innerHTML = "Copy to clipboard";
};

function sw() {
    document.querySelector("body > div.sidebar").classList.toggle("close");
};

document.addEventListener('contextmenu', async function(e) {
    return;
    e.preventDefault();
    const menu = document.querySelector('#rightclick-menu');
    console.log(menu);
    if(menu){
        menu.style.top = `${e.y}px`;
        menu.style.left = `${e.x}px`;
    } else {
        const rep = await fetch(`../php/rightclick-menu.php?x=${e.x}&y=${e.y}`);
        const Data = await rep.text();
    
        document.querySelector('body').innerHTML += Data;
    };
}, false);

document.addEventListener('click', (e) => {
    switch (e.target.classList.value) {
        case 'rightclick-menu-item':
            console.log(e.target.children[0]);
            break;
        
        case 'rcml':
            console.log(e.target);
            break;
    
        default:
            break;
    };
    document.querySelector('#rightclick-menu')?.remove();
});

async function get(params, name) {
    const rep = await fetch(`./../Html/${params}`);
    const Data = await rep.text();

    document.querySelector("#main-section > section.entete > div > span").textContent = name;

    const div = document.createElement('div');
    div.innerHTML = Data;
    document.querySelector('#content').innerHTML = div.querySelector('#main-section > #content')?.innerHTML || document.querySelector('#content').innerHTML;
    return true;
};