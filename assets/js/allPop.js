$(function(){

    $('#filter').on('input',function(){
       var search= $('#filter').val();
       var url_page =  $('#hidden_url_page').val();
       var id=$('#hidden_id').val();
       $.ajax({
           method:'post',
           url:url_page,
           data: {
               'search':search,
               'id':id
           }
       })
           .done(function(response){
               console.log('success');
               $('#tableAjax').replaceWith(response);
                var count = $('#hidden_count').val();
                var url =  $('#hidden_url').val();
                $('.li-pagination').remove();
                var page = Math.ceil(count/30);
                for (var i=0; i<page; i++ )
               {
                    var elem = document.createElement('a');

                    nb=i+1;
                    var newurl = url.replace('/1','/'+nb);
                    elem.setAttribute("href",newurl);
                    elem.innerHTML='Page'+nb;
                    var li = document.createElement('li');
                    li.setAttribute('class','li-pagination');
                    li.appendChild(elem);
                    $('.pagination').append(li);
               }
               if (!search)
               {
                   console.log('empty');
                   /*$('li').remove();*/
               }
           })

           .fail(function(response){
               console.log('fail');
               console.log(response.responseText);
           })
    });



});
