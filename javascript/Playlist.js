async function getpl(elem, img, nom) {
    const rep = await fetch(`../php/card.php?img=${img}&nom=${nom}`);
    const Data = await rep.text();
    

    const div = document.createElement('div');
    div.innerHTML = Data.toString();

    document.querySelector(elem).appendChild(div);
    /*
    var arr = MyDiv.getElementsByTagName('script')
    for (var n = 0; n < arr.length; n++)
        eval(arr[n].innerHTML);
    */
};

async function fav(id) {
    const rep = await fetch(`../php/fav.php?pl=${id}`);
    const Data = await rep.text();

    document.querySelector(`a[onclick="fav(${id});"]`).style.color = (Data.toString()=="0"?"#FFFFFF":"#FF0000");
};

function popup(id) {
    /*
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if(filename == "music_loader.php"){
        window.close();
    } else {
        var url = `../php/music_loader.php?id=${id}&index=0`;
        var name = "null";
        var winFeature = 'directories=no,titlebar=no,location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=1420,top=780';
        window.open(url,name,winFeature);
    };
    */
    var url = `../php/music_loader.php?id=${id}&index=0`;
    var name = "null";
    var winFeature = 'directories=no,titlebar=no,location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=1420,top=780';
    window.open(url,name,winFeature);
};

function extract(id) {
    var url = `../php/music_loader.php?id=${id}`;
    var name = "null";
    var winFeature = 'directories=no,titlebar=no,location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=1420,top=780';
    const w = window.open(url,name,winFeature);
    w.focus();
};