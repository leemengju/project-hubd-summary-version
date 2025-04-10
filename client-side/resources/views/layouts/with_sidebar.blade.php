@extends('layouts.app')

@section('content')
    <!-- 設定最小高度限制樣式和footer相關樣式 -->
    <style>
        /* 設定CSS變數，用於儲存header高度 */
        :root {
            --header-height: 125px;
        }

        /* 自定義類，可以通過Tailwind的斷點應用 */
        .min-height-custom {
            min-height: calc(100vh - var(--header-height, 125px));
        }
        
        .content-min-height {
            min-height: calc(100vh - var(--header-height, 125px) - 40px);
        }
        
        /* 側邊欄寬度相關類 */
        .sidebar-margin {
            margin-left: 64px;
        }
        
        .sidebar-content-width {
            width: calc(100% - 64px);
        }
        
        /* 極小屏幕的處理 */
        @media (max-width: 360px) {
            .xs-sidebar-margin {
                margin-left: 66px !important;
            }
            
            .xs-content-width {
                width: calc(100% - 66px) !important;
            }
        }
    </style>

    <section class="mt-[170px]">
        <x-breadcrumb :items="[
            ['name' => '首頁', 'url' => route('home')],
            ['name' => '會員中心', 'url' => route('user.user_profile')],
            ['name' => __($__env->yieldContent('breadcrumb_title', '個人檔案'))],
        ]" />
    </section>

    <div class="container mx-auto px-4 py-8 min-height-custom">
        <div class="flex flex-col md:flex-row">
            <!-- 側邊欄 -->
            @include('layouts.sidebar')
            
            <!-- 主要內容 - 使用自定義類 -->
            <div class="w-full md:ml-6 mt-6 md:mt-0 pr-4 overflow-x-hidden pb-5 sidebar-margin md:sidebar-margin-none content-min-height md:content-min-height-none">
                @yield('main_content')
            </div>
        </div>
    </div>

    <script>
        // 設定header高度變數供樣式表使用
        document.addEventListener('DOMContentLoaded', function() {
            const updateHeaderHeight = () => {
                const header = document.querySelector('header');
                if (header) {
                    const headerHeight = header.offsetHeight;
                    document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
                }
                
                // 在小屏幕上應用footer調整
                applyFooterStyles();
            };
            
            // 應用footer樣式
            const applyFooterStyles = () => {
                const footer = document.querySelector('footer');
                const isMobile = window.innerWidth < 800; // 與Tailwind md斷點一致
                
                if (footer && isMobile) {
                    footer.classList.add('sidebar-margin', 'sidebar-content-width');
                    footer.style.paddingLeft = '20px';
                } else if (footer) {
                    footer.classList.remove('sidebar-margin', 'sidebar-content-width');
                    footer.style.paddingLeft = '';
                }
            };
            
            // 初始化時設定header高度和footer樣式
            updateHeaderHeight();
            
            // 視窗大小變更時更新
            window.addEventListener('resize', updateHeaderHeight);
            
            // 確保在頁面加載完成和滾動時更新
            window.addEventListener('load', updateHeaderHeight);
            window.addEventListener('scroll', updateHeaderHeight);
        });
    </script>
@endsection 