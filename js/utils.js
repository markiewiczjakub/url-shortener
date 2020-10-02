export class Utils {
    // error messages
    static errors = {
        1: "Given name already exists in database!",
        2: "Invalid URL!"
    };

    static getError(n) {
        return Utils.errors[n] || '';
    }

    // url validation
    static validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
          '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
          '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
          '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
          '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return !!pattern.test(str);
    }

    static addURL(url, name){
        const XHR = new XMLHttpRequest();
        XHR.open('POST', './api/api.php');
        XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        XHR.send(`url=${url}&name=${name}`);
        return XHR;
    }

    static openPopup(v){
        document.querySelector("#result").innerHTML = v;
        document.querySelector("#popup").style.display = "flex";
    }

    static closePopup(){
        document.querySelector("#popup").style.display = "none";
    }

    static showSpinner(s){
        const spinner = document.querySelector("#spinner");
        const text = document.querySelector("#submitText");
        if(s){
            spinner.style.display = "block";
            text.style.display = "none";
        }else{
            text.style.display = "block";
            spinner.style.display = "none";
        }
    }
}