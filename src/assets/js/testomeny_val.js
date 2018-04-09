/*Function to validate password change form*/
function changePasswordFormValidate(){
  $.validator.addMethod("strongPassword",function(value,element){
          return /\d/.test(value)
          && /[a-z]/i.test(value);
        },"Your password must contains at least one number and one character");

    $.validator.setDefaults({
          highlight: function(element){
            $(element).closest('input-field').addClass('field-custom-error');
          },
          unhighlight:function(element){
            $(element)
            .closest('input-field')
            .removeClass('field-custom-error');
          },
          errorPlacement:function(error, element){
            error.insertAfter(element.parent().parent());
          }
        });

  $('#changePasswordForm').validate({
      rules:{
        current_password:{
          required:true,
          minlength:8,
          strongPassword:true
        },
        password1:{
          required:true,
          minlength:8,
          strongPassword:true
        },
        password2:{
          required:true,
          equalTo:"#password1"
        }
      },
      messages:{
        current_password:{
              required:'Please enter password',
              minlength:'Password must contains at lease 8 characters'
            },
          password1:{
            required:'Please enter password',
              minlength:'Password must contains at lease 8 characters'
          },
          password2:{
            required:'Please enter password',
            equalTo:'Password not matched'
          }
      }
  });
}

//This is for validating password_forgot-form
function passwordForgotFormValidate(){     
        $.validator.setDefaults({
          highlight: function(element){
            $(element).closest('input-field').addClass('field-custom-error');
          },
          unhighlight:function(element){
            $(element)
            .closest('input-field')
            .removeClass('field-custom-error');
          },
          errorPlacement:function(error, element){
            error.insertAfter(element.parent());
          }
        });

        $('#forgot_password_form').validate({
          rules:{
            recoveryemail:{
              required:true,
              email:true
            }
          },
          messages:{  
            recoveryemail:{
              required:"Please enter a email id",
              email:"Email address is not valid"
            }
          }
        });
}

//THis is for validating login form
function loginFormValidate(){

        $.validator.addMethod("strongPassword",function(value,element){
          return /\d/.test(value)
          && /[a-z]/i.test(value);
        },"Your password must contains at least one number and one character");
        
        $.validator.addMethod("usernameFormate",function(value,element){
            return value.length>=6
            && /[a-zA-Z][a-zA-Z0-9]+/.test(value)
        },"Username must start with letters");

        $.validator.setDefaults({
          highlight: function(element){
            $(element).closest('input-field').addClass('field-custom-error');
          },
          unhighlight:function(element){
            $(element)
            .closest('input-field')
            .removeClass('field-custom-error');
          },
          errorPlacement:function(error, element){
            error.insertAfter(element.parent());
          }
        });

        $('#login_form').validate({
          rules:{
            username:{
              required:true,
              minlength:6
            },
            password:{
              required:true,
              minlength:8,
              strongPassword:true
            }
          },
          messages:{  
            username:{
              required:"Please enter a username",
              minlength:"Username must contains at least 6 characters"
            },
            password:{
              required:'Please enter password',
              minlength:'Password must contains at lease 8 characters'
            }
          }
        });
}

//This is for validating registration form
function RegisterFormValidate(){
        
        $.validator.setDefaults({
          highlight: function(element){
            $(element).closest('input-field').addClass('field-custom-error');
          },
          unhighlight:function(element){
            $(element)
            .closest('input-field')
            .removeClass('field-custom-error');
          },
          errorPlacement:function(error, element){
            error.insertAfter(element.parent());
          }
        });


        $('#register_form').validate({
          rules:{
            firstname:{
              required:true,
              minlength:2,
              lettersonly:true
            },
            middlename:{
              required:true,
              minlength:2,
              lettersonly:true
            },
            lastname:{
              required:true,
              minlength:2,
              lettersonly:true
            },
            email:{
              required:true,
              email:true
            }
          },
          messages:{  
            firstname:{
              required:"Please enter firstname",
              minlength:"firstname must contains at least 2 characters.",
              lettersonly:"firstname must contains letters only."
            },
            middlename:{
              required:"Please enter middlename",
              minlength:"middlename must contains at least 2 characters.",
              lettersonly:"middlename must contains letters only."
            },
            lastname:{
              required:"Please enter lastname",
              minlength:"lastname must contains at least 2 characters.",
              lettersonly:"lastname must contains letters only."
            },
            email:{
              required:"Please enter a email ID.",
              email:"Email address is not <em>valid</em>."
            }
          }
        });
}


