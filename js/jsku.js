/* MENU */
$(".pilih").click(function () {
    var item = $(this);
    var dok = item.attr("dok").trim();
    $.post(dok)
      .done(function (hasil) {
        $("#isicontent").html(hasil);
      })
      .fail(function () {
        $("#isicontent").load("404.html");
      });
  });

  
 