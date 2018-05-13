var API_URL = 'http://192.168.10.25/FarewellDir/api.php';


$(document).ready(function() {
  $('#search').on('keyup', function() {
    var url = API_URL + '?api_req=get_users&q=' + $(this).val();

    $.get(url, function(response) {
      console.log(response);
    })


  })
})
