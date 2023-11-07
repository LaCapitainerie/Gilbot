document.querySelectorAll("#contour").forEach(element => {
    element.addEventListener('click', async () => {
        const name = element.querySelector('a').innerHTML;
        await fetch(`./../php/codename/request/reveal.php?n=${name}`);
        await display();
    });
});

async function allgames() {
    if(document.querySelector("#main-section > section.entete > div > span").innerHTML.startsWith("Room")){
        const Data = await fetch(`./../php/codename/request/getallgames.php`);
        const str = await Data.text();
        document.getElementById("allgames").innerHTML = str;
    };
};


async function display() {
    if(document.querySelector("#main-section > section.entete > div > span").innerHTML.startsWith("Room")){
        const Data = await fetch(`./../php/codename/request/getallcards.php`);
        
        const datastr = await Data.text();
        const str = JSON.parse(datastr);
        document.querySelector("#content > a").style.color = str["tour"];
        document.querySelector("#content > a > strong").innerHTML = `Au ${str["tour"]} de jouer !`;

        const cards = document.querySelectorAll("#contour");
        for (let i = 0; i < str["cartes"].length; i++) {
            cards[i].classList = str["cartes"][i];
        };
    };
    return;
};


setInterval(async () => {await display();}, 2000);