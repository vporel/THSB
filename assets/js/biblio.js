
/**
 * Sélectionne un élément du document en utilisation un selecteur css
 * @param string $selector 
 * @return DOMElement
 */
function $(selector){
    return document.querySelector(selector);
}