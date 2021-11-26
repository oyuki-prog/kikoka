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
