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

const inputImage = document.querySelector('.select-image');
const previewImage = document.querySelector('.preview-img');

inputImage.addEventListener('change', function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener('load', function () {
      previewImage.style.backgroundImage = `url('${reader.result}')`;
    });
    reader.readAsDataURL(file);
  } else {
    previewImage.style.backgroundImage = null;
  }
});

const field = document.querySelector('.image-label .field');
const inputFilename = document.querySelector('.select-image');

inputFilename.addEventListener('change', function () {
  const filename = inputFilename.value.split('\\').pop().substring(0, 20) + '...';
  field.textContent = filename;
});
