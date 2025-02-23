<script>
// crud start
function ajaxCall(form_id, url_name, target_id, method = "POST") {
    // getting the all from form
    var form = document.getElementById(form_id);
    // setting all input into the forData object
    var formdata = new FormData(form);
    // if (formValidate(form.elements, form)) {
    var formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(target_id).innerHTML = this.responseText;
            stopPreloader(formElements_button, "span");
        }
    };
    xhttp.open(method, url_name, true);
    xhttp.send(formdata);
}
// }

function formValidate(el, form_id) {
    var flag = true;
    for (f = 0; f < el.length; f++) {

        if (el[f].required && el[f].value == '') {
            setError(el[f], " is Required filed please Input", form_id)
            flag = false;
        }

        if ('max' in el && el[f].value <= el[f].max) {
            setError(el[f], " is Required filed please Input", form_id)
            flag = false;
        }

    }
    return flag;
}

function setError(el, errr_message, form_id) {
    createdd_element = createMenuItem("span", {
        name: el.name + errr_message,
        class: "text-danger",
        id: "lol",
        size: "12px",
    });
    el.style.borderColor = "#dc3545"
    form_id.appendChild(createdd_element);
}

function editForm(url_name, table_id, target_id, method = "POST") {

    preloader('', target_id);
    // getting the button of the form and passing into the preloader function
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(target_id).innerHTML = this.responseText;
            stopPreloader('', target_id);
        }
    };
    xhttp.open(method, url_name + "?id=" + table_id, true);
    xhttp.send();
}




function deleteForm(url_name, table_id, target_id, method = "POST") {
    if (confirm('Are sure to delete !!!')) {
        preloader('', target_id);
        // getting the button of the form and passing into the preloader function
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(target_id).innerHTML = this.responseText;
                stopPreloader('', target_id);
            }
        };
        xhttp.open(method, url_name + "?id=" + table_id, true);
        xhttp.send();
    }
}

function changeStatus(url_name, table_id, target_id, method = "POST") {
    if (confirm('Are sure to Change Status !!!')) {
        preloader('', target_id);
        // getting the button of the form and passing into the preloader function
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(target_id).innerHTML = this.responseText;
                stopPreloader('', target_id);
            }
        };
        xhttp.open(method, url_name + "?id=" + table_id, true);
        xhttp.send();
    }
}




function fetchApi(form_id, url_name, target_id, method = "POST") {
    const form = document.getElementById(form_id);
    // setting all input into the forData object
    FormData = new FormData(form);
    const formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    fetch(url_name, {
            method: method,
            body: FormData,
        })
        .then((response) => response.text())
        .then((text) => {
            document.getElementById(target_id).innerHTML = text;
            stopPreloader(formElements_button, "span");
        })
        .catch((error) => console.error("Error:", error));
}

fetch("test.php", {})
    .then(function(data) {
        console.log(data);
    })
    .catch((error) => console.error("Error:", error));
// crud end

// some special fucntion start
function preloader(element_data, id = "") {
    var element = "";
    if (id != "") {
        element = document.getElementById(id);
    } else {
        element = element_data;
    }

    element.disabled = true;
    createdd_element = createMenuItem("span", {
        name: "",
        class: "spinner-border spinner-border-sm",
        id: "lol",
        size: "20px",
    });
    element.appendChild(createdd_element);
}

function stopPreloader(element_data, child, id = "") {
    var element = "";
    if (id != "") {
        element = document.getElementById(id);
    } else {
        element = element_data;
    }
    element.removeChild(element.firstElementChild);
    element.disabled = false;
}

function createMenuItem(element, data) {
    let created_element = document.createElement(element);
    created_element.textContent = data.name;
    created_element.setAttribute("class", data.class);
    created_element.setAttribute("id", data.id);
    created_element.setAttribute("style", "font-size:" + data.size);
    return created_element;
}
// some special function end


function Jajax(form_id, url_name, target_id, event, method = "POST") {
    $('#' + target_id).html(
        '<center id = "loading"><img width="50px" src = "<?= url('images/ajax-loader.gif') ?> " alt="Currently loading" /></center>'
        );
    $('#' + form_id).prop('disabled', true);
    $.ajax({
        url: url_name,
        type: method,
        data: $('#' + form_id).serializeArray(),
        success: function(result) {
            $('#' + target_id).html('<div id = "response">' + result + '</div>');
            $('#loading').fadeOut(500, function() {
                $(this).remove();
            });
            $('#' + form_id).prop('disabled', false);
        }
    });
    event.preventDefault();
}

function image_check(element, uploadImageSize) {
    var imgpath = element;
    console.log(element.files[0]);
    if (!imgpath.value == "") {
        var img = imgpath.files[0].size;
        var imgsize = Math.round(img / 1024);
        if (imgsize > uploadImageSize) {
            alert("Image size is " + imgsize + " KB please Upload  Image smaller than " + uploadImageSize + " KB");
            element.value = "";
        }
    }
}

// multi select js for select multile value at a time
var selected_array = [];

function multiselect(selectBox) {
    selectBox.style.height = "auto"
    var selectedValue = selectBox.selectedIndex;
    if (selected_array.includes(selectBox.selectedIndex)) {
        selected_array.pop()
        document.getElementById('session_check').options[selectBox.selectedIndex].selected = ""

    } else {
        selected_array.push(selectedValue);
    }
    console.log(selected_array);
    for (i = 0; i < selected_array.length; i++) {
        document.getElementById('session_check').options[selected_array[i]].selected = "true";
        document.getElementById('session_check').options[selected_array[i]].classList.add('fas')
        document.getElementById('session_check').options[selected_array[i]].classList.add('fa-check')

    }
}
</script>