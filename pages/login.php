<?php
require_once dirname(__DIR__) . '/includes/header.php';

// 檢查是否已經登入
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: /index.php');
    exit;
}

$firebaseConfig = require_once dirname(__DIR__) . '/config/firebase-config.php';
?>

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- 登入卡片 -->
        <div class="bg-[#1a242c] rounded-xl shadow-2xl border border-yellow-900/20 p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">
                    歡迎回到 Bable
                </h2>
                <p class="mt-2 text-gray-400">登入以獲得完整體驗</p>
            </div>

            <!-- 錯誤訊息顯示區域 -->
            <div id="error-message" class="bg-red-900/20 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg mb-6" style="display: none;">
            </div>

            <form id="loginForm" class="space-y-6">
                <!-- 電子郵件輸入框 -->
                <div>
                    <label for="email" class="block text-sm font-medium text-yellow-500 mb-1">
                        電子郵件
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required
                               class="w-full pl-10 pr-4 py-2 bg-[#242e38] border border-gray-700 text-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition duration-300"
                               placeholder="請輸入電子郵件">
                    </div>
                </div>

                <!-- 密碼輸入框 -->
                <div>
                    <label for="password" class="block text-sm font-medium text-yellow-500 mb-1">
                        密碼
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required
                               class="w-full pl-10 pr-4 py-2 bg-[#242e38] border border-gray-700 text-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition duration-300"
                               placeholder="請輸入密碼">
                    </div>
                </div>

                <!-- 記住我和忘記密碼 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                               class="h-4 w-4 bg-[#242e38] border-gray-700 rounded text-yellow-500 focus:ring-yellow-500 focus:ring-offset-0">
                        <label for="remember" class="ml-2 block text-sm text-gray-400">
                            記住我
                        </label>
                    </div>
                    <a href="#" class="text-sm text-yellow-500 hover:text-yellow-400 transition duration-300">
                        忘記密碼？
                    </a>
                </div>

                <!-- 登入按鈕 -->
                <button type="submit"
                        class="w-full bg-yellow-500 text-gray-900 py-2 px-4 rounded-lg hover:bg-yellow-400 transition duration-300 font-bold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    登入
                </button>

                <!-- 分隔線 -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-[#1a242c] text-gray-400">或者</span>
                    </div>
                </div>

                <!-- 社交登入按鈕 -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button"
                            class="w-full bg-[#242e38] text-gray-300 py-2 px-4 rounded-lg hover:bg-[#2a3642] transition duration-300 border border-gray-700 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                        </svg>
                        Discord
                    </button>
                    <button type="button"
                            class="w-full bg-[#242e38] text-gray-300 py-2 px-4 rounded-lg hover:bg-[#2a3642] transition duration-300 border border-gray-700 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        GitHub
                    </button>
                </div>

                <!-- 註冊提示 -->
                <div class="text-center mt-6">
                    <p class="text-gray-400">
                        還沒有帳號？
                        <a href="/pages/register.php" class="text-yellow-500 hover:text-yellow-400 transition duration-300 font-medium">
                            立即註冊
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-auth-compat.js"></script>

<script>
// 等待 DOM 完全載入
window.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('#loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // 禁用提交按鈕
            const submitButton = e.target.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
            }

            try {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                const userCredential = await firebase.auth().signInWithEmailAndPassword(email, password);
                await createSession(userCredential.user);

                // 顯示成功訊息
                showSuccess('登入成功！');
                
                // 延遲跳轉
                setTimeout(() => {
                    window.location.href = '/index.php';
                }, 1000);

            } catch (error) {
                console.error('登入錯誤:', error);
                showError(getErrorMessage(error.code));
                
                // 重新啟用提交按鈕
                if (submitButton) {
                    submitButton.disabled = false;
                }
            }
        });
    }
});


// 在 login.php 的 script 標籤中添加這個函數
function showSuccess(message) {
    // 使用 header.php 中定義的 showGlobalToast 函數
    if (typeof showGlobalToast === 'function') {
        showGlobalToast(message, 'success');
    }

    // 同時也更新錯誤訊息區域為成功樣式
    const successDiv = document.getElementById('error-message');
    if (successDiv) {
        successDiv.style.backgroundColor = 'rgba(22, 101, 52, 0.2)';  // 深綠色背景
        successDiv.style.borderColor = 'rgba(34, 197, 94, 0.2)';      // 綠色邊框
        successDiv.style.color = '#4ade80';                           // 綠色文字
        successDiv.textContent = message;
        successDiv.style.display = 'block';
    }
}

// Discord 登入
async function signInWithDiscord() {
    const provider = new firebase.auth.OAuthProvider('discord.com');
    try {
        const result = await firebase.auth().signInWithPopup(provider);
        await createSession(result.user);
        window.location.href = '/index.php';
    } catch (error) {
        showError(getErrorMessage(error.code));
    }
}

// GitHub 登入
async function signInWithGithub() {
    const provider = new firebase.auth.GithubAuthProvider();
    try {
        const result = await firebase.auth().signInWithPopup(provider);
        await createSession(result.user);
        window.location.href = '/index.php';
    } catch (error) {
        showError(getErrorMessage(error.code));
    }
}

// 創建 session
async function createSession(user) {
    try {
        const response = await fetch('/api/create_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                uid: user.uid,
                email: user.email,
                displayName: user.displayName,
                photoURL: user.photoURL
            })
        });
        
        if (!response.ok) {
            throw new Error('Session 創建失敗');
        }
        
        return response.json();
    } catch (error) {
        console.error('Session 創建錯誤:', error);
        throw error;
    }
}

// 顯示錯誤訊息
function showError(message) {
    const errorDiv = document.getElementById('error-message');
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
}

// 錯誤訊息轉換
function getErrorMessage(errorCode) {
    switch (errorCode) {
        case 'auth/invalid-email':
            return '無效的電子郵件格式';
        case 'auth/user-disabled':
            return '此帳號已被停用';
        case 'auth/user-not-found':
            return '找不到此用戶';
        case 'auth/wrong-password':
            return '密碼錯誤';
        default:
            return '登入失敗，請稍後再試';
    }
}


</script>




