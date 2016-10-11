var Totaler = Class.create({
  initialize: function(element, totalElement, options) {
    this.element = $(element);
    this.totalElement = $(totalElement);    
    this.options = Object.extend({
      selector: ".number"
    }, options || {});
    this.updateTotal();
  },  
  
  updateTotal: function() {
    var numberElements = this.element.select(this.options.selector);
    var total = numberElements.inject(0, function(memo, el) {
      return memo + Number(el.innerHTML);
    });
    this.totalElement.update(total);
  }  
});
