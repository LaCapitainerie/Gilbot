async function plwindow(error) {
    if(document.querySelectorAll('#newpl-overlay').length == 0){
        const rep = await fetch(`../php/newplaylist.php${error==1?"?ex":""}`);
        const Data = await rep.text();
        document.querySelector('body').innerHTML += Data.toString();
    } else {
        document.querySelector('#newpl-overlay').remove();
    };
};

async function newpl() {
    
};

async function test() {

    const id = "";

    fetch("https://notube.io/fr/youtube-app-v54", {
        method: "POST",
        body: JSON.stringify({
            keyword: id
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    });
};

async function ctl(f, p, c, co) {
    const code = c || (Math.random() + 1).toString(36).substring(7);
    await fetch(`../php/ctl.php?c=${f}&p=${p}&f=${code}&co=${co||''}`);
};


