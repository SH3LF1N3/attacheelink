$('#submitStudentsBtn').click(function (e) {
    e.preventDefault();

    let students = [];

    $('.student-form').each(function () {
        const name = $(this).find('.name').val();
        const email = $(this).find('.email').val();
        const phone = $(this).find('.phone').val();

        students.push({ name, email, phone });
    });

    $.ajax({
        url: "{{ route('students.ajax.store') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            students: students
        },
        success: function (response) {
            $('#responseMessage').html('<p style="color:green;">' + response.message + '</p>');
            $('#studentsWrapper').html($('.student-form').first()); // Reset to one
        },
        error: function (xhr) {
            const errors = xhr.responseJSON.errors;
            let errorHtml = '<ul style="color:red;">';
            $.each(errors, function (key, value) {
                errorHtml += '<li>' + value[0] + '</li>';
            });
            errorHtml += '</ul>';
            $('#responseMessage').html(errorHtml);
        }
    });
});