const DecorateCollection = collection => {// @ts-ignore
    collection.each = (callback) => {
        collection.forEach((element, i) => {
            const boundFn = callback.bind(element);
            boundFn(element, i);
        });
        return collection;
    };
    // @ts-ignore
    collection.on = (eventName, handler) => {
        collection.forEach((element) => {
            element.addEventListener(eventName, handler);
        });
    };
    collection.click = (clickFn) => {
        collection.forEach((element) => {
            element.addEventListener('click', clickFn);
        })
    }
    collection.submit = (submitFn) => {
        collection.forEach((element) => {
            element.addEventListener('submit', submitFn);
        })
    }
    collection.hide = () => {
        collection.forEach((element) => {
            element.style.display = 'none';
        })
    }
    collection.show = () => {
        collection.forEach((element) => {
            element.style.display = '';
        })
    }
    collection.addClass = (className) => {
        collection.forEach((element) => {
            element.classList.add(className);
        })
    }
    collection.removeClass = (className) => {
        collection.forEach((element) => {
            element.classList.remove(className);
        })
    }
    collection.attr = (attr, value) => {
        collection.forEach((element) => {
            element.setAttribute(attr, value);
        })
    }
    collection.val = () => {
        collection.forEach((element) => {
            return element.value;
        })
    }
    collection.css = (...cssArgs) => {
        if (typeof cssArgs[0] === 'string'){
            const [property, value] = cssArgs;
            collection.forEach((element)=>{
                element.style[property] = value;
            })
        }else if (typeof cssArgs[0] === 'object'){
            const cssProps = Object.entries(cssArgs[0]);
            collection.forEach((element)=>{
                cssProps.forEach(([property, value]) =>{
                    // @ts-ignore
                    element.style[property] = value;
                })
            })
        }
    };
}
const $ = (...args) => {
    if (typeof args[0] === 'function') {
        // document ready listener
        const readyFn = args[0];
        document.addEventListener('DOMContentLoaded', readyFn);
    }else if (typeof args[0] === 'string'){
        //select an element!
        const selector = args[0];
        const collection = document.querySelectorAll(selector);
        DecorateCollection(collection);
        return collection;
    }else if (args[0] instanceof HTMLElement){
        console.log("We have an element");
        const collection = [args[0]];
        DecorateCollection(collection);
        return collection;
    }
};
