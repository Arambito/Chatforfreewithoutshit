const formChat = document.querySelector(".signup form"),
cBoton = formChat.querySelector(".button input"),
errorText = formChat.querySelector(".error-text");
const files = document.querySelectorAll('.select-image');

Array.from(files).forEach(
  f => {
    f.addEventListener('change', e => {
      const span = document.querySelector('.field.image');
      span.innerHTML = f.files[0].name;
    });
  }
);


formChat.onsubmit = (e)=>{
    e.preventDefault();
}

cBoton.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/engine/funciones/registro.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="/usuario";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formChatData = new FormData(formChat);

    xhr.send(formChatData);
}

