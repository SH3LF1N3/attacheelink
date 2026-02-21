$(document).ready(function() {



    $('#registrationForm').on('submit', function(event) {
      event.preventDefault();

      usere.innerHTML = '';
      fnamee.innerHTML = '';
      emaile.innerHTML = '';
      phonee.innerHTML = '';
      gene.innerHTML = '';
      state.innerHTML = '';
      expee.innerHTML = '';
      skille.innerHTML = '';
      depte.innerHTML = '';
      typee.innerHTML = '';

      var username = $('#username').val();
      var fname = $('#fname').val();
      var depart = $('#dept').val();
      var gender = $('#gender').val();
      var status = $('#status').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var skill = $('#skill').val();
      var type = $('#type').val();
      var expe = $('#expe').val();


      var form = $(this);



      if (gender === null) {

        gene.innerHTML = 'Select Gender';
        return false;
      }


      if (status === null) {

        state.innerHTML = 'Select Status';
        return false;
      }

      if (skill == '') {

        skille.innerHTML = 'Skill Can Not Be Null';
        return false;
      }

      if (depart === null) {

        depte.innerHTML = 'Select Department';
        return false;
      }


      if (type === null) {

        typee.innerHTML = 'Select User Type';
        return false;
      }








      // AJAX request to check username against database
      $.ajax({
        url: "{{ route('check-username') }}",
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          username: username,
          phone: phone,
          email: email
        },
        success: function(response) {
          usere.innerHTML = '';
          fnamee.innerHTML = '';
          emaile.innerHTML = '';
          phonee.innerHTML = '';
          gene.innerHTML = '';
          state.innerHTML = '';
          expee.innerHTML = '';
          skille.innerHTML = '';
          depte.innerHTML = '';
          typee.innerHTML = '';

          if (response.exists) {

            usere.innerHTML = 'User Name already exists!!!';
          } else if (response.existp) {

            phonee.innerHTML = 'Phone already already exists!!!';
          } else if (response.existe) {

            emaile.innerHTML = 'Email already exists!!!';
          } else {
            form.unbind('submit').submit(); // allow form submission
          }
        }
      });
    });



  });