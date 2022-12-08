function deleteOrder(id) {
  Swal.fire({
    title: "Xóa đơn hàng này!",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Xóa",
  }).then((result) => {
    if (result.isConfirmed) {
      let xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        window.location = "http://localhost/MTStore_NienLuan/admin/index.php";
      };
      xhttp.open("GET", "admin/php_execute/order-handler.php?id=" + id);
      xhttp.send();
    }
  });
}
function getStatistic() {
  if (document.getElementById("date").value == "") {
    alert("Vui lòng nhập ngày tháng");
  } else {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      document.getElementById("result").innerHTML = this.responseText;
    };
    xhttp.open(
      "GET",
      "php_execute/get_statistic.php?date=" +
        document.getElementById("date").value
    );
    xhttp.send();
  }
}
