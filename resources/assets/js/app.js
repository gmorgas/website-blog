
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
// sticky menu
$(document).ready(function() {
    var NavY = $('.navbar-menu').offset().top;

    var stickyNav = function(){
        var ScrollY = $(window).scrollTop();

        if (ScrollY > NavY) {
            $('.navbar-menu').addClass('sticky');
        } else {
            $('.navbar-menu').removeClass('sticky');
        }
    };

    stickyNav();

    $(window).scroll(function() {
        stickyNav();
    });

    var hamburger = document.querySelector(".hamburger");
    hamburger.addEventListener("click", function(){
        $('li').toggleClass('show-menu');
    });
});




