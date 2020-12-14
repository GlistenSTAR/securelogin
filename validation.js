function checkForm(form)
        {
          re = /^\w+$/;
          if(!re.test(form.txtUsername.value)) {
            alert("Error: CustomerName must contain only letters, numbers and underscores!");
            form.txtUsername.focus();
            return false;
          }
      
          if(form.Password.value != "" && form.Password.value == form.rePassword.value) {
            if(form.Password.value.length < 6) {
              alert("Error: Password must contain at least six characters!");
              form.Password.focus();
              return false;
            }
            if(form.Password.value == form.txtUsername.value) {
              alert("Error: Password must be different from CustomName!");
              form.Password.focus();
              return false;
            }
            re = /[0-9]/;
            if(!re.test(form.Password.value)) {
              alert("Error: password must contain at least one number (0-9)!");
              form.Password.focus();
              return false;
            }
            re = /[a-z]/;
            if(!re.test(form.Password.value)) {
              alert("Error: password must contain at least one lowercase letter (a-z)!");
              form.Password.focus();
              return false;
            }
            re = /[A-Z]/;
            if(!re.test(form.Password.value)) {
              alert("Error: password must contain at least one uppercase letter (A-Z)!");
              form.Password.focus();
              return false;
            }
            re = /[!@#$%^&*_=+-]/;
            if(!re.test(form.Password.value)) {
              alert("Error: password must contain at least one special letter (!@#$%^&*_=+-)!");
              form.Password.focus();
              return false;
            }
          } else {
            alert("Error: Please check that you've entered and confirmed your password!");
            form.Password.focus();
            return false;
          }
          $("form").attr("action","register.php");
          $("form").submit();
          return true;
        }