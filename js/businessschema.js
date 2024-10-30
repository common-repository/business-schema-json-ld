document.addEventListener("DOMContentLoaded", function(event) {
  var sitenameDisable = document.getElementById("sitename-disable");
  var organizationDisable = document.getElementById("organization-disable");
  var productsDisable = document.getElementById("products-disable");
  
  if (sitenameDisable.checked)
    BusinessSchema.toggleDisable(sitenameDisable);

  if (organizationDisable.checked) 
    BusinessSchema.toggleDisable(organizationDisable);

  if (productsDisable.checked) 
    BusinessSchema.toggleDisable(productsDisable);

});

var BusinessSchema = {
  addSameAs: function(item) {
    var container = item.parentNode.parentNode;
    var clonedNode = item.parentNode.cloneNode(true);
    clonedNode.children[0].value = "";
    container.appendChild(clonedNode);
  },

  removeSameAs: function(item) {
    if (this._getNumbOfSameAs() > 1)
      item.parentNode.remove();
    
    return false;
  },

  removeContactPoint: function(item) {
    if (this._getNumbOfContactPoints() > 1)
      item.parentNode.remove();

    return false;
  },  

  addContactPoint: function(item) {
    var container = item.parentNode.parentNode;
    var clonedNode = item.parentNode.cloneNode(true);
    var results;
    var regex;
    var clonedNodeChildren = [].slice.call(clonedNode.children);
    var timestamp = Date.now();
    
    clonedNodeChildren.forEach(function(element) {
      if (element.tagName === "INPUT" || element.tagName === "SELECT") {
        regex = /bs_settings\[bs_organization_contactpoint]\[(\d+)]\[(\w+)]/g;
        results = regex.exec(element.name);
        
        element.name = 'bs_settings[bs_organization_contactpoint][' + timestamp + '][' + results[2] + ']';
      }
    });

    container.appendChild(clonedNode);

    return false;
  },


  toggleDisable: function(element) {

    var container = element.parentNode.parentNode.parentNode;
    var fields = container.querySelectorAll("button, select, input:not([type=checkbox]");

    if (element.checked) {
      fields.forEach(function(item) {
        item.disabled = true;
      });
    } else {
      fields.forEach(function(item) {
        item.disabled = false;
      });
    } 
  },

  _getNumbOfContactPoints: function() {
    return document.getElementsByClassName('bs-contact-point').length;
  },

  _getNumbOfSameAs: function() {
    return document.getElementsByClassName('bs-sameas').length;
  }

};