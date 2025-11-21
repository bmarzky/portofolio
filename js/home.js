// Daftar kata yang ingin ditampilkan
const words = [
    "Bima Rizki",
    "Passionate about learning network security",
    "Interested in exploring ethical hacking",
    "Curious about penetration testing",
    "Learning Python for cybersecurity purposes",
    "Familiar with network security basics",
    "Practicing with Wireshark",
    "Learning about firewalls and VPNs",
    "Continuous learner in cybersecurity",
];

let wordIndex = 0;
const dynamicTextElement = document.getElementById("dynamic-text");

// Fungsi untuk mengganti teks dengan animasi
function changeText() {
    // Set teks statis "Hi, I'm " sekali saja
    let currentText = "Hi,I'm ";  // Teks tetap

    // Ambil kata berikutnya dari array words
    let currentWord = words[wordIndex];
    let charIndex = 0;

    // Buat elemen kursor
    const cursor = document.createElement('span');
    cursor.classList.add('cursor'); // Menambahkan kelas cursor

    // Tambahkan kursor ke elemen dynamicTextElement
    dynamicTextElement.appendChild(cursor);

    // Fungsi untuk menambahkan karakter satu per satu
    function typeChar() {
        // Gabungkan "Hi, I'm " dengan kata yang sedang diketik
        dynamicTextElement.textContent = currentText + currentWord.substring(0, charIndex + 1);

        charIndex++;

        // Jika ada karakter yang tersisa, teruskan mengetik
        if (charIndex < currentWord.length) {
            setTimeout(typeChar, 100); // Tunggu 100ms untuk karakter berikutnya
        } else {
            // Jika teks selesai, menghapus kursor setelah 500ms
            setTimeout(() => {
                cursor.style.display = 'none';
            }, 500);
        }
    }

    // Mulai mengetik kata pertama
    typeChar();

    // Update wordIndex untuk kata berikutnya
    wordIndex = (wordIndex + 1) % words.length; // Setelah kata terakhir, mulai dari awal lagi

    // Mengubah teks setiap 4 detik (waktu ini bisa diubah sesuai kebutuhan)
    setTimeout(changeText, 4000);
}

// Panggil fungsi pertama kali untuk memulai
changeText();




// JavaScript to toggle folder content visibility
function toggleFolder(folder) {
    const content = folder.querySelector('.folder-content');
    // Toggle the max-height to allow smooth opening and closing
    if (content.style.maxHeight) {
        content.style.maxHeight = null; // Close it
    } else {
        content.style.maxHeight = content.scrollHeight + "px"; // Open it
    }
}


//moving tools
(function(){
  // Utility: waitForLoad then init
  window.addEventListener('load', () => {
    initAllSliders();
  });

  function initAllSliders(){
    document.querySelectorAll('.tools-slider').forEach(setupSlider);
  }

  function setupSlider(slider){
    const container = slider.querySelector('.tools-container');
    if(!container) return;

    // create track wrapper and move original container inside it
    const track = document.createElement('div');
    track.className = 'slider-track';
    slider.insertBefore(track, container);
    track.appendChild(container);

    // measure base width (after layout)
    const baseWidth = container.getBoundingClientRect().width;

    // clone until track scrollWidth >= baseWidth * 3 (safety)
    // ensures for both left/right directions the transition won't show empty gap
    let safety = 0;
    while (track.scrollWidth < baseWidth * 3 && safety < 30) {
      const c = container.cloneNode(true);
      track.appendChild(c);
      safety++;
    }

    // read config from data- attributes (pixels per second)
    const speedPxPerSec = Number(slider.dataset.speed) || 120; // px/s
    const direction = (slider.dataset.direction === 'right') ? 'right' : 'left';

    // initial pos: left -> 0, right -> -baseWidth (so clones cover left side)
    let pos = (direction === 'left') ? 0 : -baseWidth;
    let lastTime = null;
    let running = true;

    // pause when hovering slider area
    slider.addEventListener('mouseenter', () => { running = false; });
    slider.addEventListener('mouseleave', () => { running = true; });

    function step(timestamp){
      if (!lastTime) lastTime = timestamp;
      const dt = (timestamp - lastTime) / 1000;
      lastTime = timestamp;

      if (running) {
        const delta = speedPxPerSec * dt * (direction === 'left' ? -1 : 1);
        pos += delta;

        // reset logic using baseWidth
        if (direction === 'left') {
          // as pos goes negative, when it passed -baseWidth add baseWidth (wrap)
          if (pos <= -baseWidth) pos += baseWidth;
        } else {
          // moving right: pos increases from -baseWidth towards 0; when >= 0 subtract baseWidth
          if (pos >= 0) pos -= baseWidth;
        }

        track.style.transform = `translateX(${pos}px)`;
      }

      requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
  }

})();