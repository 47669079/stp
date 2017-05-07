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
                      alert("error");
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
      alert(historia);

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
                        alert("error");
                        $("#mens").removeClass();
                        $("#mens").addClass(dat.class);
                        $("#mens").html(dat.msg);
                      }

                   }

               });

        return false;



    });

    $("#edit-btn").on('click',function(){

        var nameuser = $('#usersname').val();
        var email =  $('#email').val();
        var oldp =  $.md5($('#password1').val());
        var newp1 =  $.md5($('#password2').val());
        var newp2 =  $.md5($('#password3').val());

                 $.ajax({
                     type: 'post',
                     url: '/stp/users/edit',
                     data: {nameuser:nameuser, email:email, oldp:oldp, newp1:newp1, newp2:newp2},
                     success: function(data) {

                      dat=JSON.parse(data);

                        if(dat.msg == "Correct")
                        {
                          window.location.href = dat.redir;
                        }

                        else{
                          alert("error");
                          $("#mens").removeClass();
                          $("#mens").addClass(dat.class);
                          $("#mens").html(dat.msg);
                        }

                     }

                 });

          return false;



      });

      $("#tag_button").on('click',function(){

          var nameuser = $('#usersname').val();
          var email =  $('#email').val();
          var oldp =  $.md5($('#password1').val());
          var newp1 =  $.md5($('#password2').val());
          var newp2 =  $.md5($('#password3').val());

                   $.ajax({
                       type: 'post',
                       url: '/stp/users/edit',
                       data: {nameuser:nameuser, email:email, oldp:oldp, newp1:newp1, newp2:newp2},
                       success: function(data) {

                        dat=JSON.parse(data);

                          if(dat.msg == "Correct")
                          {
                            window.location.href = dat.redir;
                          }

                          else{
                            alert("error");
                            $("#mens").removeClass();
                            $("#mens").addClass(dat.class);
                            $("#mens").html(dat.msg);
                          }

                       }

                   });

            return false;



        });

  });
