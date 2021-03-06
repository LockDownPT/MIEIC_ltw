// POP UPS
'use script'


let add_property_button = document.getElementById("addProperty");

add_property_button.addEventListener('click',
    function() {
        location.href = "../pages/addProperty.php";
    });

function encodeForAjax(data) {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function pressed_delete_Button(house_id) {

    let ourRequest = new XMLHttpRequest();
    ourRequest.open("POST", "../actions/api_deleteHouse.php", true);
    ourRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ourRequest.onload = delete_house;
    ourRequest.send(encodeForAjax({ houseId: house_id }));
}

function delete_house() {
    let ourData = JSON.parse(this.responseText);
    console.log(ourData);
    if (ourData == -1)
        alert("Cant Delete That house there's reservation in progress or in the future");
    else
        reloadHtmlRequest();

}

reloadHtmlRequest();


function reloadHtmlRequest() {
    let requestShowHouses = new XMLHttpRequest();
    requestShowHouses.open("GET", "../actions/api_show_houses.php", true);
    requestShowHouses.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    requestShowHouses.onload = reloadHtml;
    requestShowHouses.send();
}

function reloadHtml() {
    let ourData = JSON.parse(this.responseText);
    let div_to_hold_houses = document.getElementById("my_properties");
    if (ourData == -1) {

        let div_to_hold_houses = document.getElementById("my_properties");
        let article = document.createElement('houses')
        article.setAttribute('class', 'post')

        let houses = '<p id="error-no-properties"> No Properties added yet </p>';

        article.innerHTML = houses;


        div_to_hold_houses.innerHTML = article.innerHTML;



    } else {

        let article = document.createElement('houses')
        article.setAttribute('class', 'post')
        console.log(document)

        let houses = return_html_in_string_form(ourData);

        article.innerHTML = houses;

        console.log(article);

        div_to_hold_houses.innerHTML = article.innerHTML;



    }

}


function return_html_in_string_form(ourData) {

    let house = "";

    console.log(ourData.length);

    for (let i = 0; i < ourData.length; i += 3) {

        house += '<div class="myproperties1">';
        house += draw_house_in_organized_fashion_Properties(ourData[i]);
        house += '</div>';

        if (i + 1 < ourData.length) {
            house += '<div class="myproperties2">';
            house += draw_house_in_organized_fashion_Properties(ourData[i + 1]);
            house += '</div>';

        }
        if (i + 2 < ourData.length) {
            house += '<div class="myproperties3">';
            house += draw_house_in_organized_fashion_Properties(ourData[i + 2]);
            house += '</div>';
        }
    }
    return house;
}


function draw_house_in_organized_fashion_Properties(house_data) {

    let house_id = house_data['Id'];
    let return_html_in_string_form;

    return_html_in_string_form = draw_house_in_organized_fashion(house_data);

    //  return_html_in_string_form += '<form action="../pages/editProperty.php" method="post"> <input type="hidden" name="HouseId" value= "' + house_id + '"/> <input type = "submit" name = "edit" value = "Edit" /> </form>
    //  return_html_in_string_form += '<button class="buttonsPropertyOwned" method="POST" action="../actions/action_register.php">Edit</button>';
    return_html_in_string_form += '<form action="../pages/editProperty.php" method="post">';
    return_html_in_string_form += '<input type="hidden" name="HouseId" value=' + house_id + '/>';
    return_html_in_string_form += '<input class="buttonsPropertyOwned" type = "submit" name = "edit" value = "Edit" />';
    return_html_in_string_form += '</form>'
    return_html_in_string_form += '<button class="buttonsPropertyOwned" onClick="pressed_delete_Button(' + house_id + ')">Delete</button>';

    return return_html_in_string_form;
}


function draw_house_in_organized_fashion(house_data) {

    let return_html_in_string_form;

    let pic = house_data["pic"];
    if (pic == null) {
        pic = '../assets/imagesHouses/noHouseImage.png';
    }
    console.log('pic?');
    console.log(pic);
    return_html_in_string_form = '<img src=' + pic + ' width="330" height="230" />';
    return_html_in_string_form += '<section id="my_properties_info" name="information">';
    let name = house_data["Name"];
    let id = house_data['Id'];
    return_html_in_string_form += '<p> <a id="see_house" href="housepage.php?house_id=' + id + '">' + name + '</a></p>';
    let addr = house_data["Address"];
    return_html_in_string_form += '<p>' + addr + '</p>';
    let price = house_data["PricePerDay"];
    return_html_in_string_form += '<p> Price: ' + price + '€ /night </p>';
    let rating = (Math.round(house_data["Rating"] * 100) / 100).toFixed(1);
    let cnt = house_data["cnt"];
    return_html_in_string_form += '<pre><img src=../assets/star.png width="18" height="15" />' + rating + '     ' + cnt + '  comments </pre>';
    return_html_in_string_form += '</section>';

    return return_html_in_string_form;


}