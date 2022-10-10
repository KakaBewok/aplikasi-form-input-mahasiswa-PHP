$(document).ready(() => {
  //2. hilangkan tombol-cari
  $("#tombol-cari").hide();

  //1. buat event ketika keyword ditulis
  $("#keyword").on("keyup", () => {
    //4. munculkan loading
    $(".loader").show();
    //5. cara kedua selain load(), get lebih powerfull
    //data di parameter = xhr.responseText
    $.get("ajax/mahasiswa.php?keyword=" + $("#keyword").val(), (data) => {
      $("#container").html(data);
      $(".loader").hide();
    });

    //.load()/get untuk mengubah isi dari container
    // $("#container").load("ajax/mahasiswa.php?keyword=" + $("#keyword").val());
  });
});
