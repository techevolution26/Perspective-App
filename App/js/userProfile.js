document.querySelector('.edit-button').addEventListener('click', function() {
    document.getElementById('editModal').style.display = 'flex';
});

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

document.getElementById('userEditForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle form submission, maybe save the changes
    closeModal();
});

$(document).ready(function() {
    $("#userEditForm").submit(function(event) {
        event.preventDefault();

        var formData =$(this).serialize();

        $.ajax({
            url: "/SystemLogPhp/App/servers/updateProfile.php",
            type: "POST",
            data: formData,
            success: function(response) {
                alert(response.message);
                if (response.success) {

                    $(".username").text($("#username").val());
                    $(".name").text($("#name").val());
                    // $(".fName").text($("#fName").val());
                    // $(".lName").text($("#lName").val());
                    $(".bio").text($("#bio").val());
                    $("location").text($("#location").val());

                    closeModal();
                }
            },
            error: function () {
                alert("An error occurred while updating your profile");
            }
        })
    })
});