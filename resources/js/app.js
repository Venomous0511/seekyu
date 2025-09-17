import "./bootstrap";
// Section toggle
window.showSection = function (id) {
    document
        .querySelectorAll(".section")
        .forEach((sec) => sec.classList.add("hidden"));
    document.getElementById(id).classList.remove("hidden");
};

// Modal toggle
// window.toggleModal = function (id) {
//     document.getElementById(id).classList.toggle("hidden");
// };

// Populate and open modals
// window.openEditModal = function (id, name, email, role) {
//     document.getElementById("editUserId").value = id;
//     document.getElementById("editUserName").value = name;
//     document.getElementById("editUserEmail").value = email;
//     document.getElementById("editUserRole").value = role;
//     toggleModal("editUserModal");
// };

// Change Password Modal
// window.openPasswordModal = function (id) {
//     document.getElementById("passwordUserId").value = id;
//     toggleModal("changePasswordModal");
// };

// Role-based filtering and searching
// const searchBox = document.getElementById("searchBox");
// const roleFilter = document.getElementById("roleFilter");
// const tableBody = document.getElementById("usersTableBody");

// function filterTable() {
//     const searchTerm = searchBox.value.toLowerCase();
//     const selectedRole = roleFilter.value;

//     Array.from(tableBody.rows).forEach((row) => {
//         const name = row.cells[0].textContent.toLowerCase();
//         const email = row.cells[1].textContent.toLowerCase();
//         const role = row.getAttribute("data-role").toLowerCase();

//         const matchesSearch =
//             name.includes(searchTerm) ||
//             email.includes(searchTerm) ||
//             role.includes(searchTerm);
//         const matchesRole =
//             selectedRole === "" || role === selectedRole.toLowerCase();

//         row.style.display = matchesSearch && matchesRole ? "" : "none";
//     });
// }
// searchBox.addEventListener("input", filterTable);
// roleFilter.addEventListener("change", filterTable);

// Form submissions
// document
//     .getElementById("editUserForm")
//     .addEventListener("submit", function (e) {
//         e.preventDefault();
//         const id = document.getElementById("editUserId").value;
//         const name = document.getElementById("editUserName").value;
//         const email = document.getElementById("editUserEmail").value;
//         const role = document.getElementById("editUserRole").value;
//         const token = document.querySelector('input[name="_token"]').value;

//         fetch(`/accounts/${id}`, {
//             method: "PUT",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": token,
//             },
//             body: JSON.stringify({ name, email, role }),
//         })
//             .then((res) => res.json())
//             .then((data) => {
//                 toggleModal("editUserModal");
//                 showToast({
//                     title: "Changes saved",
//                     message: "User information updated successfully.",
//                     type: "success",
//                     duration: 5000,
//                 });
//             });
//     });
// document
//     .getElementById("changePasswordForm")
//     .addEventListener("submit", function (e) {
//         e.preventDefault();
//         const id = document.getElementById("passwordUserId").value;
//         const password = document.getElementById("newPassword").value;
//         const confirm = document.getElementById("confirmPassword").value;
//         const token = document.querySelector('input[name="_token"]').value;

//         if (password !== confirm) {
//             showToast({
//                 title: "Error",
//                 message: "Passwords do not match!",
//                 type: "error",
//             });
//             return;
//         }

//         fetch(`/accounts/${id}/password`, {
//             method: "PUT",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": token,
//             },
//             body: JSON.stringify({ password }),
//         })
//             .then((res) => res.json())
//             .then((data) => {
//                 toggleModal("changePasswordModal");
//                 showToast({
//                     title: "Changes saved",
//                     message: "Password updated successfully.",
//                     type: "success",
//                     duration: 5000,
//                 });
//             });
//     });

// confirm delete
// window.confirmDelete = function (url) {
//     const deleteForm = document.getElementById("deleteForm");
//     deleteForm.action = url; // set dynamic form action
//     toggleModal("deleteModal");
// };

// handle toast notification after deletion
// document.getElementById("deleteForm").addEventListener("submit", function (e) {
//     e.preventDefault();
//     const form = this;

//     fetch(form.action, {
//         method: "POST",
//         headers: {
//             "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
//                 .value,
//             Accept: "application/json",
//         },
//         body: new FormData(form),
//     })
//         .then((res) => res.json())
//         .then((data) => {
//             toggleModal("deleteModal"); // close modal
//             // Remove the row from table (by form action url match)
//             const btn = document.querySelector(
//                 `button[data-url="${form.action}"]`
//             );
//             if (btn) {
//                 const row = btn.closest("tr");
//                 if (row) row.remove();
//             }
//             // Show toast
//             showToast({
//                 title: "Deleted",
//                 message: "User has been deleted successfully.",
//                 type: "success",
//             });
//         })
//         .catch((err) => {
//             toggleModal("deleteModal");
//             showToast({
//                 title: "Error",
//                 message: "Failed to delete user.",
//                 type: "error",
//             });
//         });
// });

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

// SAMPLE

document.addEventListener("DOMContentLoaded", function () {
    // Sidebar mobile toggle (kept similar to your original)
    const mobileToggle = document.getElementById("mobile-sidebar-toggle");
    mobileToggle?.addEventListener("click", function () {
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("-ml-64");
        sidebar.classList.toggle("ml-0");
        const toggleIcon = document.querySelector("#sidebar-toggle i");
        if (sidebar.classList.contains("-ml-64")) {
            toggleIcon.classList.remove("fa-times");
            toggleIcon.classList.add("fa-bars");
        } else {
            toggleIcon.classList.remove("fa-bars");
            toggleIcon.classList.add("fa-times");
        }
    });

    // --- Section switching (keeps your showSection logic but safer) ---
    window.showSection = function (sectionId, clickedBtn = null) {
        document
            .querySelectorAll(".content-section")
            .forEach((s) => s.classList.remove("active"));
        document
            .querySelectorAll(".sidebar-item")
            .forEach((i) => i.classList.remove("active"));

        const target = document.getElementById(sectionId);
        if (target) target.classList.add("active");

        // mark button active if provided
        if (clickedBtn) clickedBtn.classList.add("active");

        if (window.innerWidth < 1024) {
            document.querySelector(".sidebar")?.classList.add("-ml-64");
            const icon = document.querySelector("#sidebar-toggle i");
            if (icon) {
                icon.classList.remove("fa-times");
                icon.classList.add("fa-bars");
            }
        }
    };
}); // <-- Add this closing brace for document.addEventListener
// --- Messaging Section Logic ---
// If sidebar buttons use inline onclick (your layout), ensure the Messaging button opens inbox first
const messagingSidebarBtn = Array.from(
    document.querySelectorAll("button")
).find((b) =>
    b.getAttribute("onclick")?.includes("showSection('messaging-mgmt')")
);
if (messagingSidebarBtn) {
    messagingSidebarBtn.addEventListener("click", function (ev) {
        // use the safer showSection, and pass the clicked button to be marked active
        showSection("messaging-mgmt", messagingSidebarBtn);
        showInbox();
    });
}

// --- Messaging UI elements ---
const inboxBtn = document.getElementById("inboxBtn");
const composeBtn = document.getElementById("composeBtn");
const inboxSection = document.getElementById("inbox-section");
const composeSection = document.getElementById("compose-section");
const cancelCompose = document.getElementById("cancelCompose");
const composeForm = document.getElementById("composeForm");
const messageTable = document.getElementById("messageTable");
const messagePopup = document.getElementById("message-popup");
const popupSender = document.getElementById("popupSender");
const popupRecipient = document.getElementById("popupRecipient");
const popupSubject = document.getElementById("popupSubject");
const popupDate = document.getElementById("popupDate");
const popupBody = document.getElementById("popupBody");
const replyBtn = document.getElementById("replyBtn");
const deleteBtn = document.getElementById("deleteBtn");
const closePopupBtns = [
    document.getElementById("closePopup"),
    document.getElementById("closePopup2"),
];

// In-memory messages store for frontend demo (id increments)
let messages = [
    {
        id: 1,
        sender: "Admin",
        recipient: "You",
        subject: "Welcome to SeekYu",
        date: "2025-09-13",
        body: "This is a sample welcome message.",
    },
];
let nextMessageId = 2;
let currentViewedMessageId = null; // id of message currently shown in popup

function renderInbox() {
    messageTable.innerHTML = "";
    for (const msg of messages.slice().reverse()) {
        // show newest first
        const tr = document.createElement("tr");
        tr.innerHTML = `
        <td class="py-2">${escapeHtml(msg.sender)}</td>
        <td class="py-2">${escapeHtml(msg.subject)}</td>
        <td class="py-2">${escapeHtml(msg.date)}</td>
        <td class="py-2">
          <button class="viewBtn text-blue-600 hover:underline" data-id="${
              msg.id
          }">View</button>
          <button class="delInlineBtn ml-3 text-red-600 hover:underline" data-id="${
              msg.id
          }">Delete</button>
        </td>`;
        messageTable.appendChild(tr);
    }
}

// Simple HTML escape
function escapeHtml(s) {
    if (!s && s !== 0) return "";
    return String(s).replace(/[&<>"'`=\/]/g, function (ch) {
        return {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;",
            "/": "&#47;",
            "`": "&#96;",
            "=": "&#61;",
        }[ch];
    });
}

// Inbox/Compose toggles
function showInbox() {
    inboxSection.classList.remove("hidden");
    composeSection.classList.add("hidden");
    inboxBtn.classList.add("bg-indigo-600", "text-white");
    inboxBtn.classList.remove("bg-slate-200", "text-gray-800");
    composeBtn.classList.remove("bg-indigo-600", "text-white");
    composeBtn.classList.add("bg-slate-200", "text-gray-800");
}
function showCompose() {
    composeSection.classList.remove("hidden");
    inboxSection.classList.add("hidden");
    composeBtn.classList.add("bg-indigo-600", "text-white");
    composeBtn.classList.remove("bg-slate-200", "text-gray-800");
    inboxBtn.classList.remove("bg-indigo-600", "text-white");
    inboxBtn.classList.add("bg-slate-200", "text-gray-800");
}
inboxBtn?.addEventListener("click", showInbox);
composeBtn?.addEventListener("click", showCompose);
cancelCompose?.addEventListener("click", showInbox);

// Open a message in popup (delegated)
document.addEventListener("click", function (e) {
    // view inline from table
    if (e.target && e.target.classList.contains("viewBtn")) {
        const id = Number(e.target.dataset.id);
        const msg = messages.find((m) => m.id === id);
        if (!msg) return;
        currentViewedMessageId = id;
        popupSender.textContent = msg.sender;
        popupRecipient.textContent = msg.recipient;
        popupSubject.textContent = msg.subject;
        popupDate.textContent = msg.date;
        popupBody.textContent = msg.body;
        messagePopup.classList.remove("hidden");
    }

    // inline delete button in table (asks confirm)
    if (e.target && e.target.classList.contains("delInlineBtn")) {
        const id = Number(e.target.dataset.id);
        if (!confirm("Delete this message?")) return;
        messages = messages.filter((m) => m.id !== id);
        renderInbox();
        // if deleted message is currently open in popup, close popup
        if (currentViewedMessageId === id) {
            currentViewedMessageId = null;
            messagePopup.classList.add("hidden");
        }
    }
});

// Reply button: prefill compose form and open compose
replyBtn?.addEventListener("click", function () {
    if (!currentViewedMessageId) return;
    const msg = messages.find((m) => m.id === currentViewedMessageId);
    if (!msg) return;
    // open messaging section and compose
    showSection("messaging-mgmt");
    showCompose();

    // prefill
    const recipientInput = document.getElementById("recipient");
    const subjectInput = document.getElementById("subject");
    const bodyTextarea = document.getElementById("message");

    if (recipientInput) recipientInput.value = msg.sender || "";
    if (subjectInput) {
        // if subject already starts with Re:, keep it
        subjectInput.value =
            msg.subject && !/^Re:/i.test(msg.subject)
                ? `Re: ${msg.subject}`
                : msg.subject || "";
    }
    if (bodyTextarea) {
        bodyTextarea.value = `\n\n--- Original Message ---\nFrom: ${msg.sender}\nDate: ${msg.date}\nSubject: ${msg.subject}\n\n${msg.body}`;
        bodyTextarea.focus();
        // put cursor at start of textarea for user to type reply
        bodyTextarea.setSelectionRange(0, 0);
    }

    // close popup after replying to reduce UI noise
    messagePopup.classList.add("hidden");
});

// Delete button (from popup) - removes the message and closes popup
deleteBtn?.addEventListener("click", function () {
    if (!currentViewedMessageId) return;
    if (!confirm("Delete this message? This cannot be undone in this demo."))
        return;
    messages = messages.filter((m) => m.id !== currentViewedMessageId);
    currentViewedMessageId = null;
    messagePopup.classList.add("hidden");
    renderInbox();
});

// Close popup buttons
closePopupBtns.forEach((btn) =>
    btn?.addEventListener("click", function () {
        messagePopup.classList.add("hidden");
        currentViewedMessageId = null;
    })
);

// Clicking outside popup content closes it
messagePopup?.addEventListener("click", function (e) {
    if (e.target === messagePopup) {
        messagePopup.classList.add("hidden");
        currentViewedMessageId = null;
    }
});

// Compose handler (frontend-only simulation)
composeForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    const recipient = document.getElementById("recipient").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const body = document.getElementById("message").value.trim();
    if (!recipient || !subject || !body) {
        alert("Please fill out all fields.");
        return;
    }
    const newMsg = {
        id: nextMessageId++,
        sender: "You", // outgoing: from current user
        recipient,
        subject,
        date: new Date().toISOString().split("T")[0],
        body,
    };
    // For demo, add to messages store (so it appears in inbox)
    messages.push(newMsg);
    renderInbox();
    // Reset form and show inbox
    composeForm.reset();
    showInbox();
    alert(
        "Message sent (demo mode). In a real app this would call your backend API."
    );
});

// initial render: show inbox first
renderInbox();
showInbox();

// Utility: refresh button (just re-render here)
document.getElementById("refreshBtn")?.addEventListener("click", function () {
    renderInbox();
});

// Search (very basic filter by subject/sender)
document
    .getElementById("messageSearch")
    ?.addEventListener("input", function () {
        const q = this.value.trim().toLowerCase();
        const rows = messageTable.querySelectorAll("tr");
        rows.forEach((r) => {
            const txt = r.textContent.toLowerCase();
            r.style.display = txt.includes(q) ? "" : "none";
        });
    });

// accounts management logic
(function () {
    // Elements (same IDs as in the HTML you already have)
    const createForm = document.getElementById("createAccountForm");
    const accountsTable = document.getElementById("accountsTable");
    const removedTable = document.getElementById("removedAccountsTable");
    const accountsSearch = document.getElementById("accountsSearch");
    const removedSearch = document.getElementById("removedSearch");
    const refreshAccounts = document.getElementById("refreshAccounts");

    const editModal = document.getElementById("editAccountModal");
    const editForm = document.getElementById("editAccountForm");
    const closeEditModal = document.getElementById("closeEditModal");
    const cancelEdit = document.getElementById("cancelEdit");

    const passModal = document.getElementById("changePasswordModal");
    const passForm = document.getElementById("changePasswordForm");
    const closePassModal = document.getElementById("closePassModal");
    const cancelPass = document.getElementById("cancelPass");

    const tabCreate = document.getElementById("accountsTabCreate");
    const tabView = document.getElementById("accountsTabView");
    const tabRemoved = document.getElementById("accountsTabRemoved");
    const createSection = document.getElementById("create-account-section");
    const viewSection = document.getElementById("view-accounts-section");
    const removedSection = document.getElementById("removed-accounts-section");
    const resetCreate = document.getElementById("resetCreate");

    // In-memory stores
    // account object shape:
    // { id: number, accountId: 'ADM-0001', fullName, username, role, password, createdAt }
    let accounts = [
        {
            id: 1,
            accountId: "ADM-0001",
            fullName: "Jane Admin",
            username: "jane.admin",
            role: "Admin",
            password: "admin123",
            createdAt: "2025-09-13",
        },
    ];
    let removedAccounts = []; // { id, accountId, fullName, username, role, password, createdAt, removedAt }
    let nextAccountId = 2;

    // mapping for prefixes
    const rolePrefixes = {
        Admin: "ADM",
        HR: "HR",
        "Security Guard": "SG",
        "Head Guard": "HG",
        Client: "CL",
    };

    // utils
    function today() {
        return new Date().toISOString().split("T")[0];
    }
    function padNum(n, size = 4) {
        return String(n).padStart(size, "0");
    }
    function genAccountId(role, seq) {
        const pref = rolePrefixes[role] || "USR";
        return `${pref}-${padNum(seq)}`;
    }
    function escapeHtml(s) {
        if (!s && s !== 0) return "";
        return String(s).replace(/[&<>"'`=\/]/g, function (ch) {
            return {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;",
                "`": "&#96;",
                "=": "&#61;",
            }[ch];
        });
    }

    // Render functions
    function renderAccounts(filter = "") {
        accountsTable.innerHTML = "";
        const rows = accounts.filter((a) => {
            const q = filter.toLowerCase();
            return (
                !q ||
                (
                    a.accountId +
                    " " +
                    a.fullName +
                    " " +
                    a.username +
                    " " +
                    a.role
                )
                    .toLowerCase()
                    .includes(q)
            );
        });

        if (rows.length === 0) {
            accountsTable.innerHTML =
                '<tr><td class="py-4 px-3 text-slate-500" colspan="6">No accounts found.</td></tr>';
            return;
        }

        for (const a of rows) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
        <td class="py-3 px-3 font-mono text-sm">${escapeHtml(a.accountId)}</td>
        <td class="py-3 px-3">${escapeHtml(a.fullName)}</td>
        <td class="py-3 px-3">${escapeHtml(a.username)}</td>
        <td class="py-3 px-3">${escapeHtml(a.role)}</td>
        <td class="py-3 px-3">${escapeHtml(a.createdAt)}</td>
        <td class="py-3 px-3">
          <button class="editBtn text-indigo-600 hover:underline" data-id="${
              a.id
          }">Edit</button>
          <button class="passBtn ml-3 text-sky-600 hover:underline" data-id="${
              a.id
          }">Change Password</button>
          <button class="removeBtn ml-3 text-red-600 hover:underline" data-id="${
              a.id
          }">Remove</button>
        </td>
      `;
            accountsTable.appendChild(tr);
        }
    }

    function renderRemovedAccounts(filter = "") {
        removedTable.innerHTML = "";
        const rows = removedAccounts.filter((a) => {
            const q = filter.toLowerCase();
            return (
                !q ||
                (
                    a.accountId +
                    " " +
                    a.fullName +
                    " " +
                    a.username +
                    " " +
                    a.role
                )
                    .toLowerCase()
                    .includes(q)
            );
        });

        if (rows.length === 0) {
            removedTable.innerHTML =
                '<tr><td class="py-4 px-3 text-slate-500" colspan="6">No removed accounts.</td></tr>';
            return;
        }

        for (const a of rows) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
        <td class="py-3 px-3 font-mono text-sm">${escapeHtml(a.accountId)}</td>
        <td class="py-3 px-3">${escapeHtml(a.fullName)}</td>
        <td class="py-3 px-3">${escapeHtml(a.username)}</td>
        <td class="py-3 px-3">${escapeHtml(a.role)}</td>
        <td class="py-3 px-3">${escapeHtml(a.removedAt)}</td>
        <td class="py-3 px-3">
          <button class="restoreBtn text-emerald-600 hover:underline" data-id="${
              a.id
          }">Restore</button>
          <button class="permaDelBtn ml-3 text-red-700 hover:underline" data-id="${
              a.id
          }">Permanently Delete</button>
        </td>
      `;
            removedTable.appendChild(tr);
        }
    }

    // Initial render
    renderAccounts();
    renderRemovedAccounts();

    // TAB handlers
    function activateTab(tab) {
        [tabCreate, tabView, tabRemoved].forEach((t) =>
            t.classList.remove("bg-indigo-600", "text-white")
        );
        [tabCreate, tabView, tabRemoved].forEach((t) =>
            t.classList.add("bg-slate-200", "text-gray-800")
        );
        tab.classList.remove("bg-slate-200", "text-gray-800");
        tab.classList.add("bg-indigo-600", "text-white");

        createSection.classList.add("hidden");
        viewSection.classList.add("hidden");
        removedSection.classList.add("hidden");

        if (tab === tabCreate) createSection.classList.remove("hidden");
        if (tab === tabView) viewSection.classList.remove("hidden");
        if (tab === tabRemoved) removedSection.classList.remove("hidden");
    }

    tabCreate.addEventListener("click", () => activateTab(tabCreate));
    tabView.addEventListener("click", () => activateTab(tabView));
    tabRemoved.addEventListener("click", () => activateTab(tabRemoved));

    // Default: show create
    activateTab(tabCreate);

    // Create account: now generates accountId
    createForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const fullName = document.getElementById("fullName").value.trim();
        const username = document.getElementById("username").value.trim();
        const role = document.getElementById("role").value;
        const password = document.getElementById("password").value;

        if (!fullName || !username || !role || !password) {
            alert("Please fill out all fields.");
            return;
        }

        // Generate accountId from role prefix + sequence
        const accountId = genAccountId(role, nextAccountId);

        // ensure unique accountId / username (demo)
        if (
            accounts.some((a) => a.username === username) ||
            removedAccounts.some((a) => a.username === username)
        ) {
            alert("Username already exists. Choose another one.");
            return;
        }
        if (
            accounts.some((a) => a.accountId === accountId) ||
            removedAccounts.some((a) => a.accountId === accountId)
        ) {
            // unlikely as we use incremental, but handle it
            nextAccountId++;
            alert(
                "ID collision, generating a different ID. Please submit again."
            );
            return;
        }

        const newAcc = {
            id: nextAccountId++,
            accountId,
            fullName,
            username,
            role,
            password,
            createdAt: today(),
        };
        accounts.push(newAcc);
        renderAccounts();
        createForm.reset();
        // show the login credentials clearly to the admin
        alert(
            `Account created (demo).\nLogin ID: ${accountId}\nPassword: (the one you entered)\n\nIMPORTANT: Share the Login ID with the user. In production, send this via secure channel.`
        );
        // optionally switch to view tab
        activateTab(tabView);
    });

    resetCreate.addEventListener("click", function () {
        createForm.reset();
    });

    // Table action delegation for accounts (edit, change pass, remove)
    document.addEventListener("click", function (e) {
        if (e.target.matches(".editBtn")) {
            const id = Number(e.target.dataset.id);
            const a = accounts.find((x) => x.id === id);
            if (!a) return;
            document.getElementById("editId").value = a.id;
            document.getElementById("editFullName").value = a.fullName;
            document.getElementById("editUsername").value = a.username;
            document.getElementById("editRole").value = a.role;
            editModal.classList.remove("hidden");
        }

        if (e.target.matches(".passBtn")) {
            const id = Number(e.target.dataset.id);
            document.getElementById("passUserId").value = id;
            document.getElementById("newPassword").value = "";
            document.getElementById("confirmNewPassword").value = "";
            passModal.classList.remove("hidden");
        }

        if (e.target.matches(".removeBtn")) {
            const id = Number(e.target.dataset.id);
            if (!confirm("Move this account to Removed (Trash)?")) return;
            const idx = accounts.findIndex((x) => x.id === id);
            if (idx === -1) return;
            const removed = accounts.splice(idx, 1)[0];
            removed.removedAt = today();
            removedAccounts.push(removed);
            renderAccounts();
            renderRemovedAccounts();
        }

        // Removed table actions
        if (e.target.matches(".restoreBtn")) {
            const id = Number(e.target.dataset.id);
            const idx = removedAccounts.findIndex((x) => x.id === id);
            if (idx === -1) return;
            const restored = removedAccounts.splice(idx, 1)[0];
            delete restored.removedAt;
            accounts.push(restored);
            renderAccounts();
            renderRemovedAccounts();
        }

        if (e.target.matches(".permaDelBtn")) {
            const id = Number(e.target.dataset.id);
            if (
                !confirm(
                    "Permanently delete this account? This cannot be undone."
                )
            )
                return;
            const idx = removedAccounts.findIndex((x) => x.id === id);
            if (idx === -1) return;
            removedAccounts.splice(idx, 1);
            renderRemovedAccounts();
        }
    });

    // Edit form submit
    editForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const id = Number(document.getElementById("editId").value);
        const fullName = document.getElementById("editFullName").value.trim();
        const username = document.getElementById("editUsername").value.trim();
        const role = document.getElementById("editRole").value;

        const acc = accounts.find((a) => a.id === id);
        if (!acc) {
            alert("Account not found");
            return;
        }

        // ensure username unique among accounts and removed (except self)
        if (
            accounts.some((a) => a.username === username && a.id !== id) ||
            removedAccounts.some((a) => a.username === username)
        ) {
            alert("Username already taken.");
            return;
        }

        acc.fullName = fullName;
        acc.username = username;
        acc.role = role;
        // NOTE: accountId stays unchanged here to preserve login credentials
        renderAccounts();
        editModal.classList.add("hidden");
    });

    closeEditModal.addEventListener("click", () =>
        editModal.classList.add("hidden")
    );
    cancelEdit.addEventListener("click", () =>
        editModal.classList.add("hidden")
    );

    // Change password submit
    passForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const id = Number(document.getElementById("passUserId").value);
        const p1 = document.getElementById("newPassword").value;
        const p2 = document.getElementById("confirmNewPassword").value;
        if (!p1 || !p2) {
            alert("Enter the new password in both fields.");
            return;
        }
        if (p1 !== p2) {
            alert("Passwords do not match");
            return;
        }
        const acc = accounts.find((a) => a.id === id);
        if (!acc) {
            alert("Account not found");
            return;
        }
        acc.password = p1; // demo only
        passModal.classList.add("hidden");
        alert(
            "Password changed (demo mode). In production, call your backend API and hash passwords."
        );
    });

    closePassModal.addEventListener("click", () =>
        passModal.classList.add("hidden")
    );
    cancelPass.addEventListener("click", () =>
        passModal.classList.add("hidden")
    );

    // Search handlers
    accountsSearch?.addEventListener("input", function () {
        renderAccounts(this.value || "");
    });
    removedSearch?.addEventListener("input", function () {
        renderRemovedAccounts(this.value || "");
    });
    refreshAccounts?.addEventListener("click", function () {
        renderAccounts();
    });

    // Optional: Expose functions for backend wiring
    window.AccountsDemo = {
        getAccounts: () => accounts,
        getRemoved: () => removedAccounts,
        render: () => {
            renderAccounts();
            renderRemovedAccounts();
        },
    };
})();

/* User Activity module (localStorage-backed demo)
   - exposes window.UserActivity.add(log)
   - log shape: { id, timeISO, userId, accountId, name, role, type, source (IP/UA), details }
*/
(function () {
    const STORAGE_KEY = "seekyu_user_activity_v1";
    // demo current user for "privileged" actions if needed
    const currentUser = window.loggedUser || {
        id: 1,
        name: "Alice Admin",
        role: "Admin",
        accountId: "ADM-0001",
    };

    // DOM
    const el = (id) => document.getElementById(id);
    const activityTable = el("activityTable"),
        activitySearch = el("activitySearch"),
        activityRole = el("activityRole"),
        activityUser = el("activityUser"),
        activityType = el("activityType"),
        activityFrom = el("activityFrom"),
        activityTo = el("activityTo"),
        activityRefresh = el("activityRefresh"),
        activityExport = el("activityExport"),
        activityModal = el("activityModal"),
        activityDetails = el("activityDetails"),
        closeActivityModal = el("closeActivityModal"),
        activityCloseBtn = el("activityCloseBtn"),
        activityDeleteBtn = el("activityDeleteBtn");

    function load() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            console.warn("Failed to load activity", e);
            return [];
        }
    }
    function save(arr) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(arr));
    }

    let logs = load();

    // seed sample logs if empty (helps demo)
    if (!logs || logs.length === 0) {
        logs = [
            {
                id: "ACT-0001",
                timeISO: "2025-09-13T08:12:00Z",
                userId: 42,
                accountId: "SG-1001",
                name: "John Guard",
                role: "Security Guard",
                type: "Login",
                source: "192.168.1.10",
                details: "Successful login",
            },
            {
                id: "ACT-0002",
                timeISO: "2025-09-13T17:05:00Z",
                userId: 42,
                accountId: "SG-1001",
                name: "John Guard",
                role: "Security Guard",
                type: "Logout",
                source: "192.168.1.10",
                details: "User logged out",
            },
            {
                id: "ACT-0003",
                timeISO: "2025-09-12T09:00:00Z",
                userId: 2,
                accountId: "ADM-0001",
                name: "Alice Admin",
                role: "Admin",
                type: "Password Change Attempt",
                source: "10.0.0.5",
                details: "Changed password successfully",
            },
            {
                id: "ACT-0004",
                timeISO: "2025-09-14T07:11:00Z",
                userId: 99,
                accountId: "CL-2001",
                name: "Client Bob",
                role: "Client",
                type: "Failed Login",
                source: "203.0.113.7",
                details: "Incorrect password attempts: 3",
            },
        ];
        save(logs);
    }

    // helpers
    function pad(n) {
        return String(n).padStart(3, "0");
    }
    function genId() {
        const seq =
            (logs.length
                ? logs.reduce(
                      (m, x) =>
                          Math.max(
                              m,
                              Number((x.id || "").replace(/\D/g, "") || 0)
                          ),
                      0
                  )
                : 0) + 1;
        return "ACT-" + String(seq).padStart(4, "0");
    }
    function fmtDate(iso) {
        if (!iso) return "";
        const d = new Date(iso);
        if (isNaN(d)) return iso;
        return d.toLocaleString();
    }
    function escapeHtml(s) {
        if (!s && s !== 0) return "";
        return String(s).replace(/[&<>"'`=\/]/g, function (ch) {
            return {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;",
                "`": "&#96;",
                "=": "&#61;",
            }[ch];
        });
    }

    // populate user select with unique users present
    function populateUsers() {
        if (!activityUser) return;
        const uniq = {};
        logs.forEach((l) => {
            const key = (l.accountId || "") + "|" + (l.name || "");
            uniq[key] = l;
        });
        const opts = [{ val: "", text: "All Users" }].concat(
            Object.values(uniq).map((u) => ({
                val: u.accountId,
                text: `${u.name} — ${u.accountId}`,
            }))
        );
        activityUser.innerHTML = opts
            .map(
                (o) =>
                    `<option value="${escapeHtml(o.val)}">${escapeHtml(
                        o.text
                    )}</option>`
            )
            .join("");
    }

    function render() {
        if (!activityTable) return;
        activityTable.innerHTML = "";
        const q = (
            (activitySearch && activitySearch.value) ||
            ""
        ).toLowerCase();
        const role = (activityRole && activityRole.value) || "";
        const user = (activityUser && activityUser.value) || "";
        const type = (activityType && activityType.value) || "";
        const from = (activityFrom && activityFrom.value) || "";
        const to = (activityTo && activityTo.value) || "";

        const filtered = logs
            .slice()
            .reverse()
            .filter((l) => {
                if (role && l.role !== role) return false;
                if (user && l.accountId !== user) return false;
                if (type && l.type !== type) return false;
                if (from && l.timeISO && l.timeISO < from + "T00:00:00")
                    return false;
                if (to && l.timeISO && l.timeISO > to + "T23:59:59")
                    return false;
                if (!q) return true;
                const hay =
                    `${l.id} ${l.accountId} ${l.name} ${l.role} ${l.type} ${l.source} ${l.details}`.toLowerCase();
                return hay.includes(q);
            });

        if (filtered.length === 0) {
            activityTable.innerHTML =
                '<tr><td class="py-4 px-3 text-slate-500" colspan="7">No activity logs found.</td></tr>';
            return;
        }

        for (const a of filtered) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
        <td class="py-2 px-3 font-mono text-sm">${escapeHtml(
            fmtDate(a.timeISO)
        )}</td>
        <td class="py-2 px-3">${escapeHtml(
            a.name
        )}<div class="text-xs text-slate-400">${escapeHtml(
                a.accountId
            )}</div></td>
        <td class="py-2 px-3">${escapeHtml(a.role)}</td>
        <td class="py-2 px-3">${escapeHtml(a.type)}</td>
        <td class="py-2 px-3">${escapeHtml(a.source || "")}</td>
        <td class="py-2 px-3 max-w-xl"><div class="truncate" title="${escapeHtml(
            a.details || ""
        )}">${escapeHtml(a.details || "")}</div></td>
        <td class="py-2 px-3">
          <button class="viewActivityBtn text-blue-600 hover:underline" data-id="${escapeHtml(
              a.id
          )}">View</button>
          <button class="delActivityBtn ml-3 text-red-600 hover:underline" data-id="${escapeHtml(
              a.id
          )}">Delete</button>
        </td>`;
            activityTable.appendChild(tr);
        }
    }

    // view modal
    let activeId = null;
    function openModal(id) {
        const log = logs.find((x) => x.id === id);
        if (!log) return alert("Log not found.");
        activeId = id;
        if (!activityDetails) return;
        activityDetails.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><strong>Activity ID:</strong> ${escapeHtml(log.id)}</div>
        <div><strong>Time:</strong> ${escapeHtml(fmtDate(log.timeISO))}</div>
        <div><strong>User:</strong> ${escapeHtml(log.name)} (${escapeHtml(
            log.accountId
        )})</div>
        <div><strong>Role:</strong> ${escapeHtml(log.role)}</div>
        <div><strong>Event Type:</strong> ${escapeHtml(log.type)}</div>
        <div><strong>Source (IP/UA):</strong> ${escapeHtml(
            log.source || ""
        )}</div>
      </div>
      <hr class="my-3" />
      <div><strong>Details:</strong><div class="mt-1 whitespace-pre-wrap text-slate-700">${escapeHtml(
          log.details || ""
      )}</div></div>
    `;
        activityModal.classList.remove("hidden");
    }
    function closeModal() {
        activityModal.classList.add("hidden");
        activeId = null;
    }

    // delete active
    function deleteActive() {
        if (!activeId) return;
        if (!confirm("Delete this activity log?")) return;
        logs = logs.filter((x) => x.id !== activeId);
        save(logs);
        populateUsers();
        render();
        closeModal();
    }

    // export filtered
    function exportFiltered() {
        // reuse render filter logic to produce exported array
        const q = (
            (activitySearch && activitySearch.value) ||
            ""
        ).toLowerCase();
        const role = (activityRole && activityRole.value) || "";
        const user = (activityUser && activityUser.value) || "";
        const type = (activityType && activityType.value) || "";
        const from = (activityFrom && activityFrom.value) || "";
        const to = (activityTo && activityTo.value) || "";

        const filtered = logs
            .slice()
            .reverse()
            .filter((l) => {
                if (role && l.role !== role) return false;
                if (user && l.accountId !== user) return false;
                if (type && l.type !== type) return false;
                if (from && l.timeISO && l.timeISO < from + "T00:00:00")
                    return false;
                if (to && l.timeISO && l.timeISO > to + "T23:59:59")
                    return false;
                if (!q) return true;
                const hay =
                    `${l.id} ${l.accountId} ${l.name} ${l.role} ${l.type} ${l.source} ${l.details}`.toLowerCase();
                return hay.includes(q);
            });

        const blob = new Blob([JSON.stringify(filtered, null, 2)], {
            type: "application/json",
        });
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = `user-activity-${new Date()
            .toISOString()
            .slice(0, 10)}.json`;
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
    }

    // delegation listeners
    document.addEventListener("click", function (e) {
        const t = e.target;
        if (!t) return;
        if (t.matches(".viewActivityBtn")) {
            openModal(t.dataset.id);
        }
        if (t.matches(".delActivityBtn")) {
            const id = t.dataset.id;
            if (!confirm("Delete this activity log?")) return;
            logs = logs.filter((x) => x.id !== id);
            save(logs);
            populateUsers();
            render();
        }
    });

    // modal controls
    if (closeActivityModal)
        closeActivityModal.addEventListener("click", closeModal);
    if (activityCloseBtn)
        activityCloseBtn.addEventListener("click", closeModal);
    if (activityModal)
        activityModal.addEventListener("click", function (e) {
            if (e.target === activityModal) closeModal();
        });
    if (activityDeleteBtn)
        activityDeleteBtn.addEventListener("click", deleteActive);

    // filters
    [
        activitySearch,
        activityRole,
        activityUser,
        activityType,
        activityFrom,
        activityTo,
    ].forEach((elm) => {
        if (!elm) return;
        elm.addEventListener("input", render);
    });
    if (activityRefresh)
        activityRefresh.addEventListener("click", function () {
            logs = load();
            populateUsers();
            render();
        });
    if (activityExport)
        activityExport.addEventListener("click", exportFiltered);

    // initial UI setup
    populateUsers();
    render();

    // public helper to add activity entries (other parts of app can call this)
    window.UserActivity = {
        add: function (payload) {
            // payload minimal shape: { timeISO, userId, accountId, name, role, type, source, details }
            const entry = Object.assign(
                {
                    id: genId(),
                    timeISO: new Date().toISOString(),
                    userId: payload.userId || null,
                    accountId: payload.accountId || "",
                    name: payload.name || "",
                    role: payload.role || "",
                    type: payload.type || "Other",
                    source: payload.source || "",
                    details: payload.details || "",
                },
                payload
            );
            logs.push(entry);
            save(logs);
            populateUsers();
            render();
            return entry;
        },
        all: function () {
            return logs.slice();
        },
    };
})();
