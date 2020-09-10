class col{
    constructor(col: any) {
        this.each = (callback) => {
            col.forEach((element, i) => {
                const boundFn = callback.bind(element);
                boundFn(element, i);
            });
            return col;
        };
        // @ts-ignore
        this.on = (eventName, handler) => {
            col.forEach((element) => {
                element.addEventListener(eventName, handler);
            });
        };
        this.click = (clickFn) => {
            col.forEach((element) => {
                element.addEventListener('click', clickFn);
            })
        }
        this.submit = (submitFn) => {
            col.forEach((element) => {
                element.addEventListener('submit', submitFn);
            })
        }
        this.hide = () => {
            col.forEach((element) => {
                element.style.display = 'none';
            })
        }
        this.show = () => {
            col.forEach((element) => {
                element.style.display = '';
            })
        }
        this.addClass = (className) => {
            col.forEach((element) => {
                element.classList.add(className);
            })
        }
        this.removeClass = (className) => {
            col.forEach((element) => {
                element.classList.remove(className);
            })
        }
        this.attr = (attr, value) => {
            col.forEach((element) => {
                if(value === null){
                    return element.getAttribute(attr)
                }else{
                    element.setAttribute(attr, value);
                }
            })
        }
        col.val = (arg) => {
            const element = col[0];
            if (typeof arg === 'string'){
                element.value = arg;
            }else{
                return element.value;
            }
        }
        col.html = (arg) => {
            col.forEach((element) => {
                element.innerHTML = arg;
            })
        }
        col.css = (...cssArgs) => {
            if (typeof cssArgs[0] === 'string'){
                const [property, value] = cssArgs;
                col.forEach((element)=>{
                    element.style[property] = value;
                })
            }else if (typeof cssArgs[0] === 'object'){
                const cssProps = Object.entries(cssArgs[0]);
                col.forEach((element)=>{
                    cssProps.forEach(([property, value]) =>{
                        // @ts-ignore
                        element.style[property] = value;
                    })
                })
            }
        };
    }
}
// @ts-ignore
const $ = (...args) => {
    if (typeof args[0] === 'function') {
        // document ready listener
        const readyFn = args[0];
        console.log("Document loaded")
        document.addEventListener('DOMContentLoaded', readyFn);
    }else if (typeof args[0] === 'string'){
        //select an element!
        const selector = args[0];
        const collection = new col(document.querySelectorAll(selector));
        //DecorateCollection(collection);
        return collection;
    }else if (args[0] instanceof HTMLElement){
        // The given element is a HTML object so we neeed to select it
        //const collection = [args[0]];
        const collection = new col([args[0]]);
        //DecorateCollection(collection);
        return collection;
    }
};
