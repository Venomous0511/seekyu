let messages = [];
let currentViewedMessageId = null;

// --- Messaging Section Logic ---
const messagingSidebarBtn = Array.from(
    document.querySelectorAll("button")
).find((b) =>
    b.getAttribute("onclick")?.includes("showSection('messaging-mgmt')")
);
if (messagingSidebarBtn) {
    messagingSidebarBtn.addEventListener("click", () => {
        showSection("messaging-mgmt", messagingSidebarBtn);
        showInbox();
        loadMessages();
    });
}

// --- UI Elements ---
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
const refreshBtn = document.getElementById("refreshBtn");
const searchInput = document.getElementById("messageSearch");

// --- API Helpers ---
async function apiFetch(url, opts = {}) {
    const res = await fetch(url, {
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        ...opts,
        body: opts.body ? JSON.stringify(opts.body) : undefined,
    });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return res.json();
}

// --- Load Messages ---
async function loadMessages(q = "") {
    const url = "/api/messages" + (q ? "?q=" + encodeURIComponent(q) : "");
    try {
        const data = await apiFetch(url);
        messages = data.data || data;
        renderInbox();
    } catch (err) {
        alert(err.message || "Failed to load messages");
    }
}

// --- Render Inbox Table ---
function renderInbox() {
    messageTable.innerHTML = "";
    for (const msg of messages.slice().reverse()) {
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

// --- Escape HTML ---
function escapeHtml(s) {
    if (!s && s !== 0) return "";
    return String(s).replace(
        /[&<>"'`=\/]/g,
        (ch) =>
            ({
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;",
                "`": "&#96;",
                "=": "&#61;",
            }[ch])
    );
}

// --- Show Inbox/Compose ---
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

// --- Delegated Click Events ---
document.addEventListener("click", (e) => {
    const target = e.target;

    // View message
    if (target.classList.contains("viewBtn")) {
        const id = Number(target.dataset.id);
        viewMessage(id);
    }

    // Delete inline
    if (target.classList.contains("delInlineBtn")) {
        const id = Number(target.dataset.id);
        if (!confirm("Delete this message?")) return;
        messages = messages.filter((m) => m.id !== id);
        if (currentViewedMessageId === id) messagePopup.classList.add("hidden");
        currentViewedMessageId = null;
        renderInbox();
    }
});

// --- View Message Popup ---
function viewMessage(id) {
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

// --- Reply Logic ---
replyBtn?.addEventListener("click", () => {
    if (!currentViewedMessageId) return;
    const msg = messages.find((m) => m.id === currentViewedMessageId);
    if (!msg) return;

    showSection("messaging-mgmt");
    showCompose();

    const recipientInput = document.getElementById("recipient");
    const subjectInput = document.getElementById("subject");
    const bodyTextarea = document.getElementById("message");

    if (recipientInput) recipientInput.value = msg.sender || "";
    if (subjectInput)
        subjectInput.value =
            msg.subject && !/^Re:/i.test(msg.subject)
                ? `Re: ${msg.subject}`
                : msg.subject || "";
    if (bodyTextarea) {
        bodyTextarea.value = `\n\n--- Original Message ---\nFrom: ${msg.sender}\nDate: ${msg.date}\nSubject: ${msg.subject}\n\n${msg.body}`;
        bodyTextarea.focus();
        bodyTextarea.setSelectionRange(0, 0);
    }

    messagePopup.classList.add("hidden");
});

// --- Delete from Popup ---
deleteBtn?.addEventListener("click", () => {
    if (!currentViewedMessageId) return;
    if (!confirm("Delete this message?")) return;
    messages = messages.filter((m) => m.id !== currentViewedMessageId);
    currentViewedMessageId = null;
    messagePopup.classList.add("hidden");
    renderInbox();
});

// --- Close Popup ---
closePopupBtns.forEach((btn) =>
    btn?.addEventListener("click", () => {
        messagePopup.classList.add("hidden");
        currentViewedMessageId = null;
    })
);
messagePopup?.addEventListener("click", (e) => {
    if (e.target === messagePopup) {
        messagePopup.classList.add("hidden");
        currentViewedMessageId = null;
    }
});

// --- Compose Form ---
composeForm?.addEventListener("submit", async (e) => {
    e.preventDefault();
    const recipient = document.getElementById("recipient").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const body = document.getElementById("message").value.trim();
    if (!recipient || !subject || !body) return alert("Please fill out");

    try {
        await apiFetch("/api/messages", {
            method: "POST",
            body: { recipient_name: recipient, subject, body },
        });
        composeForm.reset();
        showInbox();
        await loadMessages();
        alert("Message sent.");
    } catch (err) {
        alert(err.message || "Failed to send message");
    }
});

// --- Refresh & Search ---
refreshBtn?.addEventListener("click", loadMessages);
searchInput?.addEventListener("input", () => {
    const q = searchInput.value.trim().toLowerCase();
    const rows = messageTable.querySelectorAll("tr");
    rows.forEach(
        (r) =>
            (r.style.display = r.textContent.toLowerCase().includes(q)
                ? ""
                : "none")
    );
});

// --- Initial Load ---
showInbox();
loadMessages();
