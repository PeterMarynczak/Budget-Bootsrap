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
            container: container,
            todayHighlight: true,
            orientation: "left top",
        })
    })
    
    $('.input-daterange input').each(function() {
    $(this).datepicker('clearDates');
});

/*pie chart------------------------------*/
var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                '#FF0000',
                '#2E2EFE',
                '#F7FE2E',
                '#00FF00',
                '#9A2EFE',
                '#FE9A2E'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
        }
    }
});