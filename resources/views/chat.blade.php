<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Laravel Echo</title>
    <!-- Pusher CDN -->
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3"></script>
    <!-- Laravel Echo CDN -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .chat-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .messages {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
            background-color: #f1f1f1;
        }
        .status {
            margin-bottom: 20px;
            font-weight: bold;
        }
        .status.online {
            color: green;
        }
        .status.offline {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container chat-container">
        <div id="status" class="status offline">Status: Offline</div>
        <h2 class="text-center">Chat Real-Time</h2>

        <!-- Formulir untuk mengirim pesan -->
        <form id="chat-form" class="mb-4">
            <div class="input-group">
                <input type="text" id="message" class="form-control" placeholder="Tulis pesan..." required>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>

        <!-- Menampilkan pesan -->
        <div id="messages" class="messages"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Ambil token CSRF dari meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
        // Inisialisasi Laravel Echo dengan Pusher
        const echo = new Echo({
            broadcaster: 'pusher',
            key: 'b2662616dc49fefe9173',
            cluster: 'ap1',
            forceTLS: true
        });
    
        const channel = echo.channel('chat');
    
        // Mendengarkan event 'MessageSent' dan menampilkan pesan baru
        channel.listen('MessageSent', (event) => {
            console.log('Pesan baru:', event.message);
            const messagesContainer = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.textContent = event.message;
            messagesContainer.appendChild(messageElement);
        });
    
        // Mengirim pesan saat formulir dikirim
        const form = document.getElementById('chat-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
    
            const message = document.getElementById('message').value;
    
            // Kirim pesan ke backend menggunakan fetch, pastikan menambahkan CSRF token
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken  // Menambahkan CSRF token di header
                },
                body: JSON.stringify({ message })
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Gagal mengirim pesan');
                }
            })
            .then(data => {
                console.log(data);
                document.getElementById('message').value = '';
            })
            .catch(error => {
                console.error(error);
            });
        });

        echo.connector.socket.on('connect', () => {
            document.getElementById('status').classList.remove('offline');
            document.getElementById('status').classList.add('online');
            document.getElementById('status').textContent = 'Status: Online';
        });

        echo.connector.socket.on('disconnect', () => {
            document.getElementById('status').classList.remove('online');
            document.getElementById('status').classList.add('offline');
            document.getElementById('status').textContent = 'Status: Offline';
        });
    </script>
</body>

</html>
