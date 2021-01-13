$(document).ready(function() {
  let url = "api/readMenu.php";
   /* $.ajax({
        type : "GET",
        url : url,
        data : $(this).serialize(),
        dataType : "json",
        success: function (data) {
            var obj = JSON.parse(data);
                console.log(obj[0])

        }

    })*/
        $.ajax({
            url : url,
            type: "POST",
            dataType : "json",
            data: $(this).serialize(),
            success: function(data) {
                var json = JSON.parse(JSON.stringify(data));
                for(var i = 0; i < json.data.length; i++) {
                  console.log(json.data[i]["href"]);
var txt = '  <a class="nav-link btn btn-outline-info"  href="'+ json.data[i]['href']+'">'+ json.data[i]['text'] + ' </a>&nbsp;';
                    $("#test").append(txt);

                }

            }
        })

})
