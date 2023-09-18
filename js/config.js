const stsButton = document.querySelectorAll('.btn__seemore')
const stsResume = document.querySelectorAll('.sts__resume')

let buttonClick = ""

stsButton.forEach(listen => {
    listen.addEventListener('click',  ({target:{dataset: {id}}})=> {
        showContent(id)
    })
})

const showContent = (idContent) => {
    stsResume.forEach(resume => {
        if (resume.dataset.id === idContent) {
            resume.style.display = 'block'; // Cambiar a 'block' para mostrar
        }
    })
}