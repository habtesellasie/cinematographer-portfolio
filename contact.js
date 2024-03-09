//Contact Form in PHP
const form = document.querySelector("form"),
  statusText = form.querySelector(".warning");

form.onsubmit = (e) => {
  e.preventDefault();
  statusText.style.display = "block";
  statusText.textContent = "Sending your message...";
  form.classList.add("disabled");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./contact_message.php", true);
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.response;
      if (
        response.indexOf("required") != -1 ||
        response.indexOf("valid") != -1 ||
        response.indexOf("failed") != -1
      ) {
        statusText.style.color = "indianred";
      } else {
        form.reset();
        setTimeout(() => {
          statusText.style.display = "none";
        }, 3500);
      }
      statusText.textContent = response;
      form.classList.remove("disabled");
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

const form2 = document.querySelector(".form"),
  statusText2 = document.querySelector(".warning2");

form2.onsubmit = (e) => {
  e.preventDefault();
  statusText2.style.display = "block";
  statusText2.textContent = "Sending your message...";
  form2.classList.add("disabled");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "contact_message.php", true);
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.response;
      if (
        response.indexOf("required") != -1 ||
        response.indexOf("valid") != -1 ||
        response.indexOf("failed") != -1
      ) {
        statusText2.style.color = "indianred";
      } else {
        form2.reset();
        setTimeout(() => {
          statusText2.style.display = "none";
        }, 3500);
      }
      statusText2.textContent = response;
      form2.classList.remove("disabled");
    }
  };
  let formData = new FormData(form2);
  xhr.send(formData);
};
