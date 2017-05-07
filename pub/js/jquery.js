$("document").ready(function(){

  var f_nav = 0;

    $(".form-log").on('submit',function(){

               var password = $.md5($('input:password[name=password]').val());
               var username = $('input:text[name=username]').val();

                $.ajax({
                    type: 'post',
                    url: '/stp/login/log',
                    data: {username:username, password:password},

                    success: function(data) {

                    dat=JSON.parse(data);

                        if(dat.msg == "Correct")
                        {
                           window.location.href = dat.redir;
                        }

                        else{
                            $("#mens").removeClass();
                            $("#mens").addClass(dat.class);
                            $("#mens").html(dat.msg);
                        }

                    }

                });

    return false;

});

  $(".form-signup").on('submit',function(){


    var password = $.md5($('input:password[name=password]').val());
    var username = $('input:text[name=username]').val();
    var email = $('input:text[name=email]').val();

    $.ajax({
        type: 'post',
        url: '/stp/signup/sign',
        data: {username:username, password:password, email:email},

        success: function(data) {

            dat=JSON.parse(data);

            if(dat.msg == "Correct")
            {
                window.location.href = dat.redir;
            }

            else{
                $("#mens").removeClass();
                $("#mens").addClass(dat.class);
                $("#mens").html(dat.msg);
            }

          }

          });

      return false;

  });

  $(".dropdown-toggle").on('click', function(){

    if(f_nav==0){
      $(".dropdown-menu").css('display','block');
      f_nav=1;
    }
    else{
      $(".dropdown-menu").css('display','none');
      f_nav=0;
    }

  });

$("#editor_save").on('click',function(){

    var titulo = $('input:text[name=titulo]').val();
    //var historia = $('textarea').val();
    var historia=tinyMCE.activeEditor.getContent();

             $.ajax({
                 type: 'post',
                 url: '/stp/editor/save',
                 data: {titulo:titulo, historia:historia},
                 success: function(data) {

                  dat=JSON.parse(data);

                    if(dat.msg == "Correct")
                    {
                      window.location.href = dat.redir;
                    }

                    else{

                      $("#mens").removeClass();
                      $("#mens").addClass(dat.class);
                      $("#mens").html(dat.msg);
                    }

                 }

             });

      return false;



  });

  $(".h_edit").on('click',function(){

      historia = $("#h_story").val();

  });

  $("#edit_hist").on('click',function(){

      var titulo = $('input:text[name=titulo]').val();
      var historia=tinyMCE.activeEditor.getContent();
      var user =  $('#iduser').val();
      var story =  $('#idstory').val();

               $.ajax({
                   type: 'post',
                   url: '/stp/story/editor',
                   data: {titulo:titulo, historia:historia, user:user, story:story},
                   success: function(data) {

                    dat=JSON.parse(data);

                      if(dat.msg == "Correct")
                      {
                        window.location.href = dat.redir;
                      }

                      else{

                        $("#mens").removeClass();
                        $("#mens").addClass(dat.class);
                        $("#mens").html(dat.msg);
                      }

                   }

               });

        return false;



    });

    $(".edit-btn").on('click',function(){

        var nameuser = $('#username').val();
        var userid = $('#userid').text();
        var email =  $('#email').val();
        var old_p =  $.md5($('#password1').val());
        var new_p_1 =  $.md5($('#password2').val());
        var new_p_2 =  $.md5($('#password3').val());


        $.ajax({
                     type: 'post',
                     url: '/stp/users/edit',
                     data: {nameuser:nameuser, userid:userid, email:email, old_p:old_p, new_p_1:new_p_1, new_p_2:new_p_2},
                     success: function(data) {

                      dat=JSON.parse(data);

                        if(dat.msg == "Correct")
                        {
                          window.location.href = dat.redir;
                        }

                        else{

                          $("#mens").removeClass();
                          $("#mens").addClass(dat.class);
                          $("#mens").html(dat.msg);
                        }

                     }

                 });

          return false;



      });


      $(".b_values").on('click',function(){

        var votar = prompt("Votar história (0.0-5.0 pts)","0");
        var id_user = $('#id_user').val();
        var id_story = $('#id_story').val();

        $.ajax({
                     type: 'post',
                     url: '/stp/story/votar',
                     data: {votar:votar, id_user:id_user, id_story,id_story},
                     success: function(data) {

                      dat=JSON.parse(data);

                        if(dat.msg == "Correct")
                        {
                          alert("¡Felicidades! Ya has votado");
                        }

                        else{
                          alert("Error al votar");
                        }

                     }

                 });

          return false;

      });


    $("#new_tag_button").on('click',function(){

              var tag = prompt("Nuevo tag","0");
              var id_user = $('#id_user').val();
              var id_story = $('#id_story').val();

              $.ajax({
                           type: 'post',
                           url: '/stp/story/tag',
                           data: {tag:tag, id_user:id_user, id_story,id_story},
                           success: function(data) {

                            dat=JSON.parse(data);

                              if(dat.msg == "Correct")
                              {
                                alert("¡Felicidades! Ya has insertado un tag");
                              }

                              else{
                                alert("Error al votar");
                              }

                           }

                       });

                return false;

        });

        tinymce.init({ selector:'#textarea' });
        story = $('#story').val();
        tinymce.activeEditor.setContent(story);
        title = $('#title').val();
        $('input:text[name=titulo]').val(title);

  });
