# Bable - 宅文化社群平台

## 系統架構與邏輯

### 認證流程
1. 用戶註冊 (register.php)
   - 表單驗證
   - Firebase Authentication 創建帳戶
   - 更新用戶資料（displayName）
   - 註冊成功後導向登入頁面

2. 用戶登入 (login.php)
   - 支援電子郵件/密碼登入
   - Firebase Authentication 驗證
   - 創建 PHP Session
   - 儲存用戶資訊到 Session
   - 登入成功後導向首頁

3. Session 管理
   - create_session.php 處理 Session 創建
   - 儲存用戶 UID、郵件、顯示名稱、頭像
   - 設置登入狀態標記

4. 登出機制 (logout.php)
   - 清除 Session 數據
   - 刪除 Session Cookie
   - 銷毀 Session
   - 重定向到首頁

### 前端架構
1. 頁面組件
   - Header（全局導航）
   - 響應式選單系統
   - 全局提示訊息
   - 用戶狀態管理

2. 互動邏輯
   - Alpine.js 處理動態 UI
   - 下拉選單控制
   - 手機版選單動畫
   - 表單驗證與提交

3. 安全機制
   - CSRF 防護
   - 輸入驗證
   - Session 安全性
   - 錯誤處理

### 後端整合
1. Firebase 服務
   - Authentication 身份驗證
   - Firestore 數據存儲
   - Storage 檔案存儲
   - Admin SDK 後端管理

2. API 端點
   - /api/create_session.php
   - /api/logout.php
   - 其他功能端點準備中

### 數據流向
1. 用戶註冊流程   ```
   用戶輸入 -> 前端驗證 -> Firebase Auth -> 更新用戶資料 -> 導向登入   ```

2. 登入流程   ```
   用戶驗證 -> Firebase Auth -> 創建 Session -> 保存用戶狀態 -> 導向首頁   ```

3. 狀態管理   ```
   Session 驗證 -> 讀取用戶資訊 -> 更新 UI 狀態 -> 權限控制   ```

## 目前進度

### 已完成功能
1. 用戶認證系統
   - 電子郵件註冊/登入
   - 社交媒體登入（Discord、GitHub）準備中
   - Session 管理與安全性
   - 登出功能
   - 全局提示系統

2. 用戶界面
   - 響應式設計（支援多裝置）
   - 現代化導航欄
   - 互動式下拉選單
   - 優化手機版選單
   - 深色模式支援

3. 整合服務
   - Firebase Authentication
   - Firebase Firestore
   - Firebase Admin SDK
   - Firebase Storage

### 使用技術
- 前端：
  - HTML5/CSS3
  - Tailwind CSS
  - JavaScript ES6+
  - Alpine.js
- 後端：
  - PHP 8.0+
  - Firebase SDK
- 數據庫：
  - Firebase Firestore

### 待開發功能
1. 社交媒體登入整合
   - Discord OAuth2.0
   - GitHub OAuth
   - Google 登入

2. 用戶功能
   - 個人資料頁面
   - 收藏系統
   - 用戶設置
   - 通知系統

3. 內容功能
   - 多層級討論區
   - 遊戲專區
   - 科技專區
   - 即時聊天室

4. 其他功能
   - 密碼重置
   - 雙重認證
   - 用戶權限管理

### 下一步計劃
1. 完善用戶認證系統
2. 開發個人資料頁面
3. 實現社交媒體登入
4. 建立討論區功能

## 安裝說明
1. 克隆專案   ```bash
   git clone https://github.com/yourusername/bable.git   ```
2. 安裝依賴   ```bash
   npm install   ```
3. 配置環境
   - 複製 `.env.example` 到 `.env`
   - 設定環境變數
4. 編譯資源   ```bash
   npm run build   ```
5. 配置 Firebase
   - 設定專案
   - 下載服務帳號金鑰
6. 啟動開發伺服器   ```bash
   php -S localhost:8000   ```

## 系統需求
- PHP >= 8.0
- Node.js >= 14
- npm >= 6
- Firebase 專案
- 適當的檔案權限設定