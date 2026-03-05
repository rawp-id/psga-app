<div id="psga-chatbot-container">
    <button id="chatbot-toggler" class="btn btn-primary shadow-lg d-flex align-items-center justify-content-center" 
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; border-radius: 50%; z-index: 9999; transition: transform 0.3s;">
        <i class="bi bi-chat-dots-fill fs-3"></i>
    </button>

    <div id="chatbot-window" class="card border-0 shadow-lg d-none" 
         style="position: fixed; bottom: 100px; right: 30px; width: 350px; max-height: 550px; border-radius: 20px; z-index: 9999; overflow: hidden; display: flex; flex-direction: column;">
        
        <div class="card-header border-0 text-white d-flex justify-content-between align-items-center p-3" 
             style="background: linear-gradient(135deg, #296eff 0%, #1e40af 100%);">
            <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 38px; height: 38px;">
                    <i class="bi bi-robot text-primary fs-5"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">Asisten PSGA</h6>
                    <small class="text-white-50" style="font-size: 0.75rem;"><i class="bi bi-circle-fill text-success" style="font-size: 8px;"></i> Selalu Aktif</small>
                </div>
            </div>
            <button id="chatbot-close" class="btn btn-link text-white p-0 text-decoration-none">
                <i class="bi bi-chevron-down fs-5"></i>
            </button>
        </div>

        <div id="chatbot-body" class="card-body p-3" style="overflow-y: auto; height: 380px; background-color: #f8fafc;">
            </div>

        <div class="card-footer bg-white border-0 p-3 pt-2">
            <div class="input-group shadow-sm" style="background: #f1f5f9; border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0;">
                <input type="text" id="chatbot-input" class="form-control border-0 bg-transparent shadow-none px-3" placeholder="Ketik pesan..." autocomplete="off" style="font-size: 0.9rem;">
                <button id="chatbot-send" class="btn text-primary px-3 border-0 bg-transparent">
                    <i class="bi bi-send-fill fs-5"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Bubble Chat */
    #chatbot-body {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }
    #chatbot-body::-webkit-scrollbar {
        width: 6px;
    }
    #chatbot-body::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 10px;
    }

    .chat-bubble {
        max-width: 85%;
        padding: 10px 14px;
        font-size: 0.9rem;
        line-height: 1.4;
        margin-bottom: 5px;
        word-wrap: break-word;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
    .chat-bot {
        background-color: #ffffff;
        color: #334155;
        border-radius: 15px 15px 15px 0;
        border: 1px solid #e2e8f0;
    }
    .chat-user {
        background-color: #296eff;
        color: #ffffff;
        border-radius: 15px 15px 0 15px;
        margin-left: auto;
    }
    
    /* Quick Reply Options */
    .chat-options-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
        margin-bottom: 15px;
    }
    .chat-option-btn {
        background: #eff6ff;
        color: #296eff;
        border: 1px solid #bfdbfe;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .chat-option-btn:hover {
        background: #296eff;
        color: #ffffff;
        transform: translateY(-2px);
    }
    
    /* Indikator Mengetik (Typing Animation) */
    .typing-indicator {
        padding: 12px 16px !important;
        display: flex;
        gap: 4px;
        align-items: center;
    }
    .typing-indicator span {
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: #94a3b8;
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out both;
    }
    .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
    .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }
    @keyframes typing {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    /* Animasi Buka Tutup Window */
    .chatbot-enter { animation: slideUp 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    .chatbot-exit { animation: slideDown 0.3s ease-in forwards; }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px) scale(0.9); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes slideDown {
        from { opacity: 1; transform: translateY(0) scale(1); }
        to { opacity: 0; transform: translateY(50px) scale(0.9); }
    }
    
    /* Efek Hover Tombol Float */
    #chatbot-toggler:hover { transform: scale(1.1) rotate(5deg) !important; }
    
    /* Mencegah input terpotong di mobile */
    @media (max-width: 576px) {
        #chatbot-window {
            width: calc(100% - 40px) !important;
            right: 20px !important;
            bottom: 100px !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.getElementById('chatbot-toggler');
    const windowChat = document.getElementById('chatbot-window');
    const closeBtn = document.getElementById('chatbot-close');
    const chatBody = document.getElementById('chatbot-body');
    const inputField = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send');

    let isFirstOpen = true;

    // ---------------------------------------------------------
    // RULE DICTIONARY (Ubah teks dan opsi di sini)
    // ---------------------------------------------------------
    const botRules = {
        'start': {
            msg: "Halo! Saya Asisten Virtual PSGA. Ruang aman untuk bertanya. Apa yang ingin Anda ketahui?",
            options: ['Cara Lapor', 'Konsultasi', 'Darurat', 'Edukasi']
        },
        'cara lapor': {
            msg: "Untuk melapor, Anda bisa masuk ke menu <strong>Buat Laporan</strong>. Ceritakan kejadiannya, lampirkan bukti jika ada. Data Anda kami jamin kerahasiaannya. Ingin saya arahkan ke sana?",
            options: ['Ya, ke Menu Lapor', 'Menu Utama']
        },
        'konsultasi': {
            msg: "Kami menyediakan layanan konsultasi psikologis secara rahasia. Anda bisa membuat jadwal melalui menu <strong>Konsultasi</strong>.",
            options: ['Menu Utama']
        },
        'darurat': {
            msg: "⚠️ <strong>JIKA ANDA DALAM BAHAYA SAAT INI, JANGAN PANIK.</strong><br>Segera cari tempat aman atau klik tombol Panic Button di menu utama. Anda juga bisa menghubungi Hotline Darurat kami: <strong><a href='https://wa.me/085134517160' target='_blank' style='color: #296eff; text-decoration: underline;'>0851-3451-7160</a></strong>.",
            options: ['Menu Utama']
        },
        'edukasi': {
            msg: "Kami punya Pusat Edukasi berisi artikel, video, e-book, dan mini games seputar perlindungan dan kesadaran. Silakan cek menu <strong>Edukasi</strong> ya!",
            options: ['Menu Utama']
        },
        'ya, ke menu lapor': {
            msg: "Baik, silakan klik tombol navigasi <strong>Buat Laporan</strong> di menu sebelah kiri/atas layar Anda. Jangan ragu untuk bercerita, kami ada di sini untuk mendengarkan.",
            options: ['Menu Utama']
        },
        'menu utama': {
            msg: "Ada hal lain yang bisa saya bantu?",
            options: ['Cara Lapor', 'Konsultasi', 'Darurat', 'Edukasi']
        },
        'default': {
            msg: "Maaf, saya belum mengerti maksud Anda. Anda bisa mengetik pertanyaan lain atau memilih topik di bawah ini agar saya bisa membantu dengan lebih baik.",
            options: ['Cara Lapor', 'Konsultasi', 'Darurat']
        }
    };

    // ---------------------------------------------------------
    // UI CONTROL LOGIC (Buka/Tutup)
    // ---------------------------------------------------------
    toggler.addEventListener('click', () => {
        windowChat.classList.remove('d-none', 'chatbot-exit');
        windowChat.classList.add('chatbot-enter');
        toggler.classList.add('d-none');
        
        // Hanya sapa di awal kali buka
        if (isFirstOpen) {
            setTimeout(() => { showBotMessage('start'); }, 400);
            isFirstOpen = false;
        }
        
        // Fokuskan ke input
        setTimeout(() => { inputField.focus(); }, 500);
    });

    closeBtn.addEventListener('click', () => {
        windowChat.classList.remove('chatbot-enter');
        windowChat.classList.add('chatbot-exit');
        
        // Tunggu animasi selesai baru di-hide
        setTimeout(() => {
            windowChat.classList.add('d-none');
            toggler.classList.remove('d-none');
        }, 300);
    });

    // ---------------------------------------------------------
    // CHAT ENGINE LOGIC
    // ---------------------------------------------------------
    function scrollToBottom() {
        chatBody.scrollTo({ top: chatBody.scrollHeight, behavior: 'smooth' });
    }

    function addMessageBubble(text, sender) {
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const alignClass = sender === 'user' ? 'd-flex justify-content-end' : 'd-flex justify-content-start';
        const bubbleClass = sender === 'user' ? 'chat-user' : 'chat-bot';
        
        const html = `
            <div class="${alignClass} mb-2 w-100" style="animation: slideUp 0.3s ease-out;">
                <div class="chat-bubble ${bubbleClass}">
                    ${text}
                    <div class="text-end mt-1" style="font-size: 9px; opacity: 0.7;">${time}</div>
                </div>
            </div>
        `;
        chatBody.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
    }

    function addTypingIndicator() {
        const id = 'typing-' + Date.now();
        const html = `
            <div id="${id}" class="d-flex justify-content-start mb-2 w-100">
                <div class="chat-bubble chat-bot typing-indicator">
                    <span></span><span></span><span></span>
                </div>
            </div>
        `;
        chatBody.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
        return id;
    }

    function addOptions(options) {
        if (!options || options.length === 0) return;
        
        let btnsHtml = '';
        options.forEach(opt => {
            btnsHtml += `<button class="chat-option-btn shadow-sm" onclick="handleOptionClick('${opt}')">${opt}</button>`;
        });
        
        const html = `<div class="chat-options-container" style="animation: slideUp 0.4s ease-out;">${btnsHtml}</div>`;
        chatBody.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
    }

    // Fungsi global dipanggil oleh tombol onclick HTML
    window.handleOptionClick = function(text) {
        removeLastOptions();
        addMessageBubble(text, 'user');
        
        // Proses input setelah jeda kecil
        setTimeout(() => { processInput(text); }, 300);
    };

    function removeLastOptions() {
        const lastOptions = chatBody.querySelectorAll('.chat-options-container');
        if(lastOptions.length > 0) {
            // Animasi hilang pelan
            lastOptions[lastOptions.length - 1].style.opacity = '0';
            setTimeout(() => { lastOptions[lastOptions.length - 1].remove(); }, 200);
        }
    }

    function showBotMessage(key) {
        const indicatorId = addTypingIndicator();
        
        // Waktu mikir bot (1.2 detik)
        setTimeout(() => {
            const el = document.getElementById(indicatorId);
            if(el) el.remove(); // Hapus indikator mengetik
            
            const rule = botRules[key] || botRules['default'];
            addMessageBubble(rule.msg, 'bot');
            
            // Munculkan opsi pilihan setelah bot membalas
            if (rule.options) {
                setTimeout(() => { addOptions(rule.options); }, 400);
            }
        }, 1200);
    }

    function processInput(text) {
        const lowerText = text.toLowerCase().trim();
        let matchedKey = 'default';
        
        // 1. Cek Exact Match (Cocok 100%)
        if (botRules[lowerText]) {
            matchedKey = lowerText;
        } else {
            // 2. Cek Partial Match (Mengandung Kata Kunci)
            for (const key in botRules) {
                // Hindari mencocokkan rule sistem seperti 'start' atau 'default'
                if (key !== 'start' && key !== 'default' && lowerText.includes(key)) {
                    matchedKey = key;
                    break;
                }
            }
        }
        
        showBotMessage(matchedKey);
    }

    // ---------------------------------------------------------
    // HANDLE USER TYPING
    // ---------------------------------------------------------
    function handleSend() {
        const text = inputField.value.trim();
        if (text === '') return;
        
        removeLastOptions();
        addMessageBubble(text, 'user');
        inputField.value = ''; // Kosongkan input
        
        setTimeout(() => { processInput(text); }, 300);
    }

    sendBtn.addEventListener('click', handleSend);
    inputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            handleSend();
        }
    });
});
</script>