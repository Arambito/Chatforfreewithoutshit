const formChat = document.querySelector(".login form"),
cBoton = formChat.querySelector(".button input"),
errorText = formChat.querySelector(".error-text");

formChat.onsubmit = (e)=>{
    e.preventDefault();
}

cBoton.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/engine/funciones/login.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href = "/usuario";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formChatDatos = new FormData(formChat);


    xhr.send(formChatDatos);
}