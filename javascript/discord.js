async function link(u_id) {
    const id = u_id || document.getElementById("discord").value;

    const rep = await fetch(
        `https://discordlookup.mesavirep.xyz/v1/user/${id}`,
        {
            mode: "no-cors",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "GET",
        }
    );
    const Data = await rep.text();

    console.log(`https://discordlookup.mesavirep.xyz/v1/user/${id}`, Data);

    document.querySelector("#Username").value = Data["global_name"];

    document.querySelector("#Pp").value = Data["avatar"]["link"];

    return rep.ok;
};

