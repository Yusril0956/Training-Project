<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .bounce-animation {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .gif-placeholder {
            background: linear-gradient(45deg, #f3f4f6, #e5e7eb);
            background-size: 400% 400%;
            animation: gradientShift 3s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 flex items-center justify-center p-4">
    <div class="text-center max-w-md w-full fade-in">
        <!-- 404 Heading -->
        <h1 class="text-8xl md:text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-4 bounce-animation">
            404
        </h1>
        
        <!-- Subtitle -->
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">
            Halaman 
        </h2>
        
        <p class="text-gray-600 mb-8 text-lg">
            Maaf, halaman yang Anda cari masih dalam pengembangan.
        </p>
        
        <!-- GIF Placeholder -->
        <div class="gif-placeholder rounded-2xl w-64 h-45 mx-auto mb-8 flex items-center justify-center shadow-lg">
            <div class="text-center">
                <img src="{{ asset('404.gif') }}" width="350" height="220" alt="Tabler">
                
            </div>
        </div>
        
        <!-- Home Button (Laravel 12 Compatible) -->
        <a href="{{ url('/') }}" 
           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Kembali ke Beranda
        </a>
        
        <!-- Additional Help Text -->
        <p class="text-gray-500 text-sm mt-6">
            Klik yang di atas untuk kembali ke home :>
        </p>
    </div>

    <script>
        // Laravel 12 compatible JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Add some interactive effects
            const button = document.querySelector('a[href="{{ url('/') }}"]');

            
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) translateY(0)';
            });
            
            // Optional: Add click tracking for analytics
            button.addEventListener('click', function() {
                console.log('404 page: User clicked home button');
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9782f2e8d2bfce5f',t:'MTc1NjcxMDYzNy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
