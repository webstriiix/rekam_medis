$(document).ready(function() {
    const editButton = $('#editButton');
    const userForm = $('#userForm');
    const cancelButton = $('#cancelButton');
    const nameField = $('#name');
    const addressField = $('#alamat');
    const avatarImg = $('#avatarImg');
    const editAvatarField = $('#editAvatar');

    editButton.on('click', function() {
        userForm.show();

    });

    cancelButton.on('click', function() {
        nameField.show();
        addressField.show();
        avatarImg.show();
        userForm.hide();
    });

});