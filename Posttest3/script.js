const header = document.querySelector("header");
const modeToggle = document.getElementById("mode-toggle");
const body = document.body;
const menu = document.querySelector("#menu-icon");
const navlist = document.querySelector(".navlist");

window.addEventListener("scroll", function() {
    header.classList.toggle("sticky", window.scrollY > 0);
});

modeToggle.onclick = () => {
    body.classList.toggle("dark-mode");
    const isDarkMode = body.classList.contains("dark-mode");
    localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');

    modeToggle.classList.toggle('bx-sun', !isDarkMode);
    modeToggle.classList.toggle('bx-moon', isDarkMode);
};

window.onload = () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        modeToggle.classList.add('bx-moon');
    } else {
        modeToggle.classList.add('bx-sun');
    }
};

menu.onclick = () => {
    menu.classList.toggle("bx-x");
    navlist.classList.toggle("open");
};

window.onscroll = () => {
    menu.classList.remove("bx-x");
    navlist.classList.remove("open");
};

const welcomePopup = document.getElementById("welcome-popup");
const closeBtn = document.querySelector(".close-btn");

window.onload = () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        modeToggle.classList.add('bx-moon');
    } else {
        modeToggle.classList.add('bx-sun');
    }

    welcomePopup.style.display = "block";
};

closeBtn.onclick = () => {
    welcomePopup.style.display = "none";
};

window.onclick = (event) => {
    if (event.target === welcomePopup) {
        welcomePopup.style.display = "none";
    }
};
