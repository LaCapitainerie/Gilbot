const raccourcis = {
    "video": "popup(9)",
    "sidebar": "sw()",

    "met": "met(`?`)",
    "joue": "play(`?`)",

    "telecharge": "download(search(`?`))",
    
    "pause": "pause()",
    "reprends": "resume()",
    "stop": "abort()",
};

const déclencheur = "gilbert";

function audiorecognize() {
    if ("SpeechRecognition" in window || "webkitSpeechRecognition" in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        recognition.lang = 'fr-FR';
    
        recognition.start();
    
        recognition.addEventListener("result", (event) => {
            const transcript = event.results[0][0].transcript.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "");
            console.log(transcript); 
            if(transcript.includes(déclencheur)){
                Object.keys(raccourcis).forEach(key => {
                    if (transcript.includes(key)) {
                        eval(raccourcis[key].replace("?", transcript.replace(key, "").replace(déclencheur, "")));
                        return key;
                    };
                });
            };
        });

        recognition.addEventListener('end', () => {
            recognition.start();
        });

    } else {
        console.log("SpeechRecognition API is not supported in this browser.");
    };
};