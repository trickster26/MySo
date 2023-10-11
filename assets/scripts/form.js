$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
      var formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        phone :$("#phone").val() ,
        password : $('#password').val().trim(),
      };
  
      $.ajax({
        type: "POST",
        url: "public/process.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
        if (!data.success) {
            if (data.errors.name) {
              $("#name-group").addClass("has-error");
              $("#name-group").append(
                '<div class="help-block">' + data.errors.name + "</div>"
              );
            }
    
            if (data.errors.email) {
              $("#email-group").addClass("has-error");
              $("#email-group").append(
                '<div class="help-block">' + data.errors.email + "</div>"
              );
            }
    
            if (data.errors.superheroAlias) {
              $("#superhero-group").addClass("has-error");
              $("#superhero-group").append(
                '<div class="help-block">' + data.errors.superheroAlias + "</div>"
              );
            }
          } else {
            $("form").html(
              '<div class="alert alert-success">' + data.message + "</div>"
            );
          }
    
      });
  
      event.preventDefault();
    });
  });