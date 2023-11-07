async function make_game() {
    const nc = document.getElementById("nombre_carte").value;
    const ec = document.getElementById("carte_equipe").value;
    const rep = await fetch(`../php/codename/request/newgame.php?nc=${nc}&ce=${ec}`);
    const Code = await rep.text();

    await fetch(`../php/codename/request/joingame.php?tag=${Code}`);
    
    await get(`../php/codename/game.php`, `Room - ${Code}`);
};


document.addEventListener('copy', function(event) {
    const page = document.querySelector("#main-section > section.entete > div > span").innerHTML;
    if(page.startsWith("Room")){
        
        var clipboardData = event.clipboardData;
        clipboardData.setData('text', `localhost/php/codename/request/joingame.php?tag=${page.split(" ")[2]}`);
        event.preventDefault();
    };
});