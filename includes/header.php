<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "你的_API_KEY",
            authDomain: "你的專案網域.firebaseapp.com",
            projectId: "你的專案ID",
            storageBucket: "你的儲存桶.appspot.com",
            messagingSenderId: "你的發送者ID",
            appId: "你的應用程式ID"
        };

        // 初始化 Firebase
        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();
        const db = firebase.firestore();

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            
            // 關閉其他所有下拉選單
            allDropdowns.forEach(menu => {
                if (menu.id !== id && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
            
            // 切換目前的下拉選單
            dropdown.classList.toggle('hidden');
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

        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const menuContent = menu.querySelector('.fixed.top-0');
            const body = document.body;
            
            menu.classList.toggle('hidden');
            
            // 控制選單滑入滑出動畫
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

        function toggleMobileSubmenu(id) {
            const submenu = document.getElementById(id);
            const button = submenu.previousElementSibling;
            const arrow = button.querySelector('svg');
            
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        // 點擊背景關閉選單
        document.getElementById('mobile-menu').addEventListener('click', function(e) {
            if (e.target === this || e.target.classList.contains('backdrop-blur-sm')) {
                toggleMobileMenu();
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

                    <!-- 科��專區下拉選單 -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-yellow-400 font-medium transition duration-300 flex items-center group py-2">
                            科技專區
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute right-0 pt-2 w-48">
                            <div class="absolute -inset-2 bg-transparent"></div>
                            <div class="relative bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20 overflow-hidden">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">數碼產品</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">科技新聞</a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400 transition-colors">評測報告</a>
                            </div>
                        </div>
                    </div>

                    <!-- 科技專區下拉選單 -->
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

                    <!-- 登入按鈕 - 修改這部分 -->
                    <?php if(!isset($_SESSION['loggedin'])): ?>
                        <a href="login.php" class="relative inline-flex items-center justify-center px-6 py-2 overflow-hidden font-bold text-yellow-500 transition-all duration-300 border-2 border-yellow-500 rounded-lg hover:border-yellow-400 group">
                            <!-- 動畫背景 -->
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-yellow-500 via-yellow-500/50 to-transparent"></span>
                            <span class="relative flex items-center gap-2">
                                <!-- 登入圖標 -->
                                <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                登入
                                <!-- 裝飾性光效 -->
                                <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-yellow-500 opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- 用戶資訊下拉選單 -->
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-300 hover:text-yellow-400 transition duration-300">
                            <img class="w-8 h-8 rounded-full border-2 border-yellow-500" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['username']); ?>&background=ffd700&color=1a242c" alt="用戶頭像">
                            <span class="font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-[#1a242c] rounded-lg shadow-lg border border-yellow-900/20">
                            <!-- 用戶選單內容 -->
                            <div class="py-1">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-yellow-500/10 hover:text-yellow-400">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    個人資料
                                </a>
                                <!-- 其他選單項目 -->
                                <div class="border-t border-yellow-900/20"></div>
                                <a href="logout.php" class="flex items-center px-4 py-2 text-sm text-red-400 hover:bg-red-500/10">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    登出
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

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

                            <!-- 科技專區 -->
                            <div class="space-y-2">
                                <button onclick="toggleMobileSubmenu('tech-mobile')" 
                                        class="w-full flex items-center justify-between text-gray-300 hover:text-yellow-400 p-2 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <span>科技專區</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="tech-mobile" class="hidden pl-4 space-y-2 bg-gray-800/50 rounded-lg">
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">數碼產品</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">科技新聞</a>
                                    <a href="#" class="block p-2 text-gray-400 hover:text-yellow-400">評測報告</a>
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
                                         src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['username']); ?>&background=ffd700&color=1a242c" 
                                         alt="用戶頭像">
                                    <span class="font-medium text-gray-300"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
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
                                    <a href="logout.php" class="flex items-center text-red-400 hover:text-red-300 p-2 hover:bg-red-500/10 rounded-lg">
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
    