/**
 * Created by Etudiant on 27/12/2016.
 */
$(function(){

    var url=$('#url').val();
    var link = document.createElement('a');

    link.innerHTML='modifier';
    var li;


    var oriVal;
    $(".list").on('dblclick', 'li', function () {
        oriVal = $(this).text();


        var input = document.createElement('input');
        input.setAttribute('value',oriVal);
        input.setAttribute('type','text');
        input.setAttribute('id','redo');

        if (!document.getElementById("redo"))
        {
            li = $(this);
            next=$('.link',this);

            console.log(li);

            li.html(input);

        }

    });
    $(".list").on('change', 'li > input', function () {
        var $this = $(this);
        $this.parent().text($this.val() || oriVal);
        var id=li.attr('data-id');
        var type = li.parent().parent().attr('id');
        var newS =   $this.val().replaceAll(' ','_');
        link.setAttribute('href',url+'Type/'+id+'/'+type+'/'+newS);
       /* console.log(next);*/
        li.append(link);

    });


    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };


})