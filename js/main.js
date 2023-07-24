var nav = document.querySelector('.top-nav');
var mask = document.querySelector('.mask');
var btnBurger = document.querySelector('.burger-button');

btnBurger.addEventListener('click', function() {
    nav.toggleAttribute('opened');
    mask.toggleAttribute('opened');
    clickOut();
});

function clickOut() {
    window.addEventListener('click', function(e) {
        if (!nav.contains(e.target.parentNode) && e.target != btnBurger) {
            nav.removeAttribute('opened');
            mask.removeAttribute('opened');
        }
    });
}