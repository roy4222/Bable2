<?php
require_once dirname(__FILE__) . '/includes/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- 英雄區域 - 加強邊框和陰影 -->
    <div class="bg-[#1a242c] rounded-xl p-6 sm:p-12 mb-12 relative overflow-hidden border-2 border-yellow-500/30 shadow-[0_0_15px_rgba(234,179,8,0.15)]">
        <!-- 科技感背景動畫 -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-grid-pattern animate-pulse"></div>
            <div class="absolute inset-0 bg-circuit-pattern"></div>
        </div>
        
        <!-- 主要內容 -->
        <div class="relative z-10 max-w-3xl">
            <div class="inline-block px-4 py-1 bg-yellow-500/20 rounded-full text-yellow-300 text-sm mb-4 border border-yellow-500/30 animate-pulse">
                探索新世界
            </div>
            <h1 class="text-3xl sm:text-5xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">
                歡迎來到 Bable<br>
                <span class="text-2xl sm:text-4xl opacity-80">你的二次元夢想基地</span>
            </h1>
            <p class="text-gray-300 text-lg sm:text-xl mb-8 leading-relaxed">
                這裡集結了最新動漫、遊戲資訊和科技新知，讓你瞬間掌握宅文化的最新脈動。
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <button class="group relative px-8 py-3 bg-yellow-500 text-gray-900 rounded-lg overflow-hidden transition-all duration-300 font-bold hover:bg-yellow-400">
                    <span class="relative z-10 flex items-center justify-center">
                        立即加入
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </button>
                <button class="px-8 py-3 border-2 border-yellow-500 text-yellow-400 hover:bg-yellow-500/10 rounded-lg transition-all duration-300 font-bold">
                    了解更多
                </button>
            </div>
        </div>
    </div>

    <!-- 特色內容卡片 -->
    <div class="mb-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-12 text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">
            熱門專區
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- 動漫卡片 - 加強邊框和陰影 -->
            <div class="group bg-[#1a242c] rounded-xl p-6 hover:bg-[#242e38] transition-all duration-300 border-2 border-yellow-500/30 hover:border-yellow-500/50 shadow-[0_0_15px_rgba(234,179,8,0.1)] hover:shadow-[0_0_20px_rgba(234,179,8,0.2)]">
                <div class="text-3xl mb-4">🎬</div>
                <h3 class="text-xl font-bold mb-3 text-yellow-400 group-hover:text-yellow-300">動漫專區</h3>
                <p class="text-gray-400 group-hover:text-gray-300">追番、評論、角色介紹，這裡就是你的二次元天地。</p>
            </div>

            <!-- 遊戲卡片 - 加強邊框和陰影 -->
            <div class="group bg-[#1a242c] rounded-xl p-6 hover:bg-[#242e38] transition-all duration-300 border-2 border-yellow-500/30 hover:border-yellow-500/50 shadow-[0_0_15px_rgba(234,179,8,0.1)] hover:shadow-[0_0_20px_rgba(234,179,8,0.2)]">
                <div class="text-3xl mb-4">🎮</div>
                <h3 class="text-xl font-bold mb-3 text-yellow-400 group-hover:text-yellow-300">遊戲專區</h3>
                <p class="text-gray-400 group-hover:text-gray-300">電競新聞、遊戲攻略、實況直播，一手掌握遊戲資訊。</p>
            </div>

            <!-- 複製文專區 (原科技專區) -->
            <div class="group bg-[#1a242c] rounded-xl p-6 hover:bg-[#242e38] transition-all duration-300 border-2 border-yellow-500/30 hover:border-yellow-500/50">
                <div class="text-3xl mb-4">📝</div>
                <h3 class="text-xl font-bold mb-3 text-yellow-400 group-hover:text-yellow-300">複製文專區</h3>
                <p class="text-gray-400 group-hover:text-gray-300">最新梗圖、有趣複製文、迷因分享，掌握網路流行趨勢。</p>
            </div>
        </div>
    </div>

    <!-- 最新消息區 - 加強邊框和陰影 -->
    <div class="bg-[#1a242c] rounded-xl p-6 sm:p-8 mb-12 border-2 border-yellow-500/30 shadow-[0_0_15px_rgba(234,179,8,0.15)]">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">最新動態</h2>
            <a href="#" class="text-yellow-400 hover:text-yellow-300 font-semibold flex items-center">
                查看全部
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="space-y-6">
            <!-- 新聞片 1 -->
            <div class="group bg-[#242e38] border-1 border-yellow-500/20 hover:border-yellow-500/40 p-4 rounded-lg transition-all duration-300 shadow-[0_0_10px_rgba(234,179,8,0.1)] hover:shadow-[0_0_15px_rgba(234,179,8,0.2)]">
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    2024/11/11
                </div>
                <h3 class="font-bold text-lg text-yellow-400 group-hover:text-yellow-300 mb-2">
                    《佳樹寶寶》全新版本震撼上線
                </h3>
                <p class="text-gray-400 group-hover:text-gray-300">
                    佳樹寶寶再度升級，全新版本帶來極致視覺享受，天氣功能全面進化，為您呈現更生動的體驗！
                </p>
            </div>

            <!-- 新聞卡片 2 -->
            <div class="group bg-[#242e38] border-1 border-yellow-500/20 hover:border-yellow-500/40 p-4 rounded-lg transition-all duration-300 shadow-[0_0_10px_rgba(234,179,8,0.1)] hover:shadow-[0_0_15px_rgba(234,179,8,0.2)]">
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    2024/11/02
                </div>
                <h3 class="font-bold text-lg text-yellow-400 group-hover:text-yellow-300 mb-2">
                    《溫水line bot》全新版本登場
                </h3>
                <p class="text-gray-400 group-hover:text-gray-300">
                    溫水Line Bot重磅更新，全新聊天功能讓互動更流暢、更有趣，快來體驗全新對話的魅力！
            </div>
        </div>
    </div>
</div>

<!-- 添加自定義樣式 -->
<style>
.bg-grid-pattern {
    background-image: radial-gradient(circle, rgba(255, 215, 0, 0.15) 1px, transparent 1px);
    background-size: 30px 30px;
}

.bg-circuit-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zm20.97 0l9.315 9.314-1.414 1.414L34.828 0h2.83zM22.344 0L13.03 9.314l1.414 1.414L25.172 0h-2.83zM32 0l12.142 12.142-1.414 1.414L30 .828 17.272 13.556l-1.414-1.414L28 0h4zM.284 0l28 28-1.414 1.414L0 2.544V0h.284zM0 5.373l25.456 25.455-1.414 1.415L0 8.2V5.374zm0 5.656l22.627 22.627-1.414 1.414L0 13.86v-2.83zm0 5.656l19.8 19.8-1.415 1.413L0 19.514v-2.83zm0 5.657l16.97 16.97-1.414 1.415L0 25.172v-2.83zM0 28l14.142 14.142-1.414 1.414L0 30.828V28zm0 5.657L11.314 44.97 9.9 46.386l-9.9-9.9v-2.828zm0 5.657L8.485 47.8 7.07 49.212 0 42.143v-2.83zm0 5.657l5.657 5.657-1.414 1.415L0 47.8v-2.83zm0 5.657l2.828 2.83-1.414 1.413L0 53.456v-2.83zM54.627 60L30 35.373 5.373 60H8.2L30 38.2 51.8 60h2.827zm-5.656 0L30 41.03 11.03 60h2.828L30 43.858 46.142 60h2.83zm-5.656 0L30 46.686 16.686 60h2.83L30 49.515 40.485 60h2.83zm-5.657 0L30 52.343 22.344 60h2.83L30 55.172 34.828 60h2.83zM32 60l-2-2-2 2h4z' fill='%23ffd700' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
}
</style>

<?php 
require_once dirname(__FILE__) . '/includes/footer.php';
?>