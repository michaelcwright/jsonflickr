$(document).ready(function() {
    $.getJSON("http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=c155f7a5a7761cb2b5f1f5cc75c8c1a2&text=dandy&extras=url_m&format=json&jsoncallback=?", function(data)
    {
       $.each(data.photos.photo, function(i,item){
       $("<img/>").attr("src", item.url_m).appendTo("#images")
      .wrap("<a href='" + item.url_m + "'></a>");
    });
    $('#images').cycle({
        fx: 'fade',
        speed: 'fast',
        timeout: 0,
        next: '#next',
        prev: '#prev'
    });
    });
});?