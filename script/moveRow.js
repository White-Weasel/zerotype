function detach(element) {
    return element.parentElement.removeChild(element);
  }
  
  function move(src, dest, isBefore) {
    dest.insertAdjacentElement(isBefore ? 'beforebegin' : 'afterend', detach(src));
  }
  
  function children(element, selector) {
    return element.querySelectorAll(selector);
  }
  
  function child(element, selector, index) {
    return children(element, selector)[index];
  }
  
  function row(table, index) {
    // Generic Version: return child(table.querySelector('tbody'), 'tr', index);
    return table.querySelector('tbody').querySelector(`tr:nth-child(${index + 1})`);
  }
  
  function moveRow(table, fromIndex, toIndex, isBefore) {
    move(row(table, fromIndex), row(table, toIndex), isBefore);
  }
  
  // Move "Eve" (index = 2) to be before "Jack" (index = 0)
  //moveRow(document.querySelector('table'), 2, 0, true);