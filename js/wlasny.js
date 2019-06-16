 $('ul.navbar-nav li a').each((i, item) => {
          if ($(item).attr('data-page')) {
            $(item).on('click', (element) => {
                $('#mainContainer').load($(element.target).attr('data-page')+'.html');
    });
  }
});
    
/*------------------------------*/       
        $(document).ready(function(){
        var date_input=$('input[name="date"]'); // date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    
    $('.input-daterange input').each(function() {
    $(this).datepicker('clearDates');
});