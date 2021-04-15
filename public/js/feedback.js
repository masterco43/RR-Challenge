function changeCounter(){
    count = $('#commentInput').val().length;
    $('#count-input').html(count);
    if(count > 199)
        $('#counter').css('color','red');
    else
        $('#counter').css('color','#6c757d');
}

$('#resetbutton').click( function (){
    Swal.fire({
        title: 'Do you want to reset the fields?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Reset`,
        denyButtonText: `Don't reset`,
        }).then((result) => {

        if (result.isConfirmed) {
            fields = ['nameInput', "emailInput", "commentInput"];
            for(i = 0; i < 3; i++){
                $('#'+fields[i]).val('')
            }
            changeCounter();

            Swal.fire('Reset!', '', 'success')
        } else if (result.isDenied) {
            Swal.fire('Fields are not reset!', '', 'error')
        }
    })
});

$('#helpIcon').click( function (){
    Swal.fire('Info!', 'A quick way to send a comment or a question to a developer', 'question')
});