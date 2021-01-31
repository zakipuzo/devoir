
$(document).ready(function () {

  $("li.caret").click(function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    alert("hh")
  });


  $("#Result table tr").click(function () {
    let id = $("#Result table tbody tr").attr("id");
    location.href = "tableaux.php?id=" + id;
  })

  //select2 plugin
  $("#parent").select2();

  $(".nav-link").addClass("active");

  //Pour ne pas cliquer deux foix;
  $("#addnode").on("submit", function () {
    $(".btnsubmit").hide();
  });

  $('#example').DataTable({
    responsive: true,
    paging: true,
    searching: true,
    select: true,
    ordering: false,
    language: {
      processing: "Traitement en cours...",
      search: "Rechercher&nbsp;:",
      lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
      info: "Total: _TOTAL_ ",

    }
  });







  $.ajax({
    url: "list.php",
    success: function (nodes) {
      let p = organizeNodes(JSON.parse(nodes));

      var res = "<ul class='menu'>";
      p.forEach(NODES => {
        // NODES  FROM PARENT TO CHILD

        NODES.forEach((el, index) => {
          let nextcount;
          let previous;
          let c = -1;
          let count = char_count(el.node, '.');
          if (NODES[index + 1] != undefined) {
            let node = NODES[index + 1];
            nextcount = char_count(node.node, '.');
          }
          else {
            nextcount = 0;
          }

          // res+="<h6>"+count+" "+nextcount+"</h6>";
          //if has child

          if (count < nextcount) {
            res += "<li id=" + el.id + "><span>" + el.name + " </span>";
            res += "<ul>";
          }
          else if (count == nextcount) {
            res += "<li id=" + el.id + "><span>" + el.name + " </span></li>";
          }
          else if (count > nextcount) {
            res += "<li id=" + el.id + "> <span>" + el.name + "</span></li>";
            for (i = 0; i < (count - nextcount); i++) {
              res += "</ul></li>";
            }
          }

        });

      });
      res += "</ul>";
      $("#nodelist").append(res);

      manageListNode();

    },
    error: function (error) {
      alert(error);
    }
  });

  // ici on va retourner plusieurs tab
  function organizeNodes(nodes) {
    var t = [];
    var o = [];
    nodes.map(node => {

      // if general category
      if (char_count(node.node, '.') == 0) {
        if (o.length != 0) {
          t.push(o);
          o = [];
          o.push(node);

        }
        else {

          o.push(node);
        }

      }
      //if child category
      else {
        o.push(node);
      }
    })

    /* add last iteration */
    t.push(o);

    return t;
  }


  function char_count(str, letter) {
    var letter_Count = 0;
    for (var position = 0; position < str.length; position++) {
      if (str.charAt(position) == letter) {
        letter_Count += 1;
      }
    }
    return letter_Count;
  }

  function numberSpaces(node) {
    var number = [];

    let spacenbr = char_count(node.node, '.') * 4;
    for (let i = 0; i < spacenbr; i++) {
      number.push("&nbsp;");
    }
    return number;
  }


  function manageListNode() {

    $(".menu").menu({
      select: function (event, ui) {  
       $("#nodedetails").html(ui.item.find("span:first").text())
       
      }
    });


  }



});

