// chuyen huong
function message(act, id) {
    if (confirm("Bạn có muốn xóa không ?")) {
        window.location.href = `index.php?act=${act}&type=delete&id=${id}`
    }
}

// dowload list
$(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});


function chonTatCa() {
    var checkboxes = document.getElementsByClassName("check-box");
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = true;
    }
}

function boTatCa() {
    var checkboxes = document.getElementsByClassName("check-box");
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
    }
}


function xoaDaChon(act) {
    var checkboxes = document.getElementsByClassName("check-box");
    var deletebox = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked == true) {
            // Thêm giá trị của ô checkbox vào mảng deletebox
            deletebox.push(checkboxes[i].defaultValue);
            // console.log(deletebox);
        }
    }

    if (deletebox.length == 0) {
        alert("Vui lòng chọn");
    } else if (confirm("Bạn có muốn xóa không?")) {
        window.location.href = `index.php?act=${act}&type=deleteSL&arr=${deletebox}`;
    }
}

// Dung js hien thi anh
function hienThiAnh() {
    // Lấy phần tử input file và thẻ img
    var inputAnhNhanVien = document.getElementById('anhNhanVien');
    var anhHienThi = document.getElementById('anhHienThi');

    // Kiểm tra xem có tệp đã chọn hay chưa
    if (inputAnhNhanVien.files && inputAnhNhanVien.files[0]) {
        var reader = new FileReader();

        // Đọc và hiển thị ảnh
        reader.onload = function (e) {
            anhHienThi.src = e.target.result;
        };

        reader.readAsDataURL(inputAnhNhanVien.files[0]);
    }
}


// coppy
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => {
            alert("Đã sao chép: " + text);
        })
        .catch(err => {
            console.error('Lỗi khi sao chép vào clipboard: ', err);
        });
}


// Hàm xử lý sự kiện onclick cho label cap nhat max, soluong cho spct
function capnhat(element, max, id_bt) {
    // Xóa lớp 'active' từ tất cả các label
    $('.btn-outline-primary').removeClass('active');
    // Thêm lớp 'active' cho label được click
    $(element).addClass('active');
    // Cập nhật giá trị của hidden input
    $('#selectedValue').val($(element).text());

    // input
    var input = document.getElementById("max");
    input.removeAttribute("disabled");
    input.max = max;
    input.value = 1;

    // soluong
    var text = document.getElementById("soluong_bt");
    text.innerText = max;

    // id_bt
    var bienthe = document.getElementById("id_bt");
    bienthe.innerText = id_bt;

    if(max == 0){
        input.setAttribute("disabled","true");
        input.min = 0;
        input.value = 0;
    }
}




