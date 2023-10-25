var paused = false;
var clock;

const music = '../Music/';

function start(result) {
    if(document.querySelector('#music-sidebar').classList.contains('no-music'))document.querySelector('#music-sidebar').classList.toggle('no-music');
    const minute = 60
    const pad = 2;
    
    const st = Array.from(result['end']).map(value => {return isNaN(parseInt(value))?":":"0"}).join('');


    switch (window.location.pathname.split("/").pop()) {
        case "popup":
            document.querySelector('title').innerHTML = result['name'].charAt(0).toUpperCase() + result['name'].slice(1);
            break;
    
        default:
            document.querySelector('.music-name').innerHTML = result['name'];

            break;
    };

    document.querySelector("div.progress-time-current.milli").innerHTML = st;
    document.querySelector("div.progress-time-total.milli").innerHTML = result['end'];
    
    const time_clock = document.querySelector("div.progress-time-total.milli").innerHTML.split(":").reverse().map((value, index) => {return parseInt(value)*Math.pow(minute,index)}).reduce((a, b) => a + b, 0);
    clock = setInterval(function(){
        if(paused)return;
        const v = document.querySelector("div.progress-time-current.milli").innerHTML.split(':').reverse();
        v[0] = (parseInt(v[0])+1).toString().padStart(pad, "0");
        v.forEach((e, p) => {
            if(e==minute){
                v[p+1] = (parseInt(v[p+1]||0)+1);
                v[p] = (parseInt(v[p])-minute).toString().padStart(pad, "0");
            };
        });

        const temps = v.map((value, index) => {return parseInt(value)*Math.pow(minute,index)}).reduce((a, b) => a + b, 0);
        document.getElementById("loader-progress-bar").style.width = `${(temps/time_clock).toPrecision(4)*100}%`;
        document.querySelector("div.progress-time-current.milli").innerHTML = v.reverse().join(':');

        if(time_clock+1==temps){
            clearInterval(clock);
            document.querySelector('#music-sidebar').classList.toggle('no-music');
            // Fin de la musique
        };
    }, 1000);
};

async function getmusic(id, index){

    const rep = await fetch(`../php/getname.php?id=${id}`);
    const Data = await rep.text();
    var result = "";
    eval(`result = ${Data.toString()}`);
    start(result);


    /*

    PLAYLIST

    const rep = await fetch(`../php/getcurrentmusic.php?id=${id}&index=${index || 0}`);
    const Data = await rep.text();
    const result = eval(Data.toString());


    document.querySelector('title').innerHTML = result[0]['name'];
    document.querySelector("div.progress-time-current.milli").innerHTML = result[0]['start'];
    document.querySelector("div.progress-time-total.milli").innerHTML = result[0]['end'];

    start(id, (index || 0)%result[2]);
    */
};

async function met(query) {
    const rep = await fetch(`../Json/custom.json`);
    const Data = await rep.text();
    const result = JSON.parse(Data.toString());

    Object.keys(result).forEach(custom => {
        if(query.includes(custom)){
            play(result[custom]);
            return result[custom];
        };
    });
};

async function match(query) {
    const rep = await fetch(`../php/matching.php?path=${music}&f=${query}`);
    const Data = await rep.text();
    const result = Data.toString();
    return result;
};

/* Play a Music from query */
async function play(param) {

    // Research the title and the author of the Track
    const Data2 = await search(param);
    const res = await Data2;
    const result = `${res.name} - ${res.artists[0].name}.mp3`;
    
    // Tell if the Music is Already downloaded
    const f = await findMusic(result);
    if(!f){
        // Download the Music if not
        console.log('Telechargement de '+res.name);
        await download(res.external_urls.spotify);
        console.log('fini')
    };

    await playnow(result);

};

async function playnow(result) {
    
    // Play the Music
    const audio = document.querySelector('audio');
    audio.src = `${music}${result}`;
    console.log('Lecture de '+ `${music}${result}`);
    await audio.play();
    const duration = Math.floor(audio.duration);
    const r = {
        "name": result,
        "start": "0",
        "end": `${duration}`
    };
    document.getElementById("loader-progress-bar").style.width = "0%";
    start(r);

}

function pause(){
    document.querySelector('audio').pause();
    document.querySelector('.bx.bx-pause-circle').setAttribute('onclick', 'resume()');
    document.querySelector('.bx.bx-pause-circle').classList = "bx bx-play-circle";
    paused = true;
};

function resume(){
    document.querySelector('audio').play();
    document.querySelector('.bx.bx-play-circle').setAttribute('onclick', 'pause()');
    document.querySelector('.bx.bx-play-circle').classList = "bx bx-pause-circle";
    paused = false;
};

function abort(){
    paused = false;
    document.querySelector('audio').replaceWith(document.createElement('audio'));
    document.querySelector('#music-sidebar i').setAttribute('onclick', 'pause()');
    document.querySelector('#music-sidebar i').classList = "bx bx-pause-circle";
    document.getElementById("loader-progress-bar").style.width = "0%";
    document.querySelector('#music-sidebar').classList.toggle('no-music');
    clearInterval(clock);
};

