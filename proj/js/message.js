"use strict";

let msg_button = document.getElementById("owner_message_button");

msg_button.addEventListener("click", message_popup);

function message_popup(){
    alert("Message Owner Button Pressed");
}