// 1. ambil elemen-element
let keyword = document.getElementById("keyword");
let tombolCari = document.getElementById("tombol-cari");
let container = document.getElementById("container");

// 2. membuat triger ketika keyword ditulis
keyword.addEventListener("keyup", () => {
  //3. buat object AJAX
  let xhr = new XMLHttpRequest();

  //4. cek kesiapan AJAX ke db
  xhr.onreadystatechange = () => {
    //xhr.readyState = 4 artinya data dari db sudah ready
    if (xhr.readyState == 4 && xhr.status == 200) {
      //6. replace table dengan hasil apapun yang diketik diinput search
      container.innerHTML = xhr.responseText;
    }
  };

  //5. eksekusi AJAX (true maksudnya request akan dijalankan dengan async)
  //sambil ngirimin keyword ke file mahasiswa php
  xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
  xhr.send();
});
