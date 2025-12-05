const burgerBtn = document.getElementById("burgerBtn");
const sidebar = document.getElementById("sidebar");

// efek klik burger, buka/tutup sidebar
burgerBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");

    // ganti icon burger jadi silang / sebaliknya
    burgerBtn.querySelector("i").classList.toggle("fa-bars");
    burgerBtn.querySelector("i").classList.toggle("fa-times");
});

// DYNAMIC TYPING TEXT
document.addEventListener("DOMContentLoaded", () => {
    const dynamicTextElement = document.getElementById("dynamic-text");
    if (!dynamicTextElement) return;

    const words = [
        "Bima Rizki",
        "Passionate about learning network security",
        "Interested in exploring ethical hacking",
        "Curious about penetration testing",
        "Learning Python for cybersecurity purposes",
        "Familiar with network security basics",
        "Practicing with Wireshark",
        "Exploring firewalls and VPNs"
    ];

    let wordIndex = 0;
    const prefix = "Hi, I'm ";

    // efek kedip habis ngetik
    function blinkEffect(callback) {
        const wordElement = dynamicTextElement.querySelector(".dynamic-word");
        let blinkCount = 0;
        const totalBlinks = 4;

        const interval = setInterval(() => {
            const isVisible = wordElement.style.opacity === "1";
            wordElement.style.opacity = isVisible ? "0" : "1";
            blinkCount++;
            if (blinkCount >= totalBlinks * 2) {
                clearInterval(interval);
                wordElement.style.opacity = "1";
                callback();
            }
        }, 100);
    }

    // ngetik tiap huruf
    function typeWord(word, callback) {
        dynamicTextElement.innerHTML = prefix + `<span class="dynamic-word"></span>`;
        const wordElement = dynamicTextElement.querySelector(".dynamic-word");
        let charIndex = 0;

        function typeChar() {
            wordElement.textContent = word.substring(0, charIndex + 1);
            charIndex++;
            if (charIndex < word.length) {
                setTimeout(typeChar, 100);
            } else {
                blinkEffect(callback);
            }
        }

        typeChar();
    }

    // mulai ngetik loop kata-kata
    function startTyping() {
        typeWord(words[wordIndex], () => {
            wordIndex = (wordIndex + 1) % words.length;
            startTyping();
        });
    }

    startTyping();
});

// TOOLS SLIDER — SUPER SMOOTH
(function () {
    window.addEventListener('load', initAllSliders);

    function initAllSliders() {
        document.querySelectorAll('.tools-slider').forEach(setupSlider);
    }

    function setupSlider(slider) {
        const container = slider.querySelector('.tools-container');
        if (!container) return;

        // bikin track baru, masukin container ke track
        const track = document.createElement('div');
        track.className = 'slider-track';
        slider.insertBefore(track, container);
        track.appendChild(container);

        let clones = [];
        let baseWidth;

        // clone container biar slider panjang
        function rebuildClones() {
            clones.forEach(c => c.remove());
            clones = [];
            track.innerHTML = '';
            track.appendChild(container);

            baseWidth = container.getBoundingClientRect().width;
            const viewportWidth = slider.offsetWidth;

            let safety = 0;
            while (track.scrollWidth < viewportWidth * 5 && safety < 50) {
                const clone = container.cloneNode(true);
                track.appendChild(clone);
                clones.push(clone);
                safety++;
            }
        }

        rebuildClones();

        const speedPxPerSec = Number(slider.dataset.speed) || 120;
        const direction = slider.dataset.direction === 'right' ? 'right' : 'left';
        let pos = direction === 'left' ? 0 : -baseWidth;
        let lastTime = null;
        let running = true;

        // pause slider pas hover
        slider.addEventListener('mouseenter', () => running = false);
        slider.addEventListener('mouseleave', () => running = true);

        // animasi slider
        function step(timestamp) {
            if (!lastTime) lastTime = timestamp;
            const dt = (timestamp - lastTime) / 1000;
            lastTime = timestamp;

            if (running) {
                const delta = speedPxPerSec * dt * (direction === 'left' ? -1 : 1);
                pos += delta;

                if (direction === 'left' && pos <= -baseWidth) pos += baseWidth;
                if (direction === 'right' && pos >= 0) pos -= baseWidth;

                track.style.transform = `translateX(${pos}px)`;
            }
            requestAnimationFrame(step);
        }

        requestAnimationFrame(step);

        // handle resize biar clone ikut update
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                rebuildClones();
                pos = direction === 'left' ? 0 : -baseWidth;
                track.style.transform = `translateX(${pos}px)`;
            }, 200);
        });
    }
})();

// SCRAMBLE NUMBER STATS
document.addEventListener("DOMContentLoaded", () => {
    const stats = document.querySelectorAll(".stat-number");
    if (!stats.length) return;

    const chars = "#@!$%^&*()_+-=<>?|0123456789";

    // acak angka sebelum muncul nilai final
    function chaoticScramble(element, finalValue) {
        let frame = 0;
        const digitLimit = finalValue.toString().length;
        const maxFrames = 30 + Math.random() * 20;
        const randomDelay = Math.random() * 800;

        setTimeout(() => {
            const interval = setInterval(() => {
                frame++;
                let scramble = "";
                let scrambleLength = Math.floor(Math.random() * digitLimit) + 1;

                for (let i = 0; i < scrambleLength; i++) {
                    scramble += chars[Math.floor(Math.random() * chars.length)];
                }

                element.style.visibility = Math.random() < 0.5 ? "hidden" : "visible";
                element.textContent = scramble;

                if (frame >= maxFrames) {
                    clearInterval(interval);
                    element.style.visibility = "visible";
                    element.textContent = finalValue;
                }
            }, 60 + Math.random() * 40);
        }, randomDelay);
    }

    stats.forEach(stat => chaoticScramble(stat, stat.dataset.target || "0"));
});

// ABOUT PAGE — TAB SYSTEM
document.addEventListener("DOMContentLoaded", () => {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const tabSlider = document.querySelector('.tab-slider');

    // geser slider ke tab aktif
    function moveSlider(active) {
        if (!active || !tabSlider) return;
        const rect = active.getBoundingClientRect();
        const parent = active.parentElement.getBoundingClientRect();
        tabSlider.style.width = rect.width + "px";
        tabSlider.style.left = (rect.left - parent.left) + "px";
    }

    moveSlider(document.querySelector('.tab-btn.active'));

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // hapus active semua
            tabButtons.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            // set active tab ini
            btn.classList.add('active');
            document.getElementById(btn.dataset.target)?.classList.add('active');

            moveSlider(btn);
        });
    });
});


// GRID PROJECTS
document.addEventListener("DOMContentLoaded", function() {
    const projectsGrid = document.getElementById("projectsGrid");
    const cards = Array.from(projectsGrid.children); // semua card
    const pagination = document.getElementById("pagination");
    const perPage = 9; // 3x3 per halaman
    let currentPage = 1;
    const totalPages = Math.ceil(cards.length / perPage);

    // tampilkan halaman tertentu
    function showPage(page) {
        const start = (page - 1) * perPage;
        const end = start + perPage;
        cards.forEach((card, i) => {
            card.style.display = (i >= start && i < end) ? "flex" : "none";
        });
    }

    // bikin tombol pagination
    function renderPagination() {
        // sembunyiin pagination kalau total card <= perPage
        if (cards.length <= perPage) {
            pagination.style.display = "none";
            return;
        } else {
            pagination.style.display = "flex";
        }

        pagination.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            if (i === currentPage) btn.classList.add("active");
            btn.addEventListener("click", () => {
                currentPage = i;
                showPage(currentPage);
                renderPagination(); // update active button
            });
            pagination.appendChild(btn);
        }
    }

    showPage(currentPage);
    renderPagination();
});


//check-pass
async function checkPass() {
    const key = document.getElementById("contactKey").value.trim();
    const status = document.getElementById("contact-status");
    const contactDiv = document.getElementById("contact-info");

    if (!key) {
        status.innerText = "⚠ Please enter a key";
        status.style.color = "#f55";
        return;
    }

    try {
        // Step 1: cek password
        const res = await fetch("api/contact_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "mode=check&key=" + encodeURIComponent(key)
        });
        const data = await res.json();

        if (data.status !== "ok") {
            status.innerText = "✖ Wrong Key";
            status.style.color = "#f55";
            contactDiv.innerHTML = "";
            contactDiv.classList.remove("show");
            return;
        }

        // Step 2: ambil kontak
        const resContacts = await fetch("api/contact_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "mode=get&key=" + encodeURIComponent(key)
        });
        const dataContacts = await resContacts.json();

        if (dataContacts.status === "ok") {
            status.innerText = "✔ Access Granted";
            status.style.color = "#0f0";
            contactDiv.innerHTML = dataContacts.html;
            contactDiv.classList.add("show"); // tampil grid
        } else {
            status.innerText = "⚠ Failed to load contacts";
            status.style.color = "#f55";
            contactDiv.innerHTML = "";
            contactDiv.classList.remove("show");
        }

    } catch (err) {
        console.error(err);
        status.innerText = "⚠ Error connecting to server";
        status.style.color = "#f55";
        contactDiv.innerHTML = "";
        contactDiv.classList.remove("show");
    }
}

//icon-info
document.querySelector(".info-icon").addEventListener("click", function() {
    document.getElementById("hunter-overlay").style.display = "block";
    document.getElementById("hunter-terminal").style.display = "block";
});

// Tutup terminal jika overlay diklik
document.getElementById("hunter-overlay").addEventListener("click", function() {
    document.getElementById("hunter-overlay").style.display = "none";
    document.getElementById("hunter-terminal").style.display = "none";
});