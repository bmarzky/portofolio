<!-- LOADER -->
<div id="globalLoader"></div>

<style>
#globalLoader {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.94);
    opacity: 0;
    z-index: 999999;
    overflow: hidden;
    transition: opacity 1s ease;
    pointer-events: none; /* default: tidak menyerap klik */
}

#globalLoader.show {
    opacity: 1;
    display: block;
    pointer-events: auto; /* aktifkan klik saat loader muncul */
}

#globalLoader.hide {
    opacity: 0;
    pointer-events: none; /* biar klik bisa diteruskan */
}


.loader-box {
    position: absolute;
    width: 380px;
    padding: 18px;
    background-color: rgba(10, 10, 10, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #bbb;
    font-family: "Courier New", monospace;
    /* box-shadow: 0 0 18px rgba(0, 255, 0, 0.8); */
    border-radius: 8px;
    opacity: 0;
    transform: scale(0.8);
    /* transition: opacity 0.6s cubic-bezier(0.42,0,0.58,1), transform 0.6s cubic-bezier(0.42,0,0.58,1); */
}
.loader-box.show { opacity: 1; transform: scale(1); }
.loader-box.hide { opacity: 0; transform: scale(0.6); }

.loader-digits { height: 60px; overflow: hidden; font-size: 18px; margin-bottom: 10px; }
.progress-bar { width: 100%; height: 6px; background: rgba(255, 255, 255, 0.25); border-radius: 6px; }
.progress-fill { height: 6px; width: 0%; background: rgba(255, 255, 255, 1); transition: width .2s linear; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("globalLoader");
    let loaderQueue = [];
    let chaosActive = false;
    const maxLoaders = 20;
    let showingLoader = false;

    function createLoader() {
        const box = document.createElement("div");
        box.className = "loader-box";
        box.innerHTML = `
            <div class="loader-title">[ SYSTEM FAILURE ]</div>
            <div class="loader-digits"></div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        `;
        // posisi acak awal
        box.style.left = Math.random() * window.innerWidth + "px";
        box.style.top = Math.random() * window.innerHeight + "px";
        container.appendChild(box);
        return box;
    }

    async function showLoadersSmooth() {
        if (showingLoader) return;
        showingLoader = true;
        container.classList.add("show");

        for (let i = 0; i < loaderQueue.length; i++) {
            loaderQueue[i].classList.add("show");
            await new Promise(r => setTimeout(r, 200 + Math.random()*300)); // acak delay tiap loader
        }

        chaosActive = true;
        showingLoader = false;
    }

    async function addLoader() {
        if (loaderQueue.length >= maxLoaders) return;
        const loader = createLoader();
        loaderQueue.push(loader);
        await showLoadersSmooth();
    }

    async function hideLoaders() {
        chaosActive = false;
        for (let i = loaderQueue.length - 1; i >= 0; i--) {
            loaderQueue[i].classList.add("hide");
            await new Promise(r => setTimeout(r, 150 + Math.random()*150));
            loaderQueue[i].remove();
        }
        loaderQueue = [];
        container.classList.remove("show");
        container.classList.add("hide");
        setTimeout(() => container.style.display = "none", 1000);
    }

    function randomDigits(div) {
        let out = "";
        for (let i = 0; i < 5; i++) {
            let line = "";
            for (let j = 0; j < 28; j++) line += Math.floor(Math.random()*10);
            out += line + "<br>";
        }
        div.innerHTML = out;
    }

    function moveChaos(box) {
        if (!chaosActive) return;
        const W = window.innerWidth - box.offsetWidth;
        const H = window.innerHeight - box.offsetHeight;
        box.style.left = Math.random() * W + "px";
        box.style.top = Math.random() * H + "px";
        box.style.opacity = 0.3 + Math.random()*0.7;
    }

    function glitchProgress(bar) {
        if (!chaosActive) return;
        let val = Math.max(0, Math.min(100, Math.floor(Math.random()*130)-20));
        bar.style.width = val + "%";
    }


    // loop untuk update angka
    setInterval(() => {
        loaderQueue.forEach(box => {
            if (!chaosActive) return;
            const digits = box.querySelector(".loader-digits");
            randomDigits(digits);
        });
    }, 120); // update tiap 120ms, bisa diubah lebih cepat/lambat



    // chaos loop
    setInterval(() => {
        loaderQueue.forEach(box => {
            if (!chaosActive) return;
            const digits = box.querySelector(".loader-digits");
            const bar = box.querySelector(".progress-fill");
            randomDigits(digits);
            glitchProgress(bar);
            moveChaos(box);
        });
    }, 250);

    async function checkConnection() {
        try {
            const controller = new AbortController();
            setTimeout(() => controller.abort(), 1000);
            await fetch("ping.php",{method:"HEAD", signal:controller.signal});
            if(loaderQueue.length>0) await hideLoaders();
        } catch {
            await addLoader();
        }
    }

    checkConnection();
    setInterval(checkConnection, 1500);

    // perbaikan offline → selalu bisa muncul lagi
    window.addEventListener("offline", async () => {
        // reset queue agar bisa muncul ulang
        chaosActive = false;
        loaderQueue.forEach(box => box.remove());
        loaderQueue = [];
        container.style.display = "block";
        container.classList.remove("hide");
        container.classList.add("show");

        await addLoader();
    });

    window.addEventListener("online", async () => {
        if(loaderQueue.length>0) await hideLoaders();
    });
});
</script>
