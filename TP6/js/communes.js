
window.addEventListener('load',initForm);
function initForm(){
  fetchFromJson('services/getTerritoires.php')
  .then(processAnswer)
  .then(makeOptions);
  
  document.forms.form_communes.addEventListener("submit", sendForm);
  
  // décommenter pour le recentrage de la carte :
  document.forms.form_communes.territoire.addEventListener("change",function(){
   centerMapElt(this[this.selectedIndex]);
  });
}

function processAnswer(answer){
  if (answer.status == "ok")
    return answer.result;
  else
    throw new Error(answer.message);
}


function makeOptions(tab){
  for (let territoire of tab){  
    let option = document.createElement('option');
    option.textContent = territoire.nom;
    option.value = territoire.id;
    document.forms.form_communes.territoire.appendChild(option);
    for (let k of ['min_lat','min_lon','max_lat','max_lon']){
      option.dataset[k] = territoire[k];
    }
  }
}


function sendForm(ev){ // form event listener
  ev.preventDefault();
    // Utilisation de FormData / URLSearchParams
    let args = new FormData(  );
    let queryString = new URLSearchParams(args).toString();
    fetchFromJson('sercices/getCommunes.php' + queryString)
        .then(processAnswer)
        .then(makeCommunesItems); 
}


function makeCommunesItems(tab){
  // récupération de la liste ul connaissant son id
  let liste = document.getElementById('liste_communes');
  // vider la liste
  liste.textContent = "";
  // pour chaque élément du tableau
  for (let commune of tab) {
      // créer un item
      let item = document.createElement('li');
      item.textContent = commune.nom;
      // les attributs
      for (let k of ['insee', 'min_lat','min_lon','max_lat','max_lon']) {
          item.dataset[k] = commune[k];
      } // commune.attribut ou commune['attribut']
      // ajouter à la liste
      liste.appendChild(item);
  }
}

function fetchCommune(ev) {
  let url = 'services/getDtails.php?insee=' + this.dataset.insee;
  fetchFromJson(url)
      .then(processAnswer)
      .then(displayCommune);
}

function displayCommune(commune){
  // récupération du div + effacement
  // ajout des détails 
}

/**
 * Recentre la carte principale autour d'une zone rectangulaire
 * elt doit comporter les attributs dataset.min_lat, dataset.min_lon, dataset.max_lat, dataset.max_lon, 
 */
function centerMapElt(elt){
  let ds = elt.dataset;
  map.fitBounds([[ds.min_lat,ds.min_lon],[ds.max_lat,ds.max_lon]]);
}


/**
 * correction backup
 * function sendForm(ev) { // form event listener
    ev.preventDefault();
    // Utilisation de FormData / URLSearchParams
    let args = new FormData(this);
    let queryString = new URLSearchParams(args).toString();
    fetchFromJson('sercices/getCommunes.php' + queryString)
        .then(processAnswer)
        .then(makeCommunesItems); 
}

function makeCommunesItems(tab) {
    // récupération de la liste ul connaissant son id
    let liste = document.getElementById('liste_communes');
    // vider la liste
    liste.textContent = "";
    // pour chaque élément du tableau
    for (let commune of tab) {
        // créer un item
        let item = document.createElement('li');
        item.textContent = commune.nom;
        // les attributs
        for (let k of ['insee', 'min_lat','min_lon','max_lat','max_lon']) {
            item.dataset[k] = commune[k];
        } // commune.attribut ou commune['attribut']
        // ajouter à la liste
        liste.appendChild(item);
    }
}

// à ajouter dans makeCommunesItems
item.addEventListener('click', fetchCommune);

function fetchCommune(ev) {
    let url = 'services/getDtails.php?insee=' + this.dataset.insee;
    fetchFromJson(url)
        .then(processAnswer)
        .then(displayCommune);
}
function displayCommune(commune) {
    // récupération du div + effacement
    // ajout des détails 
}

 */