const navBarOverlapHandler = () => {
    const navbarId = 'navbar'
    const isNavbar = (element) => element.id === navbarId

    // get needed elements
    const navbar = document.getElementById('navbar')
    if(!navbar) {
        return
    }

    const contentContainer = document.getElementById('content-container')
    const firstElement = contentContainer.children.toConnectedArray().filterNot(isNavbar).removeUndefined().first()

    // check if overlapping is allowed
    const allowOverlap = (element) => element.dataset.navOverlap ? element.dataset.navOverlap === '1' : false

    if(allowOverlap(firstElement)) {
        return
    }

    // calculate needed padding to deny overlapping
    const bottomSide = navbar.clientHeight + navbar.offsetTop + navbar.clientTop
    const padding = 15

    // add padding
    const addNeededPaddingToFirstElement = () => firstElement.style.paddingTop = (bottomSide + padding) + 'px'

    addNeededPaddingToFirstElement()
    addEventListener('resize', addNeededPaddingToFirstElement)
}

addEventListener('DOMContentLoaded', navBarOverlapHandler)
