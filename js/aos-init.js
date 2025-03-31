document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800, // 动画持续时间（毫秒）
        once: true,    // 动画是否只播放一次
        offset: 100,   // 触发动画的偏移量（像素）
        easing: 'ease-in-out', // 动画缓动函数
    });
}); 