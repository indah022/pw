$(document).ready(function() {

    $('#add').click(function () {
        $('#modalDosen').modal('show');

        $('#id').val('');
        $('#nama').val('');
        $('#pria').prop('checked', true);
        $('#usia').val('');
        $('#kode_prodi').val('');
        $('#nama_prodi').val('');
    });

    $('.edit').click(function () {
        var id = $(this).data('id');

        $.ajax({
            url: 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getDosenById?id=' + id,
            type: 'GET',
            success: function (res) {
                var data = res[0];

                $('#modalDosen').modal('show');

                $('#id').val(data._id);
                $('#nama').val(data.nama);

                if (data.jenis_kelamin == 'Pria')
                    $('#pria').prop('checked', true);
                else
                    $('#wanita').prop('checked', true);

                $('#usia').val(data.usia);
                $('#kode_prodi').val((data.prodi ? data.prodi.kode : ''));
                $('#nama_prodi').val((data.prodi ? data.prodi.nama : ''));
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    $('#addPengguna').click(function () {
        $('#modalPengguna').modal('show');

        $('#id').val('');
        $('#username').val('');
        $('#password').val('');
    });

    $('.editPengguna').click(function () {
        const username = $(this).data('username')
        const password = $(this).data('password')

        $.ajax({
            url: `https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getPenggunaByUsernamePassword?username=${username}&password=${password}`,
            type: 'GET',
            success: function (res) {
                var data = res[0];

                $('#modalPengguna').modal('show');

                $('#id').val(data._id);
                $('#username').val(data.username);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

});


// $(document).ready(function() {

//     $('#add').click(function () {
//         $('#modalDosen').modal('show');

//         $('#id').val('');
//         $('#nama').val('');
//         $('#pria').prop('checked', true);
//         $('#usia').val('');
//         $('#kode_prodi').val('');
//         $('#nama_prodi').val('');
//     });

//     $('.edit').click(function () {
//         var id = $(this).data('id');

//         $.ajax({
//             url: 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getDosenById?id=' + id,
//             type: 'GET',
//             success: function (res) {
//                 var data = res[0];

//                 $('#modalDosen').modal('show');

//                 $('#id').val(data._id);
//                 $('#nama').val(data.nama);

//                 if (data.jenis_kelamin == 'Pria')
//                     $('#pria').prop('checked', true);
//                 else
//                     $('#wanita').prop('checked', true);

//                 $('#usia').val(data.usia);
//                 $('#kode_prodi').val((data.prodi ? data.prodi.kode : ''));
//                 $('#nama_prodi').val((data.prodi ? data.prodi.nama : ''));
//             },
//             error: function (err) {
//                 console.log(err);
//             }
//         });
//     });

//     $('#addPengguna').click(function () {
//         $('#modalPengguna').modal('show');

//         $('#id').val('');
//         $('#username').val('');
//         $('#password').val('');
//     });

//     $('.editPengguna').click(function () {
//         const username = $(this).data('username')
//         const password = $(this).data('password')

//         $.ajax({
//             url: `https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getPenggunaByUsernamePassword?username=${username}&password=${password}`,
//             type: 'GET',
//             success: function (res) {
//                 var data = res[0];

//                 $('#modalPengguna').modal('show');

//                 $('#id').val(data._id);
//                 $('#username').val(data.username);
//             },
//             error: function (err) {
//                 console.log(err);
//             }
//         });
//     });

// });

