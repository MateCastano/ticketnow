document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.carousel-container');
    const items = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;

    function showItem(index) {
        items.forEach(item => item.style.transform = `translateX(-${index * 100}%)`);
    }

    function nextItem() {
        currentIndex = (currentIndex + 1) % items.length;
        showItem(currentIndex);
    }

    function prevItem() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showItem(currentIndex);
    }

    document.querySelector('.next-button').addEventListener('click', nextItem);
    document.querySelector('.prev-button').addEventListener('click', prevItem);
});
