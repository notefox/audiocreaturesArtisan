/**
 * Puts the wrapper around the given already existing element
 *
 * @param element { HTMLElement }
 * @param wrapper { HTMLElement }
 * @return { Node } the original element, now in a wrapper
 */
function moveElementIntoWrapper(element, wrapper) {
    let clonedElement = element.cloneNode(true)
    wrapper.appendChild(clonedElement)
    element.remove()

    return clonedElement
}

/**
 * jumps this many children into an HTMLElement structure
 *
 * @param element { HTMLElement | Node }
 * @param depth { number }
 * @param currentDepth { number }
 *
 * @return {*}
 */
function childDive(element, depth = 0, currentDepth = 0) {
    return depth <= currentDepth
        ? element
        : childDive(element.children[0]
            ?? element, depth, currentDepth + 1)
}

/**
 * a general `is defined` function
 *
 * @param variable
 * @return { boolean }
 */
function isDefined(variable) {
    return typeof variable !== 'undefined';
}

/**
 * gives back the next best outer element with a specific class name
 *
 * @param current { HTMLElement | Node }
 * @param className { string }
 * @return { HTMLElement | Node }
 */
function getNextOuterClass(current, className) {
    const currentContainsClass = current.classList.contains(className)

    return currentContainsClass
        ? current
        : getNextOuterClass(current.parentNode, className)
}

/**
 * gives back the next best inner element with a class name
 *
 * @param current {HTMLElement | Node}
 * @param className { string }
 * @return {HTMLElement | Node}
 */
function getNextInnerClass(current, className) {
    const currentContainsClass = current.classList.contains(className)

    if(currentContainsClass) {
        return current
    }

    const nextInnerClass = current.children.toConnectedArray().map((element) => {
        return getNextInnerClass(element, className)
    })

    return nextInnerClass?.first()
}

/**
 * goes up and down the HTML Document structure searching for an element with a specific class name
 *
 * @param current {HTMLElement | Node}
 * @param className { string }
 * @return { HTMLElement | Node }
 */
function getNearestClass(current, className) {
    const currentContainsClass = current.classList.contains(className)

    if(currentContainsClass) {
        return current
    }

    const nextInnerClass = getNextInnerClass(current, className)

    if(!nextInnerClass) {
        const parent = current.parentNode

        return getNearestClass(parent, className)
    } else {
        return nextInnerClass
    }
}

/**
 * shorthand call for checking if an element contains an image
 *
 * @param elementBase
 * @return {*}
 */
function elementContainsImg(elementBase) {
    return elementBase.getElementsByTagName("img")
}

/**
 * gives back the next image by moving up the html document structure
 *
 * @param elementBase { HTMLElement | Node }
 * @return { HTMLElement | Node }
 */
function findNextOuterImage(elementBase) {
    const children = elementBase.children

    for (const child of children) {
        const images = elementContainsImg(child)

        if (images.length > 0) {
            return images[0]
        }
    }

    const parent = elementBase.parentNode

    return findNextOuterImage(parent)
}

/**
 * takes a collection of any size and forcibly chunks them into wanted sizes
 * the last chunk might not have the full size
 *
 * @param collection { collection }
 * @param chunkSize { number }
 * @return {*[][]}
 */
function chunkCollection(collection, chunkSize) {
    const chunks = [[]]

    for (let i = 0; i < collection.length; i++) {
        try {
            chunks[Math.floor(i / chunkSize)].push(collection.item(i))
        } catch (e) {
            chunks[Math.floor(i / chunkSize)] = []
            chunks[Math.floor(i / chunkSize)].push(collection.item(i))
        }
    }

    return chunks
}

/**
 * function to generate a usable array out of an HTMLCollection (then can be used with filter, map, forEach and similar)
 *
 * @return {*[]}
 */
HTMLCollection.prototype.toConnectedArray = function () {
    const connectedArray = []
    for (const block of this) {
        connectedArray.push(block)
    }
    return connectedArray
}

Array.prototype.last = function () {
    return this[this.length - 1]
}

Array.prototype.first = function () {
    return this[0] ?? null
}

Array.prototype.removeUndefined = function () {
    return this.filter(isDefined)
}

/**
 * runs through with an inverted filter function
 *
 * @param callback
 * @return {*[]}
 */
Array.prototype.filterNot = function (callback) {
    return this.filter((element) => !callback(element))
}

/**
 * appends an element before this (acts on parent HTML document structure)
 *
 * @param element {HTMLElement | Node}
 * @param parentNode { HTMLElement | Node }
 */
Element.prototype.appendBefore = function (element, parentNode = null) {
    element.parentNode.insertBefore(this, element);
};
