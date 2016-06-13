$(document).ready(function(){
  $( ".quit" ).click(function(){
    $(".user_edit").css("display", "none");
  });
  $( ".register_button.add_user" ).click(function(){
    $(".user_edit.add_user").css("display", "block");
    $(".user_edit.add_user").addClass("active");
  });
  $( ".register_button.add_livre" ).click(function(){
    $(".user_edit.add_livre").css("display", "block");
    $(".user_edit.add_livre").addClass("active");
  });
  $( ".register_button.add_auteur" ).click(function(){
    $(".user_edit.add_auteur").css("display", "block");
    $(".user_edit.add_auteur").addClass("active");
  });
  $( ".register_button.add_editeur" ).click(function(){
    $(".user_edit.add_editeur").css("display", "block");
    $(".user_edit.add_editeur").addClass("active");
  });
});
