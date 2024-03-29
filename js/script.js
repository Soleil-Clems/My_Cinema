
const carousels = document.querySelectorAll('.carousel');
const rightArrows = document.querySelectorAll('.fa-circle-chevron-right');
const leftArrows = document.querySelectorAll('.fa-circle-chevron-left');

let carouselIndexes = Array.from({ length: carousels.length }, () => 0);

rightArrows.forEach((rightArrow, index) => {
    rightArrow.addEventListener("click", () => {
        carouselIndexes[index]++;
        updateCarousel(index);
    });
});

leftArrows.forEach((leftArrow, index) => {
    leftArrow.addEventListener("click", () => {
        carouselIndexes[index]--;
        updateCarousel(index);
    });
});

function updateCarousel(index) {
    const carouselLength = carousels[index].childElementCount;
    let currentIndex = carouselIndexes[index] % carouselLength;
    console.log(carouselLength);
    
    if (currentIndex < 0) {
        currentIndex = carouselLength - 1;
    }

    const i = currentIndex * 330;
    carousels[index].style.transform = `translateX(-${i}px)`;
}