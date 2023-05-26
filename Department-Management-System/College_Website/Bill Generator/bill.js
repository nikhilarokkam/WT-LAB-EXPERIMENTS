var cheesecake = 200;
    var cherrycake = 275;
    var lemonc = 150;
    var waffles = 300;
    var pancake = 350;
    var donut=100;
    var cherrypie=175;
    var chocolatebrownie=200;
    var cinnamon=250;
    var total = 0;
    var check = 1;
    var gw;
    var scake;
    var perkg;
    var adder = document.querySelector("#getme");
    adder.addEventListener("click", getMe);
    var by = document.querySelector("#out");
    by.addEventListener("click", checkOut);
    var cme = document.querySelector("#clr");
    cme.addEventListener("click", clearMe);

    function getMe() {
      scake = document.querySelector("#sf").value;
      perkg = parseFloat(document.querySelector("#entrybox").value);
      gw = document.querySelector("#writeme");
      if (Number.isNaN(perkg) === true) {
        alert("Only Numbers !!! Or The Field is Empty");
        check = 0;
      }
      else if (perkg<0) {
        alert("Negative value!! @stupid");
        check = 0;
      }
      else{
        check = 1;
      }
      if (check == 1) {
     
        switch (scake) {
          case "CheeseCake":
            var st = cheesecake * perkg;
            gw.value += "Cheese Cake " + perkg + " pc = " + st + " rs\r";
            total += st;
            perkg.value = "";
            break;
          case "CherryCake":
            var at = cherrycake * perkg;
            gw.value += "Cherry Cake " + perkg + " pc = " + at + " rs\r";
            total += at;
            perkg.value = "";
            break;
          case "LemonCake":
            var gr = lemonc * perkg;
            gw.value += "Lemon Cake " + perkg + " pc  = " + gr + " rs\r";
            total += gr;
            perkg.value = "";
            break;
          case "Waffles":
            var ga = waffles * perkg;
            gw.value += "Waffles " + perkg + " pc  = " + ga + " rs\r";
            total += ga;
            perkg.value = "";
            break;
          case "Pancake":
            var pomy = pancake * perkg;
            gw.value += "Pancake " + perkg + " pc  = " + pomy + " rs\r";
            total += pomy;
            perkg.value = "";
            break;
            case "Donut":
                var dony = donut * perkg;
                gw.value += "Donut " + perkg + " pc  = " + dony + " rs\r";
                total += dony;
                perkg.value = "";
                break;
                case "CherryPie":
                    var cp = cherrypie * perkg;
                    gw.value += "Cherry Pie " + perkg + " pc  = " + cp + " rs\r";
                    total += cp;
                    perkg.value = "";
                    break;
                    case "Chocolateb":
                        var cb = chocolatebrownie * perkg;
                        gw.value += "Chocolate Brownie " + perkg + " pc  = " + cb + " rs\r";
                        total += cb;
                        perkg.value = "";
                        break;
                        case "Cinnamon":
                            var cinr = cinnamon * perkg;
                            gw.value += "Cinnamon Roll " + perkg + " pc  = " + cinr + " rs\r";
                            total += cinr;
                            perkg.value = "";
                            break;
        }

      }
    }

    function checkOut() {
      gw.value += "--------------------------------------------------------------\r";
      gw.value += "Your Total Bill Is = " + total + " rs Thanks For Shopping! :)\r";
      gw.value += "--------------------------------------------------------------\r";
      total = 0;
    }
    function clearMe () {
      gw.value = "";
    }
