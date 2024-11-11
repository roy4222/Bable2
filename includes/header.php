<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bable</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRu6w1L1n_jpEO94b80gNhWHTvkpCtCHvui2Q&s">
    <link href="/bable1/assets/css/output.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore-compat.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBBI9_7d2eQoWA9qGhBx4q-CKizJ2T0ikY",
            authDomain: "bable1.firebaseapp.com",
            databaseURL: "https://bable1-default-rtdb.firebaseio.com",
            projectId: "bable1",
            storageBucket: "bable1.firebasestorage.app",
            messagingSenderId: "206369386530",
            appId: "1:206369386530:web:2fe45b2f2a7470eb80da7b"
        };

        // 初始化 Firebase
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }
        const auth = firebase.auth();
        const db = firebase.firestore();

        // 等待 DOM 完全載入
        window.addEventListener('DOMContentLoaded', function() {
            // 下拉選單功能
            function toggleDropdown(id) {
                const dropdown = document.getElementById(id);
                if (dropdown) {
                    const allDropdowns = document.querySelectorAll('.dropdown-menu');
                    
                    allDropdowns.forEach(menu => {
                        if (menu.id !== id && !menu.classList.contains('hidden')) {
                            menu.classList.add('hidden');
                        }
                    });
                    
                    dropdown.classList.toggle('hidden');
                }
            }

            // 點擊其他地方時關閉下拉選單
            document.addEventListener('click', function(event) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                const dropdownButtons = document.querySelectorAll('.dropdown-button');
                
                let clickedDropdown = false;
                dropdownButtons.forEach(button => {
                    if (button.contains(event.target)) {
                        clickedDropdown = true;
                    }
                });

                if (!clickedDropdown) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.add('hidden');
                    });
                }
            });

            // 移動選單功能
            window.toggleMobileMenu = function() {
                const menu = document.getElementById('mobile-menu');
                if (menu) {
                    const menuContent = menu.querySelector('.fixed.top-0');
                    const body = document.body;
                    
                    menu.classList.toggle('hidden');
                    
                    if (!menu.classList.contains('hidden')) {
                        setTimeout(() => {
                            menuContent.classList.remove('-translate-y-full');
                        }, 10);
                        body.style.overflow = 'hidden';
                    } else {
                        menuContent.classList.add('-translate-y-full');
                        body.style.overflow = '';
                    }
                }
            };

            // 添加子選單切換功能
            window.toggleMobileSubmenu = function(id) {
                const submenu = document.getElementById(id);
                const button = submenu.previousElementSibling;
                const arrow = button.querySelector('svg');
                
                if (submenu) {
                    submenu.classList.toggle('hidden');
                    
                    // 旋轉箭頭
                    if (submenu.classList.contains('hidden')) {
                        arrow.style.transform = 'rotate(0deg)';
                    } else {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                }
            };

            // 點擊背景關閉選單
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) {
                mobileMenu.addEventListener('click', function(e) {
                    if (e.target === this || e.target.classList.contains('backdrop-blur-sm')) {
                        toggleMobileMenu();
                    }
                });
            }
        });
    </script>
    <!-- 添加全局樣式 -->
    <style>
        :root {
            --primary-yellow: #FFD700;
            --primary-dark: rgb(36, 46, 54);
            --secondary-dark: rgb(26, 36, 44);
            --hover-yellow: #FFC107;
        }

        body {
            background-color: var(--secondary-dark);
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(255, 215, 0, 0.03) 0%, transparent 100%),
                linear-gradient(rgba(255, 215, 0, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 215, 0, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 20px 20px, 20px 20px;
            background-position: 0 0, center center, center center;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-gray-100">
    <!-- 修改提示訊息元素的樣式 -->
    <div id="globalToast" class="fixed top-4 left-1/2 -translate-x-1/2 transform z-[9999] transition-all duration-300 opacity-0 -translate-y-full pointer-events-none">
        <div class="flex items-center p-6 rounded-lg shadow-xl min-w-[400px] border backdrop-blur-md">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 me-4">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"></svg>
            </div>
            <div class="text-base font-semibold"></div>
        </div>
    </div>

    <script>
    function showGlobalToast(message, type = 'success') {
        const toast = document.getElementById('globalToast');
        const icon = toast.querySelector('svg');
        const text = toast.querySelector('.text-base');
        const container = toast.querySelector('.flex');
        
        // 設置訊息
        text.textContent = message;
        
        // 根據類型設置樣式
        if (type === 'success') {
            container.className = 'flex items-center p-6 rounded-lg shadow-xl min-w-[400px] text-green-500 bg-green-100/95 border border-green-200 backdrop-blur-md';
            icon.innerHTML = '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>';
        } else if (type === 'error') {
            container.className = 'flex items-center p-6 rounded-lg shadow-xl min-w-[400px] text-red-500 bg-red-100/95 border border-red-200 backdrop-blur-md';
            icon.innerHTML = '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>';
        }
        
        // 顯示提示
        toast.classList.remove('opacity-0', '-translate-y-full');
        toast.classList.add('opacity-100', 'translate-y-0');
        
        // 3秒後隱藏
        setTimeout(() => {
            toast.classList.add('opacity-0', '-translate-y-full');
            toast.classList.remove('opacity-100', 'translate-y-0');
        }, 3000);
    }

            // 監聽登入、註冊和登出事件
        document.addEventListener('DOMContentLoaded', function() {
            // 只保留登出按鈕的處理
            const logoutButton = document.querySelector('a[href="/bable1/api/logout.php"]');
            if (logoutButton) {
                logoutButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    showGlobalToast('登出成功！', 'success');
                    setTimeout(() => {
                        window.location.href = '/bable1/api/logout.php';
                    }, 1500);
                });
            }
        });
    
    </script>

    <header class="bg-[#1a242c]/90 backdrop-blur-md border-b border-yellow-900/20 sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo 區域 -->
                <a href="index.php" class="flex items-center space-x-2 group">
                    <svg class="w-8 h-8 text-yellow-500 transform transition-transform group-hover:scale-110 group-hover:rotate-12 duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="text-2xl font-bold relative">
                        <!-- 背景漸變效果 -->
                        <span class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 bg-clip-text opacity-0 group-hover:opacity-100 blur-sm transition-opacity duration-300"></span>
                        <!-- 主要文字 -->
                        <span class="relative bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent filter hover:brightness-125 transition-all duration-300 group-hover:tracking-wider">
                            Bable
                        </span>
                        <!-- 發光效果 -->
                        <span class="absolute inset-0 bg-yellow-400/20 blur-md rounded-lg opacity-0 group-hover:opacity-50 transition-opacity duration-300"></span>
                    </span>
                </a>

                <!-- 導航選項和用戶資訊 -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="index.php" class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300">首頁</a>
                    
                    <!-- 動漫專區下拉選單 -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300 flex items-center group py-2">
                            動漫專區
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute left-0 pt-2 w-48">
                            <div class="absolute -inset-2 bg-transparent"></div>
                            <div class="relative bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 overflow-hidden">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">新番列表</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">動漫評論</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">角色設定</a>
                            </div>
                        </div>
                    </div>

                    <!-- 遊戲專區下拉選單 -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300 flex items-center group py-2">
                            遊戲專區
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute left-0 pt-2 w-48">
                            <div class="absolute -inset-2 bg-transparent"></div>
                            <div class="relative bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 overflow-hidden">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">遊戲資訊</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">攻略專區</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">實況直播</a>
                            </div>
                        </div>
                    </div>

                    <!-- 複製文專區下拉選單 -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300 flex items-center group py-2">
                            複製文專區
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute right-0 pt-2 w-48">
                            <div class="absolute -inset-2 bg-transparent"></div>
                            <div class="relative bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 overflow-hidden">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">最新梗圖</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">熱門複製文</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">迷因分享</a>
                            </div>
                        </div>
                    </div>

                    <!-- 討論區下拉選單 -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300 flex items-center group py-2">
                        討論區
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute right-0 pt-2 w-48">
                            <div class="absolute -inset-2 bg-transparent"></div>
                            <div class="relative bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 overflow-hidden">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">綜合討論</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">作品討論</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">問題求助</a>
                            </div>
                        </div>
                    </div>

                    <!-- 用戶資訊下拉選單 -->
                    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <div class="relative" x-data="{ open: false, timeout: null }" 
                             @mouseleave="timeout = setTimeout(() => open = false, 300)">
                            <button @mouseenter="clearTimeout(timeout); open = true" 
                                    @click="open = !open"
                                    class="flex items-center space-x-2 text-gray-300 hover:text-yellow-400 transition duration-300">
                                <img class="w-8 h-8 rounded-full border-2 border-yellow-500" 
                                     src="<?php echo isset($_SESSION['user']['photoURL']) ? htmlspecialchars($_SESSION['user']['photoURL']) : 'https://ui-avatars.com/api/?name=' . urlencode($_SESSION['user']['displayName']) . '&background=ffd700&color=1a242c'; ?>" 
                                     alt="用戶頭像">
                                <span class="font-medium"><?php echo htmlspecialchars($_SESSION['user']['displayName']); ?></span>
                                <svg class="w-4 h-4 transition-transform" 
                                     :class="{ 'rotate-180': open }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @mouseenter="clearTimeout(timeout); open = true"
                                 @mouseleave="timeout = setTimeout(() => open = false, 300)"
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 z-50">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-all duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span>個人資料</span>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-all duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span>我的收藏</span>
                                        </div>
                                    </a>
                                    <div class="border-t border-yellow-900/20 my-1"></div>
                                    <a href="/bable1/api/logout.php" class="block px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 transition-all duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>登出</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- 登入按鈕 -->
                        <a href="login.php" class="relative inline-flex items-center justify-center px-6 py-2 overflow-hidden font-bold text-yellow-500 transition-all duration-300 border-2 border-yellow-500 rounded-lg hover:border-yellow-400 group">
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-yellow-500 via-yellow-500/50 to-transparent"></span>
                            <span class="relative flex items-center gap-2">
                                <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                登入
                            </span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- 手機版選單按鈕 -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gray-300 hover:text-yellow-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- 手機版選單 - 從上往下展開 -->
            <div id="mobile-menu" class="hidden fixed inset-0 z-[9999]">
                <!-- 背景遮罩 -->
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
                
                <!-- 選單內容 - 從上往下展開 -->
                <div class="fixed top-0 left-0 w-full bg-[#1a242c] border-b border-yellow-900/20 transform transition-transform duration-300 -translate-y-full">
                    <!-- 選單頂部 -->
                    <div class="flex items-center justify-between p-4 border-b border-yellow-900/20">
                        <div class="flex items-center space-x-2">
                            <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                            </svg>
                            <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Bable</span>
                        </div>
                        <button onclick="toggleMobileMenu()" class="text-gray-400 hover:text-yellow-400 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- 選單內容 -->
                    <div class="max-h-[70vh] overflow-y-auto">
                        <nav class="p-4 space-y-2">
                            <a href="index.php" class="block text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                首頁
                            </a>

                            <!-- 動漫專區 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('anime-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>動漫專區</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="anime-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">新番列表</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">動漫評論</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">角色設定</a>
                                </div>
                            </div>

                            <!-- 遊戲專區 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('game-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>遊戲專區</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="game-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">遊戲資訊</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">攻略專區</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">實況直播</a>
                                </div>
                            </div>

                            <!-- 複製文專區 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('copypasta-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>複製文專區</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="copypasta-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">最新梗圖</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">熱門複製文</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">迷因分享</a>
                                </div>
                            </div>

                            <!-- 討論區 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('forum-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>討論區</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="forum-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">綜合討論</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">作品討論</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">問題求助</a>
                                </div>
                            </div>

                            <!-- 社群 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('community-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>社群</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="community-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">Discord</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">Twitter</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">Facebook</a>
                                </div>
                            </div>
                        </nav>

                        <!-- 用戶資訊區 -->
                        <div class="p-4 border-t border-yellow-900/20">
                            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                                <div class="flex items-center space-x-3 mb-4">
                                    <img class="w-10 h-10 rounded-full border-2 border-yellow-500" 
                                         src="<?php echo isset($_SESSION['user']['photoURL']) ? htmlspecialchars($_SESSION['user']['photoURL']) : 'https://ui-avatars.com/api/?name=' . urlencode($_SESSION['user']['displayName']) . '&background=ffd700&color=1a242c'; ?>" 
                                         alt="用戶頭像">
                                    <span class="font-medium text-gray-300"><?php echo htmlspecialchars($_SESSION['user']['displayName']); ?></span>
                                </div>
                                <div class="space-y-2">
                                    <a href="#" class="flex items-center text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        個人資料
                                    </a>
                                    <a href="#" class="flex items-center text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        我的收藏
                                    </a>
                                    <a href="/bable1/api/logout.php" class="flex items-center text-red-400 hover:text-red-300 p-2 hover:bg-red-500/10 rounded-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        登出
                                    </a>
                                </div>
                            <?php else: ?>
                                <a href="login.php" class="flex items-center justify-center bg-yellow-500 text-gray-900 p-2 rounded-lg hover:bg-yellow-400 transition-colors font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    登入
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-grow">
</body>
</html>
    