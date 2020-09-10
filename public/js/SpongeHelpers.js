var DecorateCollection = function (collection) {
    collection.each = function (callback) {
        collection.forEach(function (element, i) {
            var boundFn = callback.bind(element);
            boundFn(element, i);
        });
        return collection;
    };
    // @ts-ignore
    collection.on = function (eventName, handler) {
        collection.forEach(function (element) {
            element.addEventListener(eventName, handler);
        });
    };
    collection.click = function (clickFn) {
        collection.forEach(function (element) {
            element.addEventListener('click', clickFn);
        });
    };
    collection.submit = function (submitFn) {
        collection.forEach(function (element) {
            element.addEventListener('submit', submitFn);
        });
    };
    collection.hide = function () {
        collection.forEach(function (element) {
            element.style.display = 'none';
        });
    };
    collection.show = function () {
        collection.forEach(function (element) {
            element.style.display = '';
        });
    };
    collection.addClass = function (className) {
        collection.forEach(function (element) {
            element.classList.add(className);
        });
    };
    collection.removeClass = function (className) {
        collection.forEach(function (element) {
            element.classList.remove(className);
        });
    };
    collection.attr = function (attr, value) {
        collection.forEach(function (element) {
            element.setAttribute(attr, value);
        });
    };
    collection.val = function (arg) {
        var element = collection[0];
        if (typeof arg === 'string') {
            element.value = arg;
        }
        else {
            return element.value;
        }
    };
    collection.html = function (arg) {
        collection.forEach(function (element) {
            element.innerHTML = arg;
        });
    };
    collection.css = function () {
        var cssArgs = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            cssArgs[_i] = arguments[_i];
        }
        if (typeof cssArgs[0] === 'string') {
            var property_1 = cssArgs[0], value_1 = cssArgs[1];
            collection.forEach(function (element) {
                element.style[property_1] = value_1;
            });
        }
        else if (typeof cssArgs[0] === 'object') {
            var cssProps_1 = Object.entries(cssArgs[0]);
            collection.forEach(function (element) {
                cssProps_1.forEach(function (_a) {
                    var property = _a[0], value = _a[1];
                    // @ts-ignore
                    element.style[property] = value;
                });
            });
        }
    };
};
var $ = function () {
    var args = [];
    for (var _i = 0; _i < arguments.length; _i++) {
        args[_i] = arguments[_i];
    }
    if (typeof args[0] === 'function') {
        // document ready listener
        var readyFn = args[0];
        document.addEventListener('DOMContentLoaded', readyFn);
    }
    else if (typeof args[0] === 'string') {
        //select an element!
        var selector = args[0];
        var collection = document.querySelectorAll(selector);
        DecorateCollection(collection);
        return collection;
    }
    else if (args[0] instanceof HTMLElement) {
        console.log("We have an element");
        var collection = [args[0]];
        DecorateCollection(collection);
        return collection;
    }
};
