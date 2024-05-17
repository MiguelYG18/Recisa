// JavaScript para manejar la carga de imagen
const avatarInput = document.getElementById('avatar-input');
const avatarImg = document.getElementById('avatar-img');

avatarInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener('load', function () {
            avatarImg.src = this.result;
        });

        reader.readAsDataURL(file);
    }
});