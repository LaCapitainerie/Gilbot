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
    document.querySelector('#content').replaceWith(div.querySelector('#main-section > #content') || document.querySelector('#content'));

    // Execute JS Script
    document.querySelectorAll("#content script").forEach(element => {
        if(element.src != ""){
            var script = document.createElement('script');
            script.src = element.src;
            document.querySelector('#content').appendChild(script);
        } else {
            eval(element.innerHTML);
        };
    });


    return true;
};

