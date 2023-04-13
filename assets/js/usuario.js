const buscarBar = document.querySelector(".search input"),
buscarIcon = document.querySelector(".search button"),
usuarioLista = document.querySelector(".users-list"),
screen = document.querySelector(".contenedor-loader");
screen.style.display = "block";
screen.style.animation = "fadeIn 0.2s";    

buscarIcon.onclick = ()=>{
  buscarBar.classList.toggle("show");
  buscarIcon.classList.toggle("active");
  buscarBar.focus();
  if(buscarBar.classList.contains("active")){
    buscarBar.value = "";
    buscarBar.classList.remove("active");
  }
}

buscarBar.onkeyup = ()=>{  
  let terminoBusqueda = buscarBar.value;
  if(terminoBusqueda != ""){
    buscarBar.classList.add("active");
  }else{
    buscarBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/engine/funciones/buscar.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usuarioLista.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("terminoBusqueda=" + terminoBusqueda);
}

setInterval(() =>{
  
  
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "/engine/funciones/usuario.php", true);
  
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!buscarBar.classList.contains("active")){
            screen.style.display = "none"; 
            screen.style.animation = "fadeOut 0.2s";
            usuarioLista.style.animation = "fadeIn 0.5s";
            usuarioLista.innerHTML = data;
          }
        }
    }
  }
                                             
  xhr.send();
}, 1000);





function playNotificationSound() {
  const audio = new Audio("/assets/sounds/notification.wav");
  audio.play();
}

function waitForElements(selector) {
  return new Promise((resolve, reject) => {
    const intervalId = setInterval(() => {
      const elements = document.querySelectorAll(selector);
      if (elements.length > 0) {
        clearInterval(intervalId);
        resolve(Array.from(elements));
      }
    }, 100);
  });
}

function monitorMessageCounts() {
  return new Promise((resolve, reject) => {
    waitForElements('.message-info span').then((elements) => {
      const observers = [];

      for (const element of elements) {
        let prevCount = Number(element.textContent);
        let currentCount = prevCount;

        const observer = new MutationObserver((mutations) => {
          for (const mutation of mutations) {
            if (mutation.type === 'childList') {
              currentCount = Number(mutation.target.textContent);
              if (currentCount > prevCount) {
                for (let i = 0; i < currentCount - prevCount; i++) {
                  playNotificationSound();
                }
              }
              prevCount = currentCount;
            }
          }
        });

        observer.observe(element.parentElement, { childList: true });
        observers.push(observer);
      }

      resolve(observers);
    }).catch((err) => {
      reject(new Error('No se encontraron los elementos'));
    });
  });
}

function monitorAndUpdateMessageCounts() {
  let elements = [];
  waitForElements('.message-info span').then((els) => {
    elements = els;
    let prevCounts = elements.map((element) => Number(element.textContent));

    setInterval(() => {
      const newElements = document.querySelectorAll('.message-info span');
      if (newElements.length > 0) {
        elements = Array.from(newElements);
        const currentCounts = elements.map((element) => Number(element.textContent));
        for (let i = 0; i < elements.length; i++) {
          if (currentCounts[i] > prevCounts[i]) {
            for (let j = 0; j < currentCounts[i] - prevCounts[i]; j++) {
              playNotificationSound();
            }
          }
        }
        prevCounts = currentCounts;
      }
    }, 1000);
  }).catch((err) => {
    console.log(err);
  });
}

window.addEventListener('load', () => {
  monitorMessageCounts().then((observers) => {
    console.log('Observación iniciada');
    monitorAndUpdateMessageCounts();
  }).catch((err) => {
    console.log(err);
  });
});

