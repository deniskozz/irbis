// Initialize the slider
$(document).ready(function () {
    $(".slider").slick({
        slidesToShow: 3, // Display 4 slides at a time
        slidesToScroll: 1, // Scroll 1 slide at a time
        autoplay: true, // Enable automatic scrolling
        autoplaySpeed: 3000, // Delay between slides (in milliseconds)
        responsive: [
            {
                breakpoint: 768, // Adjust the settings for screens smaller than 768px
                settings: {
                    slidesToShow: 2, // Display 2 slides at a time
                    slidesToScroll: 1, // Scroll 1 slide at a time
                },
            },
            {
                breakpoint: 576, // Adjust the settings for screens smaller than 576px
                settings: {
                    slidesToShow: 1, // Display 1 slide at a time
                    slidesToScroll: 1, // Scroll 1 slide at a time
                },
            },
        ],
    });
});
