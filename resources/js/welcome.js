// Mobile nav toggle
function toggleMobileNav(force) {
    const nav = document.getElementById("mobileNav");
    const isHidden = nav.classList.contains("hidden");
    const shouldShow = typeof force === "boolean" ? force : isHidden;
    nav.classList.toggle("hidden", !shouldShow);
}

// Modal open/close with focus management
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-login-btn]").forEach((btn) => {
        btn.addEventListener("click", openLogin);
    });

    document.querySelectorAll("[data-mobile-nav-btn]").forEach((btn) => {
        btn.addEventListener("click", toggleMobileNav);
    });

    document.querySelectorAll("[data-close-modal]").forEach((btn) => {
        btn.addEventListener("click", closeLogin);
    });

    document.addEventListener("click", (e) => {
        const modal = document.getElementById("loginModal");
        if (!modal || modal.classList.contains("modal-hidden")) return;
        if (e.target === modal) closeLogin();
    });
});

let lastFocused = null;

function openLogin() {
    lastFocused = document.activeElement;
    const modal = document.getElementById("loginModal");
    modal.classList.remove("modal-hidden");
    modal.setAttribute("aria-hidden", "false");

    const btn = modal.querySelector("button");
    if (btn) btn.focus();

    document.addEventListener("keydown", escToClose);
}

function closeLogin() {
    const modal = document.getElementById("loginModal");
    modal.classList.add("modal-hidden");
    modal.setAttribute("aria-hidden", "true");
    document.removeEventListener("keydown", escToClose);
    if (lastFocused) lastFocused.focus();
}

function escToClose(e) {
    if (e.key === "Escape") closeLogin();
}

/* ===== About Gallery ===== */
(function initAboutGallery() {
    const root = document.getElementById("aboutGallery");
    if (!root) return;

    const slides = Array.from(root.querySelectorAll("[data-slide]"));
    const dots = Array.from(root.querySelectorAll("[data-dot]"));
    const prev = root.querySelector("[data-prev]");
    const next = root.querySelector("[data-next]");
    const total = slides.length;
    let index = 0;
    let timer = null;
    const INTERVAL = 5000; // ms

    function show(i) {
        index = (i + total) % total;
        slides.forEach((el, idx) => {
            const active = idx === index;
            el.classList.toggle("opacity-0", !active);
            el.classList.toggle("pointer-events-none", !active);
            el.setAttribute("aria-hidden", String(!active));
        });
        dots.forEach((d, idx) => {
            const active = idx === index;
            d.classList.toggle("bg-white/90", active);
            d.classList.toggle("bg-white/50", !active);
        });
    }

    function nextSlide() {
        show(index + 1);
    }
    function prevSlide() {
        show(index - 1);
    }

    function start() {
        stop();
        timer = setInterval(nextSlide, INTERVAL);
    }
    function stop() {
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
    }

    // Init
    show(0);
    start();

    // Controls
    next?.addEventListener("click", () => {
        nextSlide();
        start();
    });
    prev?.addEventListener("click", () => {
        prevSlide();
        start();
    });
    dots.forEach((d) =>
        d.addEventListener("click", () => {
            show(+d.dataset.dot);
            start();
        })
    );

    // Pause on hover/focus within
    root.addEventListener("mouseenter", stop);
    root.addEventListener("mouseleave", start);
    root.addEventListener("focusin", stop);
    root.addEventListener("focusout", start);

    // Keyboard
    root.tabIndex = 0; // focusable
    root.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight") {
            nextSlide();
            start();
        }
        if (e.key === "ArrowLeft") {
            prevSlide();
            start();
        }
    });

    // Touch swipe
    let x0 = null;
    root.addEventListener(
        "touchstart",
        (e) => {
            x0 = e.touches[0].clientX;
            stop();
        },
        { passive: true }
    );
    root.addEventListener("touchend", (e) => {
        if (x0 === null) return;
        const dx = e.changedTouches[0].clientX - x0;
        const threshold = 40;
        if (dx > threshold) prevSlide();
        else if (dx < -threshold) nextSlide();
        x0 = null;
        start();
    });
})();

// ==========================
// ✅ Helper Functions
// ==========================
const $ = (s, root = document) => root.querySelector(s);
const $$ = (s, root = document) => Array.from(root.querySelectorAll(s));
const show = (el, on = true) => el?.classList.toggle("hidden", !on);

// ==========================
// ✅ Account Creation Logic
// ==========================
const accountEmail = $("#accountEmail");
const syncEmail = $("#syncEmail");
const personalEmail = $("#email");
const pass1 = $("#accountPassword");
const pass2 = $("#accountPassword2");
const pwBar = $("#pwBar");
const pwLabel = $("#pwLabel");
const togglePassBtn = $("#togglePass");

// --- Password Strength ---
function passwordStrength(pw) {
    if (!pw) return { score: 0, label: "—" };
    const checks = [
        pw.length >= 8,
        /[a-z]/.test(pw),
        /[A-Z]/.test(pw),
        /\d/.test(pw),
        /[^A-Za-z0-9]/.test(pw),
    ];
    let score = checks.filter(Boolean).length;
    if (pw.length >= 12 && score >= 4) score++;
    score = Math.min(4, Math.max(0, score - 1));
    const labels = ["Very weak", "Weak", "Okay", "Good", "Strong"];
    return { score, label: labels[score] };
}

function updatePwUI() {
    const { score, label } = passwordStrength(pass1.value);
    const widths = ["10%", "30%", "55%", "80%", "100%"];
    const colors = ["#ef4444", "#f59e0b", "#facc15", "#10b981", "#059669"];
    pwBar.style.width = widths[score];
    pwBar.style.backgroundColor = colors[score];
    pwLabel.textContent = `Strength: ${label}`;
}

pass1?.addEventListener("input", updatePwUI);
updatePwUI();

// --- Toggle Password ---
togglePassBtn?.addEventListener("click", () => {
    const newType = pass1.type === "password" ? "text" : "password";
    pass1.type = newType;
    pass2.type = newType;
    togglePassBtn.textContent = newType === "password" ? "Show" : "Hide";
});

// --- Sync Email ---
function syncPersonalEmail() {
    if (!personalEmail) return;
    if (syncEmail.checked) {
        personalEmail.value = accountEmail.value;
        personalEmail.readOnly = true;
        personalEmail.classList.add("bg-slate-100");
    } else {
        personalEmail.readOnly = false;
        personalEmail.classList.remove("bg-slate-100");
    }
}

syncEmail?.addEventListener("change", syncPersonalEmail);
accountEmail?.addEventListener("input", () => {
    if (syncEmail.checked) syncPersonalEmail();
});

// ==========================
// ✅ Role Selection Logic
// ==========================
const appTypeRadios = $$('input[name="appType"]');
const guardFields = $("#guardFields");
const staffFields = $("#staffFields");

function setReq(el, isRequired) {
    if (!el) return;
    el.required = isRequired;
    el.setAttribute("aria-required", isRequired ? "true" : "false");
}

function applyRoleUI(role) {
    const isGuard = role === "guard";
    show(guardFields, isGuard);
    show(staffFields, !isGuard);
    setReq($("#licenseNo"), isGuard);
    setReq($("#licenseExpiry"), isGuard);
    setReq($("#licensePdf"), isGuard);
    setReq($("#desiredRole"), !isGuard);
}

appTypeRadios.forEach((r) =>
    r.addEventListener("change", () => applyRoleUI(r.value))
);
applyRoleUI("guard");

// ==========================
// ✅ Repeatable Fields (Work / Education)
// ==========================
const workList = $("#workList");
const eduList = $("#eduList");
const workTpl = $("#workTemplate");
const eduTpl = $("#eduTemplate");
$("#addWork")?.addEventListener("click", () => addWork());
$("#addEdu")?.addEventListener("click", () => addEdu());

function addWork(initial = false) {
    const node = workTpl.content.firstElementChild.cloneNode(true);
    if (!initial) node.querySelector(".removeWork")?.classList.remove("hidden");
    workList.appendChild(node);
}

function addEdu(initial = false) {
    const node = eduTpl.content.firstElementChild.cloneNode(true);
    if (!initial) node.querySelector(".removeEdu")?.classList.remove("hidden");
    eduList.appendChild(node);
}

// Add initial one each
addWork(true);
addEdu(true);

// Delegated removal
workList?.addEventListener("click", (e) => {
    const btn = e.target.closest(".removeWork");
    if (btn && workList.children.length > 1) btn.closest(".work-item").remove();
});

eduList?.addEventListener("click", (e) => {
    const btn = e.target.closest(".removeEdu");
    if (btn && eduList.children.length > 1) btn.closest(".edu-item").remove();
});

// ==========================
// ✅ File Validation
// ==========================
const MAX_MB = 5;
const maxBytes = MAX_MB * 1024 * 1024;

function validatePdf(input) {
    if (!input || !input.files?.[0]) return { ok: true };
    const f = input.files[0];
    if (f.type !== "application/pdf") {
        return {
            ok: false,
            msg: `${input.labels?.[0]?.innerText || "File"} must be a PDF.`,
        };
    }
    if (f.size > maxBytes) {
        return {
            ok: false,
            msg: `${
                input.labels?.[0]?.innerText || "File"
            } exceeds ${MAX_MB} MB.`,
        };
    }
    return { ok: true };
}

// ==========================
// ✅ Alerts
// ==========================
const form = $("#applicationForm");
const alertBox = $("#formAlert");
const confirmationCard = $("#confirmationCard");
const confirmationSummary = $("#confirmationSummary");

function showAlert(msg, type = "error") {
    alertBox.textContent = msg;
    alertBox.className = "";
    alertBox.classList.add("mt-4", "p-4", "rounded-lg", "border", "text-sm");
    alertBox.classList.add(
        type === "error" ? "border-rose-300" : "border-emerald-300",
        type === "error" ? "bg-rose-50" : "bg-emerald-50",
        type === "error" ? "text-rose-800" : "text-emerald-800"
    );
    show(alertBox, true);
    window.scrollTo({ top: 0, behavior: "smooth" });
}

const clearAlert = () => show(alertBox, false);

// ==========================
// ✅ Form Submit Validation
// ==========================
form?.addEventListener("submit", (e) => {
    e.preventDefault();
    clearAlert();

    // Account Email
    if (!accountEmail.value.trim())
        return showAlert("Please enter an Account Email.");
    if (!accountEmail.checkValidity())
        return showAlert("Account Email format looks invalid.");

    // Password
    const p1 = pass1.value,
        p2 = pass2.value;
    if (p1.length < 8)
        return showAlert("Password must be at least 8 characters.");
    const reqs = [
        [/[a-z]/, "a lowercase letter"],
        [/[A-Z]/, "an uppercase letter"],
        [/\d/, "a number"],
        [/[^A-Za-z0-9]/, "a symbol"],
    ]
        .filter(([re]) => !re.test(p1))
        .map(([, msg]) => msg);
    if (reqs.length) return showAlert("Password needs: " + reqs.join(", "));
    if (p1 !== p2) return showAlert("Passwords do not match.");

    // ✅ You can continue your backend submission logic here.
    show(confirmationCard, true);
    form.classList.add("hidden");
    window.scrollTo({ top: 0, behavior: "smooth" });
});
