document.addEventListener("DOMContentLoaded", function () {
    const gallery = document.querySelector(".wp-block-gallery");
    if (gallery) {
        // 添加滚动检测
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        observer.observe(gallery);

        lightGallery(gallery, {
            selector: "figure",           // 每张图片
            mode: "lg-fade",              // 淡入淡出动画
            thumbnail: true,              // 显示缩略图导航
            download: false,              // 关闭下载按钮
            zoom: true,                   // 支持缩放
            actualSize: false,            // 关闭原始大小按钮
            slideShowAutoplay: true,      // 自动播放
            slideShowInterval: 3000,      // 每张显示 3 秒
            fullScreen: true,             // 启用全屏模式
            rotate: true,                 // 启用旋转功能
            share: true,                  // 启用分享功能
            video: true,                  // 启用视频支持
            plugins: [
                lgThumbnail,
                lgFullscreen,
                lgRotate,
                lgShare,
                lgVideo
            ],
            // 全屏设置
            fullScreen: {
                fullScreen: true,
                showThumbnails: true,
                thumbWidth: 100,
                thumbHeight: '80px',
                thumbMargin: 5
            },
            // 视频设置
            video: {
                autoplay: false,
                controls: true,
                youtubePlayerParams: {
                    modestbranding: 1,
                    showinfo: 0,
                    rel: 0
                }
            }
        });
    }
});
