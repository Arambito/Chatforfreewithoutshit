const formChat = document.querySelector(".typing-area"),
id_entrada = formChat.querySelector(".id_entrada").value,
contenidoChat = formChat.querySelector(".contenido"),
enviarBoton = formChat.querySelector("button"),
chatBox = document.querySelector(".chat-box");

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
              scrollToBottom();
          }
      }
    }

    let formChatData = new FormData(formChat);

    xhr.send(formChatData);
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
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
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

