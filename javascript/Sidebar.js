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


async function get(params, name) {
    const rep = await fetch(`./../Html/${params}`);
    const Data = await rep.text();

    if(name)document.querySelector("#main-section > section.entete > div > span").textContent = name;

    const div = document.createElement('div');
    div.innerHTML = Data;
    document.querySelector('#content').innerHTML = div.querySelector('#main-section > #content')?.innerHTML || document.querySelector('#content').innerHTML;
    return true;
};