const passInput = document.querySelector(".form input[type='password']"),
toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = () =>{
  if(passInput.type === "password"){
    passInput.type = "text";
    toggleIcon.classList.add("active");
  }else{
    passInput.type = "password";
    toggleIcon.classList.remove("active");
  }
}
