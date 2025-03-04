function progress() {
    let progress = document.querySelector('.progress');
    let loadingScreen = document.querySelector('.loading');
    let width = 0;
    let loading = setInterval(move, 50);
    
    function move() {
        if (width >= 100) {
            clearInterval(loading);
            loadingScreen.classList.add('hidden'); // Fade out effect
            
            setTimeout(() => {
                document.location = "auth/login.php";
            }, 500); // Tunggu animasi selesai
        } else {
            width += 2;
            progress.style.width = width + "%";
        }
    }
}

// Efek Mengetik
function typeEffect() {
    const text = "Loading...";
    let i = 0;
    const typingElement = document.querySelector('.typing');
    
    function type() {
        if (i < text.length) {
            typingElement.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, 100);
        }
    }

    type();
}

progress();
typeEffect();
