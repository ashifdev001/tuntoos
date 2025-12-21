

$('.banner-slide').owlCarousel({

    loop: true,
    items: 1,

    margin: 0,

    nav: false,

    dots: false,

    autoplay: true,

    smartSpeed: 1000,

    autoplayHoverPause: true,

    navText: [

        "<i class='fa fa-chevron-left'></i>",

        "<i class='fa fa-chevron-right'></i>",

    ],

});

$('.client-slide').owlCarousel({

    loop: true,

    items: 6,

    margin: 20,

    nav: false,

    dots: false,

    autoplay: true,

    smartSpeed: 1000,

    autoplayHoverPause: true,

    navText: [

        "<i class='fa fa-chevron-left'></i>",

        "<i class='fa fa-chevron-right'></i>",

    ],

});
//Review Slide JS

$('.review-slide').owlCarousel({

    loop: true,

    items: 3,

    margin: 20,

    nav: false,

    dots: false,

    autoplay: true,

    smartSpeed: 1000,

    autoplayHoverPause: true,

    navText: [

        "<i class='fa fa-chevron-left'></i>",

        "<i class='fa fa-chevron-right'></i>",

    ],

});


const data = [
{ dateLabel: 'January 2017', title: 'Gathering Information' },
{ dateLabel: 'February 2017', title: 'Planning' },
{ dateLabel: 'March 2017', title: 'Design' },
{ dateLabel: 'April 2017', title: 'Content Writing and Assembly' },
{ dateLabel: 'May 2017', title: 'Coding' },
{ dateLabel: 'June 2017', title: 'Testing, Review & Launch' },
{ dateLabel: 'July 2017', title: 'Maintenance' }
];

new Vue({
el: '#app', 
data: {
steps: data,
},
mounted() {
var swiper = new Swiper('.swiper-container', {
//pagination: '.swiper-pagination',
slidesPerView: 3,
paginationClickable: true,
grabCursor: true,
paginationClickable: true,
nextButton: '.next-slide',
prevButton: '.prev-slide',
});    
}
})