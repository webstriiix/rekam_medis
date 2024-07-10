$(document).ready(function(){
    // select_all all checked
    $('#select_all').on('click', function() {
        if(this.checked){
            $('.check').each(function() {
                this.checked = true;
            })
        } else {
            $('.check').each(function() {
                this.checked = false;
            })
        }
    })

    // all .check is checked
    $('.check').on('click', function() {
        if($('.check:checked').length == $('.check').length){
            $('#select_all').prop('checked',true);
        }else {
            $('#select_all').prop('checked',false);
        }
    })

    // for arrow select in form 
    $('.custom-select select').on('click', function() {
        $('.select-icon').toggleClass('active');
    });
})

function del() {
    if($('.check:checked').length >  0){
        let submit = confirm('Yakin ingin hapus data?');
        if (submit == true){
            document.process.action = 'del_all.php';
            document.process.submit();    
        }
    }else {
        alert('Pilih data dulu')
    }
}
