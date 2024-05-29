function closeContentBox() {
    document.querySelector(".content-box").style.display = "none";
}

function closeChat() {
    // Directly hide the chat box
    document.querySelector(".chat-box").style.display = "none";
    // Ensure the checkbox is unchecked when closing the chat
    document.getElementById("chat-toggle").checked = false;
}

function openChatBox() {
    // Directly show the chat box
    document.querySelector(".chat-box").style.display = "block";
    // Ensure the checkbox is checked when opening the chat
    document.getElementById("chat-toggle").checked = true;
}

function openModal(userId) {
    // TODO: You would fetch user data based on userId and populate the form here.
    $('#displayForm').show();
    $('#contentDisplay').empty();
    document.getElementById("modifyUserModal").style.display = "block";

    $.ajax({
        url: "get_data_profile/"+userId,
        method: "GET", // First change type to method here
        success: function(response) {
            var ret = JSON.parse(response)[0];
            $('#formModify #userid').val(ret.id);
            $('#formModify #firstname').val(ret.firstname);
            $('#formModify #lastname').val(ret.lastname);
            $('#formModify #email').val(ret.email);
            $('#formModify #age').val(ret.age);
            $('#formModify #country').val(ret.country);
            $('#formModify #city').val(ret.city);
            $('#formModify #job').val(ret.job);
            $('#formModify #company').val(ret.company);
            $('#formModify #education').val(ret.education);
        },
        error: function(error) {
            alert("error" + error);
        }
    });

}

function viewImage(base64Url) {
    $('#displayForm').hide();
    $('#contentDisplay').empty().append(`<div align="center"><img style="display:block; width:400px;height:400px;" src="data:image/jpeg;base64, ${base64Url}" /></div>`);
    document.getElementById("modifyUserModal").style.display = "block";
}

function closeModal() {
    document.getElementById("modifyUserModal").style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    var modal = document.getElementById("modifyUserModal");
    if (event.target == modal) {
        closeModal();
    }
};

function toggleMenu() {
    var sideMenu = document.querySelector(".side-menu");
    sideMenu.classList.toggle("active");
}

function changeLanguage(select) {
    var language = select.value; // Get the selected language code
    $.ajax({
        url: "/replace_language/"+language,
        method: "GET", // First change type to method here
        success: function(response) {
            window.location.reload();
        },
        error: function(error) {
            alert("error" + error);
        }
    });
}

function goBack() {
    window.history.back();
}
