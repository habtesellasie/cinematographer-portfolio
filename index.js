const menu = document.querySelector(".fa-bars");
const toggleMenu = document.querySelectorAll(".fa");
const menuItems = document.querySelectorAll(".list-item");
const hideUnhide = document.querySelector(".hide-unhide");
const closeMenu = document.querySelector(".fa-close");

menu.addEventListener("click", function (e) {
  e.stopPropagation();
  hideUnhide.classList.toggle("active");
  toggleMenu.forEach((menus) => {
    if (e.currentTarget == menu) {
      closeMenu.style.display = "flex";
      menu.style.display = "none";
    } else {
      openIt();
    }
  });
});

closeMenu.addEventListener("click", closeIt);

function closeIt() {
  hideUnhide.classList.remove("active");
  closeMenu.style.display = "none";
  menu.style.display = "flex";
}

function openIt() {
  hideUnhide.classList.add("active");
  menu.style.display = "none";
  closeMenu.style.display = "flex";
}

function isMobile() {
  return /Mobi|Android|iPhone|iPod/i.test(navigator.userAgent);
}

function isTablet() {
  return /Tablet|iPad/i.test(navigator.userAgent);
}

function isDesktop() {
  return !isMobile() && !isTablet();
}

if (isMobile()) {
  document.body.style = "cursor: auto;";
  //?This website is being accessed by a mobile device
} else if (isTablet()) {
  //?This website is being accessed by a tablet device
} else {
  //?This website is being accessed by a desktop/laptop device
}

const gallery = document.querySelector(".gallery-item");
const popupImages = document.querySelectorAll(".gallery-item img");
const popup = document.querySelector(".popup-active");
const popupContainer = document.querySelector(".popup-container");
const html = document.querySelector("html");
const expandButton = document.querySelectorAll(".expand-popup");
const galleryParent = document.getElementById("gallery");

expandButton.forEach((button) => {
  button.addEventListener("click", function (e) {
    const parentContainer = button.closest(".img-source");
    const img = parentContainer.querySelector("img");
    let targetedImg = img.src;
    popupContainer.classList.toggle("popped");
    popup.setAttribute("src", targetedImg);
    if (img.classList.contains("landscape")) {
      popup.classList.add("landscape-style");
    } else {
      popup.classList.remove("landscape-style");
    }
    //? this overflow prevents from scrolling when the image is popped out
    html.style.overflowY = "hidden";
  });
});

const closePopup = document.querySelector(".close-popup");
closePopup.addEventListener("click", closeThePopup);
window.addEventListener("click", (e) => {
  if (e.target == popupContainer) {
    closeThePopup();
  }

  if (e.target != hideUnhide || e.target == closeMenu) {
    closeIt();
  }

  if (e.target == menu) {
    openIt();
  }
});

function closeThePopup() {
  //? reverse the overflow because the image is closed
  popup.setAttribute("src", "");
  html.style.overflowY = "auto";
  popupContainer.classList.remove("popped");
  popupContainer.classList.add("closing-popup");
}

if (window.matchMedia("(max-width: 430px)").matches) {
  // html.style.overflowY = "auto";
} else {
  // html.style.overflowY = "auto"
}

const main = document.querySelector(".main-helper");
const hireMe = document.querySelectorAll(".hire-me");
const sectionHero = document.querySelector(".section-hero");
const footer = document.querySelector("footer");
const contact = document.querySelector(".copyright");
const hireMePage = document.querySelector(".hire-me_body");

hireMe.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    hireMePage.classList.add("hire-me_page");
    html.style.overflowY = "hidden";
  });
});

const backToMain = document.querySelector(".back");
backToMain.addEventListener("click", () => {
  hireMePage.classList.remove("hire-me_page");
  html.style.overflowY = "auto";
});

const imageSource = document.querySelectorAll(".img-source");
const hireMeBottom = document.querySelector(".hire-me_bottom");

const heroSection = document.querySelector(".hero");
const hr = document.querySelectorAll("hr");

const likes = document.querySelectorAll(".like-pic");

likes.forEach((like, index) => {
  // Assigning a unique data-id value to each like button
  like.setAttribute("data-id", index + 1);

  like.addEventListener("click", () => {
    like.classList.toggle("like-coloring");
    const liked = like.classList.contains("like-coloring");
    localStorage.setItem(`liked-${like.getAttribute("data-id")}`, liked);
  });

  const liked = localStorage.getItem(`liked-${like.getAttribute("data-id")}`);
  if (liked === "true") {
    like.classList.add("like-coloring");
  }
});

window.addEventListener("scroll", () => {
  imageSource.forEach((img) => {
    const imgPosition = img.getBoundingClientRect().top;
    let fadeInPosition = window.innerHeight / 1.1;
    if (imgPosition < fadeInPosition) {
      img.classList.add("fade-in");
    } else {
      img.classList.remove("fade-in");
    }
  });
  const heroPosition = heroSection.getBoundingClientRect().top;

  hr.forEach((line) => {
    if (Math.round(heroPosition) <= 420) {
      line.style.animationPlayState = "running";
    } else {
      line.style.animationPlayState = "paused";
    }
  });
});
