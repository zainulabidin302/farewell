var API_URL = 'http://192.168.10.25/FarewellDir/api.php';
var IMAGE_URL = 'http://192.168.10.25/FarewellDir/images';

function result_template_generator(user) {

  var str = "<a href='diary.php?id=" + user.id + "' ><div class='result-row'>"
  str += "<div class='result-row-left'>"
  str += "<img src=" + IMAGE_URL +'/'+ user.image_url + " />";
  str += "</div>"
  str += "<div class='result-row-right'>"
  str += "<p>" + user.name + "</p>";
  str += "<p>" + user.email + "</p>";
  str += "</div> "
  str += "</div></a><div class='clearfix'></div>"
  return str;
}


$(document).ready(function() {
  $('#search').on('keyup', function() {
    var url = API_URL + '?api_req=get_users&q=' + $(this).val();

    $.get(url, function(data) {
      var res = JSON.parse(data);
      var str = "";
      for(var i = 0; i < res.length; i++) {
        str += result_template_generator(res[i]);
      }

      console.log(str);

      $("#result").html(
          str
      );
    })


  })
})
