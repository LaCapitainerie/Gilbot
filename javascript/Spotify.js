/* Get Token to access Spotify API */
async function get_token() {
  const rep = await fetch('../php/get_token.php');
  const Data = await rep.text();
  if(Data.toString() != "error"){
    return Data.toString();
  };

  const rep2 = await fetch("https://accounts.spotify.com/api/token", {
    body: `grant_type=client_credentials&client_id=2eafc5bcf24e4a4fbebcd516701d4841&client_secret=c016f4ab05c9461993d3e4cbf687e1cb`,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    method: "POST"
  });
  const str2 = await rep2.json();
  await fetch('../php/set_token.php?q='+str2["access_token"]);
  return str2["access_token"];
};

/* Execute a Fetch Request to the Spotify API*/
async function fetchWebApi(endpoint, method, body) {
  const token = await get_token();
  const res = await fetch(`https://api.spotify.com/${endpoint}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
    method,
    body:JSON.stringify(body)
  });
  return await res.json();
};

/* Search Track or Album on the Spotify */
async function search(param) {
  const q = param || document.querySelector('#search').value;
  if(!q)return;
  const link = `v1/search?q=${q}&type=${"track"}&limit=${"1"}&offset=0`;
  const result = await fetchWebApi(link, 'GET');
  return result.tracks.items[0];
};

/* Download Track From Spotify */
async function download(urlp) {
  const urln = (await urlp).external_urls.spotify;
  const url = urln;
  const loader = document.getElementById("loader-dl");
  const button = document.getElementById("dl-music");
  if(loader){loader.classList = "loader-dl";button.toggleAttribute("disabled")};
  const result = await fetch(`http://localhost:8081/videodl/download.php?track=${url}`);
  if(loader){loader.classList = "";button.toggleAttribute("disabled")};
  console.log(result);
  return result.ok;
};

/* Tell if a Music is already downloaded */
async function findMusic(params) {
  const link = `./../Music/${params}`;
  const response = await fetch(link);
  return response.ok;
};