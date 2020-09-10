var col = /** @class */ (function () {
    function col(col) {
        this.each = function (callback) {
            col.forEach(function (element, i) {
                var boundFn = callback.bind(element);
                boundFn(element, i);
            });
            return col;
        };
        // @ts-ignore
        this.on = function (eventName, handler) {
            col.forEach(function (element) {
                element.addEventListener(eventName, handler);
            });
        };
        this.click = function (clickFn) {
            col.forEach(function (element) {
                element.addEventListener('click', clickFn);
            });
        };
        this.submit = function (submitFn) {
            col.forEach(function (element) {
                element.addEventListener('submit', submitFn);
            });
        };
        this.hide = function () {
            col.forEach(function (element) {
                element.style.display = 'none';
            });
        };
        this.show = function () {
            col.forEach(function (element) {
                element.style.display = '';
            });
        };
        this.addClass = function (className) {
            col.forEach(function (element) {
                element.classList.add(className);
            });
        };
        this.removeClass = function (className) {
            col.forEach(function (element) {
                element.classList.remove(className);
            });
        };
        this.attr = function (attr, value) {
            col.forEach(function (element) {
                if (value === null) {
                    return element.getAttribute(attr);
                }
                else {
                    element.setAttribute(attr, value);
                }
            });
        };
        col.val = function (arg) {
            var element = col[0];
            if (typeof arg === 'string') {
                element.value = arg;
            }
            else {
                return element.value;
            }
        };
        col.html = function (arg) {
            col.forEach(function (element) {
                element.innerHTML = arg;
            });
        };
        col.css = function () {
            var cssArgs = [];
            for (var _i = 0; _i < arguments.length; _i++) {
                cssArgs[_i] = arguments[_i];
            }
            if (typeof cssArgs[0] === 'string') {
                var property_1 = cssArgs[0], value_1 = cssArgs[1];
                col.forEach(function (element) {
                    element.style[property_1] = value_1;
                });
            }
            else if (typeof cssArgs[0] === 'object') {
                var cssProps_1 = Object.entries(cssArgs[0]);
                col.forEach(function (element) {
                    cssProps_1.forEach(function (_a) {
                        var property = _a[0], value = _a[1];
                        // @ts-ignore
                        element.style[property] = value;
                    });
                });
            }
        };
    }
    return col;
}());
// @ts-ignore
var $ = function () {
    var args = [];
    for (var _i = 0; _i < arguments.length; _i++) {
        args[_i] = arguments[_i];
    }
    if (typeof args[0] === 'function') {
        // document ready listener
        var readyFn = args[0];
        console.log("Document loaded");
        document.addEventListener('DOMContentLoaded', readyFn);
    }
    else if (typeof args[0] === 'string') {
        //select an element!
        var selector = args[0];
        var collection = new col(document.querySelectorAll(selector));
        //DecorateCollection(collection);
        return collection;
    }
    else if (args[0] instanceof HTMLElement) {
        // The given element is a HTML object so we neeed to select it
        //const collection = [args[0]];
        var collection = new col([args[0]]);
        //DecorateCollection(collection);
        return collection;
    }
};
