const validarFechaFinal = () => {
    let fechaInici= document.getElementById('dinici').value
    let fechaFinal= document.getElementById('dfinal')
    fechaFinal.setAttribute("min", fechaInici)
}
const validarFechaIncial = () => {
    let fechaFinal= document.getElementById('dfinal').value
    let fechaInici= document.getElementById('dinici')
    fechaInici.setAttribute("max", fechaFinal)
}