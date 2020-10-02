import { Utils } from "./utils.js";

let _flag = false;

const formHandler = (event) => {
    event.preventDefault();

    // prevent form spam
    if(_flag) return;

    const url = document.querySelector("#url").value;
    let name = document.querySelector("#name").value;
    if(url.length > 0){ // not empty
        if(Utils.validURL(url)){ // if valid url
            name = (name.length > 0 ? name : ''); // if no name given set empty strng
            const result = Utils.addURL(url, name); // communicate with api
            Utils.showSpinner(true); // show spinner

            _flag = true;
            result.addEventListener( 'load', function(_event) { // once communicating is done
                const result = JSON.parse(_event.target.responseText); // parse result
                if(result.error){
                    // handle error
                    const error = Utils.getError(result.error);
                    Utils.openPopup(`<b>ERROR:</b> ${error}`);
                }else{
                    // handle success
                    const url = result.url;
                    const name = result.name;
                    Utils.openPopup(window.location.origin + '/' + name);
                    event.path[0].reset();
                }

                _flag = false;
                Utils.showSpinner(false); // close spinner
            });
        }else{
            const error = Utils.getError(2);
            Utils.openPopup(`<b>ERROR:</b> ${error}`);
            event.path[0].reset();
        }
    }
}

// form event listener
const formElement = document.querySelector("#form");
formElement.addEventListener("submit", formHandler);

// popup's close button event listener
const closeButton = document.querySelector("#close");
closeButton.addEventListener("click", Utils.closePopup);