const header = document.querySelector("header");
const modeToggle = document.getElementById("mode-toggle");
const body = document.body;
const menuIcon = document.getElementById("menu-icon");
const welcomePopup = document.getElementById("welcome-popup");
const closeBtn = document.querySelector(".close-btn");
const menu = document.getElementById("menu-icon");
const navlist = document.getElementById("navlist");
const navbar = document.getElementById('navbar');

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

menuIcon.addEventListener('click', () => {
    navbar.classList.toggle('active'); 
});

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

document.getElementById('feedback-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);

    fetch('submit_review.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var reviewsSection = document.querySelector('#reviews .center-text');
            var newReview = document.createElement('div');
            newReview.className = 'review';
            newReview.innerHTML = `
                <h3>${data.name}</h3>
                <p>Rating: ${data.rating}/5</p>
                <p>${data.review}</p>
                <p>Tanggal Kunjungan: ${data.visit_date}</p>
            `;
            reviewsSection.insertBefore(newReview, reviewsSection.firstChild);

            this.reset();

            alert('Terima kasih atas ulasan Anda!');
        } else {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    }); 
}); 

document.addEventListener('DOMContentLoaded', function() {});

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
