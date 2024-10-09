const header = document.querySelector("header");
const modeToggle = document.getElementById("mode-toggle");
const body = document.body;

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

document.getElementById("feedback-form").onsubmit = function(event) {
    event.preventDefault(); 

    const name = document.getElementById("name").value;
    const rating = document.getElementById("rating").value;
    const review = document.getElementById("review").value;
    const visitDate = document.getElementById("visit-date").value; 

    const resultDiv = document.getElementById("result");
    
    const reviewItem = document.createElement("div");
    reviewItem.classList.add("review-item");

    const stars = '★'.repeat(rating) + '☆'.repeat(5 - rating); 
    reviewItem.innerHTML = `<strong>${name}</strong> - ${stars}<br>Ulasan: ${review}<br><em>Tanggal Kunjungan: ${visitDate}</em>`;
    
    resultDiv.appendChild(reviewItem);
    
    document.getElementById("feedback-form").reset();
};

document.addEventListener('DOMContentLoaded', function() {
});

const menu = document.getElementById("menu-icon");
const navlist = document.getElementById("navlist");

menu.onclick = () => {
    navlist.classList.toggle("open"); 
};

window.onclick = (event) => {
    if (!menu.contains(event.target) && !navlist.contains(event.target)) {
        navlist.classList.remove("open"); 
    }
};

window.onscroll = () => {
    navlist.classList.remove("open");
};