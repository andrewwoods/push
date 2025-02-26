import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {

    var timer = '';
    var counted = document.querySelectorAll('.countable');
        /*
         * The .countaable class is for character counters. Sometimes the user
         * needs to know how many characters they have left. It helps them to
         * edit their content to fit the available space.
         */
        counted.forEach(function (elem) {

            elem.addEventListener("input", function () {

                clearTimeout(timer);
                var pause = this;
                var limit = this.getAttribute("maxlength");
                var remainingChars = limit - this.value.length;
                if (remainingChars <= 0) {
                    this.value = this.value.substring(0, limit);
                }
                var screenOnlyElem = this.nextElementSibling;
                while (screenOnlyElem && screenOnlyElem.classList.contains('screen-only') === false) {
                    screenOnlyElem = screenOnlyElem.nextElementSibling;
                }

                if (screenOnlyElem) {
                    screenOnlyElem.textContent = remainingChars <= -1 ? 0 : remainingChars + ' character(s) remaining';
                }

                timer = setTimeout(function () {
                    var srOnlyElem = pause.nextElementSibling;
                    while (srOnlyElem && srOnlyElem.classList.contains('sr-only') === false) {
                        srOnlyElem = srOnlyElem.nextElementSibling;
                    }

                    if (srOnlyElem) {
                        srOnlyElem.textContent = remainingChars <= -1 ? 0 : remainingChars + ' character(s) remaining';
                    }
                }, 2000);
        });

        elem.dispatchEvent(new Event('input'));
    });
});
