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


formChat.onsubmit = (e) => {
  e.preventDefault();
}

cBoton.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/engine/funciones/registro.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          location.href = "/usuario";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  }
  let formChatData = new FormData(formChat);

  xhr.send(formChatData);
}

const input = document.querySelector('#imagen_usuario');
const preview = document.querySelector('#preview');
const label = document.querySelector('.image-preview label');
const maxFileNameLength = 20;

input.addEventListener('change', () => {
  const file = input.files[0];
  const reader = new FileReader();

  reader.addEventListener('load', () => {
    preview.src = reader.result;
    preview.style.display = 'block';
  });

  if (file) {
    reader.readAsDataURL(file);
    const fileName = file.name.length > maxFileNameLength ? '<span style="font-weight: 500;">Seleccionado:</span> ' + file.name.substring(0, maxFileNameLength) + '...' : '<span style="font-weight: 500;">Seleccionado:</span> ' + file.name;
    label.innerHTML = fileName;
    label.style.width = '90%';
    label.style.backgroundColor = '#4c7aaf';
    label.style.lineHeight = '45px';
    label.style.fontWeight = '100';
  }
  
});
