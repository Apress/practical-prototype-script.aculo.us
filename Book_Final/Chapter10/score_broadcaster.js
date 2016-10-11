var ScoreBroadcaster = {
  setup: function() {
    // make an Ajax call every 30 seconds
    this.executer = new PeriodicalExecuter(this.update.bind(this), 30);
    this.update();
  },
  
  update: function() {
    this.request = new Ajax.Request("scores.php", {
      onSuccess: this.success.bind(this)
    });
  },
  success: function(request) {
    document.fire("score:updated", request.responseJSON);
  }
};

document.observe("dom:loaded", function() { ScoreBroadcaster.setup(); });