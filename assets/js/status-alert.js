//Capture element from DOM HTML with alert class.
const alertElement = document.querySelector('.alert') 

if(alertElement) {
    // setTimeout build in function, in 3 seconds to close the pop up
    setTimeout(() => {
        alertElement.classList.add('d-none')
    },5000)
}