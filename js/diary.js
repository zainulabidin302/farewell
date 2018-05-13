function render_new_comments(el, comments) {
  
  var html = comments.map(function(comment) {
    console.log(comment);
    var _html = '';
    _html += '<li class="list-group-item">'
    _html += comment['comment'] 
    _html += '<span class="badge badge-primary badge-pill pull-right">'
    _html += comment['name'] 
    _html += '</span>'
    _html += '<i class="fas fa-heart" style="color: red;"></i><i class="far fa-heart"></i>'
    _html += '<i class="fas fa-thumbs-up" style="color: blue;"></i><i class="far fa-thumbs-up"></i>'
    _html += '</li>'
    return _html;
  });

  console.log(html) 
  $(el).html(html.join(''));
}


$(document).ready(function() {
  $('form').on('submit', function(event) {
    var _el = $(this).parents('div').children('ul.list-group')
    event.preventDefault();
    var id = $(this).serializeArray();
    id = id.find(function(val) { return val.name == 'to_user_id'; })
    id = id['value'];
    console.log(id);
    var data = $(this).serialize();
    console.log(data)
    $.get(API_URL + '?api_req=add_comment&' + data , function(data) {
      $.get(API_URL + '?api_req=get_comments_to_user_id&user_id=' + id , function(comments) {
  
        render_new_comments(_el, JSON.parse(comments))
      });      
    })

  })
 })
