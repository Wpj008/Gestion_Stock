
function toggleProfile() {
    var profileInfo = document.getElementById('profile-info');
    if (profileInfo.style.display === 'none' || profileInfo.style.display === '') {
        profileInfo.style.display = 'block';
    } else {
        profileInfo.style.display = 'none';
    }
}




function toggleDropdown(element) {
var dropdownContent = element.querySelector('.dropdown-content');
if (dropdownContent.style.display === 'block') {
dropdownContent.style.display = 'none';
} else {
dropdownContent.style.display = 'block';
}
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
if (!event.target.matches('li')) {
var dropdowns = document.getElementsByClassName('dropdown-content');
for (var i = 0; i < dropdowns.length; i++) {
    var openDropdown = dropdowns[i];
    if (openDropdown.style.display === 'block') {
        openDropdown.style.display = 'none';
    }
}
}
}
