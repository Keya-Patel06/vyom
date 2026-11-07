
/* ================================
   PROFILE DROPDOWN
================================ */

function toggleProfile() {

    const dropdown =
        document.getElementById("profileDropdown");

    dropdown.classList.toggle("active");
}


/* ================================
   CLOSE DROPDOWN
================================ */

document.addEventListener("click", function (event) {

    const profile =
        document.querySelector(".profile-container");

    const dropdown =
        document.getElementById("profileDropdown");


    if (!profile.contains(event.target)) {

        dropdown.classList.remove("active");

    }

});


