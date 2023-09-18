const stsButton = document.querySelectorAll('.btn__seemore')
const stsResume = document.querySelectorAll('.sts__resume')
const clsBtn = document.querySelectorAll('.sts__modal__close')

let openResumeId = null; // Variable para almacenar el id del componente abierto

stsButton.forEach(listen => {
    listen.addEventListener('click', ({target: {dataset: {id}}}) => {
        showContent(id);
        openResumeId = id; // Actualiza el id del componente abierto
    })
})

const showContent = (idContent) => {
    stsResume.forEach(resume => {
        if (resume.dataset.id === idContent) {
            resume.style.display = 'block';
        }
    })
}

clsBtn.forEach(close => {
    close.addEventListener('click', ({target: {dataset: {id}}}) => {
        closeResume(id);
        openResumeId = null; // No hay ningún componente abierto después de cerrar
    })
})

const closeResume = (idClose) => {
    stsResume.forEach(resume => {
        if(resume.dataset.id === idClose){
            resume.style.display = 'none'
        }
    })
}

document.addEventListener('keydown', (event) => {
    if(event.key === "Escape" && openResumeId !== null) {
        closeResume(openResumeId);
        openResumeId = null; // No hay ningún componente abierto después de cerrar
    }
})
