import Toastify from 'toastify-js'


export const toast = (className,message,duration = 5000) =>{
    Toastify({
        text: message,
        className:className,
        position:"center",
        gravity:'top',
        duration:duration,
        close:true
    }).showToast()
}
