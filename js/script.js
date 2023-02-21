$(document).ready(function(){
    //hilangkan tombol cari
    $('#tombol_S').hide();

    //evnt saat keyword di tulis
    $('#keyword').on('keyup', function(){
        //memunculkan icon loading
        $('.loader').show();
        //ajax memakai load
        // $('#container').load('ajax/buah.php?keyword=' + $('#keyword').val());

        //ajax $.get()
        $.get('ajax/buah.php?keyword=' + $('#keyword').val(), function(data){

            $('#container').html(data);
            $('.loader').hide();
        });

    })
});