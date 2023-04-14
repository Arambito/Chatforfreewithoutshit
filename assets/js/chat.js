const formChat = document.querySelector(".typing-area"),
id_entrada = formChat.querySelector(".id_entrada").value,
contenidoChat = formChat.querySelector(".contenido"),
enviarBoton = formChat.querySelector("button"),
chatBox = document.querySelector(".chat-box"),
screen = document.querySelector(".contenedor-loader");
screen.style.display = "block";
screen.style.animation = "fadeIn 0.2s";   

formChat.onsubmit = (e)=>{
    e.preventDefault();
}

contenidoChat.focus();
contenidoChat.onkeyup = ()=>{
    if(contenidoChat.value != ""){
        enviarBoton.classList.add("active");
    }else{
        enviarBoton.classList.remove("active");
    }
}

enviarBoton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../engine/funciones/insertar_chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              contenidoChat.value = "";
          }
      }
    }

    let formChatData = new FormData(formChat);

    xhr.send(formChatData);
    scrollToBottom()
}
chatBox.onmouseenter = () =>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../engine/funciones/obtener_chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            screen.style.display = "none"; 
            screen.style.animation = "fadeOut 0.2s";
            chatBox.style.animation = "fadeIn 0.5s";
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id_entrada="+id_entrada);
}, 500);

const scrollToBottom = () => {
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  window.addEventListener('load', () => {
    scrollToBottom();
  });
  