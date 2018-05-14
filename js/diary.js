var HEART = 1;
var LIKE = 2;

function render_new_comments(el, comments) {
  var html = Object.keys(comments).map(function(key) {
    var comment = comments[key];

    var _html = '';
    _html += '<li class="list-group-item">'
    _html += comment['comment'] 
    _html += '<span class="badge badge-primary badge-pill pull-right">'
    _html += comment['name'] 
    _html += '</span>'
    var hearts = []
    var like   = []
    if (comment.comments_votes != null) {
      hearts = comment.comments_votes.filter(function(vote) {
        return vote.vote_type == HEART ? true : false;
      })
  
      like = comment.comments_votes.filter(function(vote) {
        return vote.vote_type == LIKE ? true : false;
      })
    }

    // _html += hearts.length + ' <i class="fas fa-heart" style="color: red;"></i>'
    // _html += like.length + '<i class="fas fa-thumbs-up" style="color: blue;"></i>'

    // _html += '<i class="far fa-thumbs-up"></i>'
    // _html += '<i class="far fa-heart"></i>'
    
    _html += '</li>'
    return _html;
  });
  $(el).html(html.join(''));
}





$(document).ready(function() {
  
  $('form').each(function(id, x) {
    var _el = $(this).parents('div').children('ul.list-group')
    render_new_comments(_el, GLOBAL_COMMENTS_DATA_DIARY_PHP[id])
  })  

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
        console.log(comments);
        render_new_comments(_el, JSON.parse(comments))
      });      
    })

  })

  $('.add_user_vote').on('click', function() {
    var to_user_id = $(this).data('to-user-id')
    var by_user_id = $(this).data('by-user-id')
    var vote_type = $(this).data('type')
    var _el = $(this);
    var i;
    if (vote_type == HEART) {
      i = _el.siblings('i.heart-count');
    } else if (vote_type == LIKE) {
      i = _el.siblings('i.like-count');
    } else {
      throw Error('Vote type undefined');
    }

    $.get(API_URL + '?api_req=add_vote_user&vote_type='+vote_type+'&to_user_id='+to_user_id+'&by_user_id='+by_user_id, function(data) {
      var d = JSON.parse(data);
      console.log(d);

      if (d.new_level == 1) {
        _el.addClass('fas');
        _el.removeClass('far');
        i.html(parseInt(i.html()) + 1)
      } else {
        _el.addClass('far hello');
        _el.removeClass('fas');
        i.html(parseInt(i.html()) - 1)
      }
    })

  });

})
