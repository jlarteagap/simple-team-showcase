const stsButton = document.querySelectorAll('.btn__seemore')

stsButton.forEach(listen => {
    let buttonClick = ""
    listen.addEventListener('click',  ({target:{dataset: {id}}})=> {
       buttonClick = id
       console.log(buttonClick)
    })


})
// const showContent =() => {
//     console.log(event.target.dataset.id)
//     console.log('Click')
//     const stsResume = document.querySelectorAll('.sts__resume')
//     stsResume.forEach(resume => {
//         console.log(resume)
//     })
// }