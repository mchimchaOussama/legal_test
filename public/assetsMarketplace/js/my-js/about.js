
function toggleText() {
    const fullText = document.getElementById('full-text');
    const toggleText = document.getElementById('toggle-text');
    
    // Toggle the visibility of the full text
    if (fullText.style.display === "none") {
        fullText.style.display = "block";   // Show full text
        toggleText.innerText = "Réduire"; // Change button text to "Show Less"
    } else {
        fullText.style.display = "none";    // Hide full text
        toggleText.innerText = "En Savoir Plus"; // Revert button text to "Learn More"
    }
}

function toggleAdditionalInfo() {
    const additionalInfo = document.querySelector('.additional-info');
    const toggleText = document.getElementById('toggle-text');
    
    // Toggle visibility of additional info
    if (additionalInfo.style.display === "none") {
        additionalInfo.style.display = "block"; // Show additional info
        toggleText.innerText = "Réduire"; // Change button text
    } else {
        additionalInfo.style.display = "none"; // Hide additional info
        toggleText.innerText = "En Savoir Plus"; // Revert button text
    }
}

function toggleAdditionalInfob() {
    const additionalInfo = document.querySelector('.additional-infob');
    const toggleText = document.getElementById('toggle-text');
    
    // Toggle visibility of additional info
    if (additionalInfo.style.display === "none") {
        additionalInfo.style.display = "block"; // Show additional info
        toggleText.innerText = "Réduire"; // Change button text
    } else {
        additionalInfo.style.display = "none"; // Hide additional info
        toggleText.innerText = "En Savoir Plus"; // Revert button text
    }
}

function toggleAdditionalInfoc() {
    const additionalInfo = document.querySelector('.additional-infoc');
    const toggleText = document.getElementById('toggle-text');
    
    // Toggle visibility of additional info
    if (additionalInfo.style.display === "none") {
        additionalInfo.style.display = "block"; // Show additional info
        toggleText.innerText = "Réduire"; // Change button text
    } else {
        additionalInfo.style.display = "none"; // Hide additional info
        toggleText.innerText = "En Savoir Plus"; // Revert button text
    }
}
