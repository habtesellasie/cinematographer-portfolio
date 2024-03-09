const moonIcon = document.querySelector(".bi-moon-stars-fill");
const sunIcon = document.querySelector(".bi-sun");
const rank = document.querySelector(".rank");

let darkMode = localStorage.getItem("darkMode");

const enableDarkMode = () => {
  moonIcon.style.display = "none";
  sunIcon.style.display = "flex";
  if (rank) {
    rank.style.backgroundImage = "url('./skills/REC_white.png')";
  }
  document.body.classList.add("darkmode");
  localStorage.setItem("darkMode", "enabled");
};

const disableDarkMode = () => {
  moonIcon.style.display = "flex";
  sunIcon.style.display = "none";
  if (rank) {
    rank.style.backgroundImage = "url('./skills/REC.png')";
  }
  document.body.classList.remove("darkmode");
  localStorage.setItem("darkMode", null);
};

if (darkMode === "enabled") {
  enableDarkMode();
} else {
  disableDarkMode();
}

moonIcon.addEventListener("click", enableDarkMode);
sunIcon.addEventListener("click", disableDarkMode);
