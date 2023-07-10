const validation = new JustValidate("#updaterecord");


validation
  .addField("#name", [
      {
        rule: "required"
      }
  ])
  .addField("#email", [
      {
        rule: "required"
      },
      {
        rule: "email"
      },

      {
        validator: (value) => () =>{
          return fetch("update_email_validation.php?email=" +
            encodeURIComponent(value))
                .then(function(response) {
                  return response.json();
                })
                .then (function(json){
                  return json.available;
                });
        },
        errorMessage: "Email already taken"
      }
  ])
  .addField("#newpassword", [
      {
        rule: "required"
      },
      {
        rule: "password"
      }
  ])
  .addField("#confirmpassword",[
      {
        validator: (value, fields) => {
          return value === fields["#newpassword"].elem.value;
        },
        errorMessage: "Passwords must match"
      }
  ])
  .onSuccess((event) => {
    document.getElementById("updaterecord").submit();
  });
