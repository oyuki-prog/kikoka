$(function(){
  var DoSum = function(self){
    var GROUP = self.data('group');
    var SUM = 0;
    var REWARD =  Number($('#reward').text());

    $("[data-group='"+ GROUP +"']").each(function(index){
          SUM = SUM + Number($(this).val());
    });

    $("#Sum" + GROUP).text(REWARD - SUM);
  };

  $('[data-group]').change(function(){
      DoSum($(this));
  });
});

$(function(){
  $('#reward_coin').change(function() {
      var val = $(this).val();
      var multiply = 1.1
      if ($('#urgent').prop("checked") == true) {
        multiply = 1.2
      }
      $('#Total').text(val * multiply);
  })
});

$(function(){
  $('#urgent').change(function() {
      var val = $('#reward_coin').val();
      var multiply = 1.1
      if ($('#urgent').prop("checked") == true) {
        multiply = 1.2
      }
      $('#Total').text(val * multiply);
  })
});
