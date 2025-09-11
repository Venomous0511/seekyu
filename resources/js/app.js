import "./bootstrap";
import { showToast } from "./toast.js";

// Section toggle
window.showSection = function (id) {
    document
        .querySelectorAll(".section")
        .forEach((sec) => sec.classList.add("hidden"));
    document.getElementById(id).classList.remove("hidden");
};

// Modal toggle
window.toggleModal = function (id) {
    document.getElementById(id).classList.toggle("hidden");
};

// Populate and open modals
window.openEditModal = function (id, name, email, role) {
    document.getElementById("editUserId").value = id;
    document.getElementById("editUserName").value = name;
    document.getElementById("editUserEmail").value = email;
    document.getElementById("editUserRole").value = role;
    toggleModal("editUserModal");
};

// Change Password Modal
window.openPasswordModal = function (id) {
    document.getElementById("passwordUserId").value = id;
    toggleModal("changePasswordModal");
};

// Role-based filtering and searching
const searchBox = document.getElementById("searchBox");
const roleFilter = document.getElementById("roleFilter");
const tableBody = document.getElementById("usersTableBody");

function filterTable() {
    const searchTerm = searchBox.value.toLowerCase();
    const selectedRole = roleFilter.value;

    Array.from(tableBody.rows).forEach((row) => {
        const name = row.cells[0].textContent.toLowerCase();
        const email = row.cells[1].textContent.toLowerCase();
        const role = row.getAttribute("data-role").toLowerCase();

        const matchesSearch =
            name.includes(searchTerm) ||
            email.includes(searchTerm) ||
            role.includes(searchTerm);
        const matchesRole =
            selectedRole === "" || role === selectedRole.toLowerCase();

        row.style.display = matchesSearch && matchesRole ? "" : "none";
    });
}
searchBox.addEventListener("input", filterTable);
roleFilter.addEventListener("change", filterTable);

// Form submissions
document
    .getElementById("editUserForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("editUserId").value;
        const name = document.getElementById("editUserName").value;
        const email = document.getElementById("editUserEmail").value;
        const role = document.getElementById("editUserRole").value;
        const token = document.querySelector('input[name="_token"]').value;

        fetch(`/accounts/${id}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ name, email, role }),
        })
            .then((res) => res.json())
            .then((data) => {
                toggleModal("editUserModal");
                showToast({
                    title: "Changes saved",
                    message: "User information updated successfully.",
                    type: "success",
                    duration: 5000,
                });
            });
    });
document
    .getElementById("changePasswordForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("passwordUserId").value;
        const password = document.getElementById("newPassword").value;
        const confirm = document.getElementById("confirmPassword").value;
        const token = document.querySelector('input[name="_token"]').value;

        if (password !== confirm) {
            showToast({
                title: "Error",
                message: "Passwords do not match!",
                type: "error",
            });
            return;
        }

        fetch(`/accounts/${id}/password`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ password }),
        })
            .then((res) => res.json())
            .then((data) => {
                toggleModal("changePasswordModal");
                showToast({
                    title: "Changes saved",
                    message: "Password updated successfully.",
                    type: "success",
                    duration: 5000,
                });
            });
    });

// confirm delete
window.confirmDelete = function (url) {
    const deleteForm = document.getElementById("deleteForm");
    deleteForm.action = url; // set dynamic form action
    toggleModal("deleteModal");
};

// handle toast notification after deletion
document.getElementById("deleteForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const form = this;

    fetch(form.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                .value,
            Accept: "application/json",
        },
        body: new FormData(form),
    })
        .then((res) => res.json())
        .then((data) => {
            toggleModal("deleteModal"); // close modal
            // Remove the row from table (by form action url match)
            const btn = document.querySelector(
                `button[data-url="${form.action}"]`
            );
            if (btn) {
                const row = btn.closest("tr");
                if (row) row.remove();
            }
            // Show toast
            showToast({
                title: "Deleted",
                message: "User has been deleted successfully.",
                type: "success",
            });
        })
        .catch((err) => {
            toggleModal("deleteModal");
            showToast({
                title: "Error",
                message: "Failed to delete user.",
                type: "error",
            });
        });
});

// window.showSection = function (sectionId) {
//     // Hide all sections
//     document
//         .querySelectorAll("#account-mgmt, #messaging-mgmt")
//         .forEach((sec) => sec.classList.add("hidden"));

//     // Show selected section
//     const section = document.getElementById(sectionId);
//     if (section) {
//         section.classList.remove("hidden");
//     }

//     // Update active button style
//     document
//         .querySelectorAll("nav button[data-section]")
//         .forEach((btn) => btn.classList.remove("bg-gray-800", "text-white"));

//     const activeBtn = document.querySelector(
//         `nav button[data-section="${sectionId}"]`
//     );
//     if (activeBtn) {
//         activeBtn.classList.add("bg-gray-800", "text-white");
//     }
// };

// // Default section on load
// document.addEventListener("DOMContentLoaded", () => {
//     showSection("account-mgmt");
// });
