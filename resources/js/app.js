import "./bootstrap";

// Sidebar functionality
document.addEventListener("DOMContentLoaded", function () {
    // Mobile sidebar toggle
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector("main");

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("-translate-x-full");
        });
    }

    // Initialize sidebar navigation
    initializeSidebar();

    // Show dashboard section by default
    showSection("dashboard");
});

// Initialize sidebar item click handlers
function initializeSidebar() {
    const sidebarItems = document.querySelectorAll(".sidebar-item");

    sidebarItems.forEach((item) => {
        item.addEventListener("click", function () {
            // Remove active class from all items
            sidebarItems.forEach((si) =>
                si.classList.remove("bg-gray-600", "text-white")
            );

            // Add active class to clicked item
            this.classList.add("bg-gray-600", "text-white");

            // Get section name from the span text
            const sectionName = this.querySelector("span")
                .textContent.toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/&/g, "and");

            // Show corresponding section
            showSection(getSectionId(sectionName));
        });
    });
}

// Map sidebar item names to section IDs
function getSectionId(itemName) {
    const sectionMap = {
        dashboard: "dashboard",
        "account-management": "account-management-section",
        messages: "messages",
        notifications: "notifications",
        "users-record": "users-record",
    };

    return sectionMap[itemName] || itemName;
}

// Show specific section and hide others
function showSection(sectionId) {
    // Hide all sections
    const allSections = document.querySelectorAll(".dashboard-section");
    allSections.forEach((section) => {
        section.classList.add("hidden");
    });

    // Show specific section
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.remove("hidden");
    }

    // Handle account management subsections
    if (sectionId === "account-management-section") {
        showAccountSection("create-account");
    }
}

// Account management section navigation
function showAccountSection(subSection) {
    // Hide all account subsections
    const accountSections = [
        "create-account",
        "view-accounts",
        "removed-accounts",
    ];
    accountSections.forEach((section) => {
        const element = document.getElementById(section);
        if (element) {
            element.classList.add("hidden");
        }
    });

    // Show target subsection
    const targetElement = document.getElementById(subSection);
    if (targetElement) {
        targetElement.classList.remove("hidden");
    }
}

// Account management tab switching
document.addEventListener("DOMContentLoaded", function () {
    // Account management tab click handlers
    const accountTabs = document.querySelectorAll('a[href^="#"]');
    accountTabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);

            if (
                [
                    "create-account",
                    "view-accounts",
                    "removed-accounts",
                ].includes(targetId)
            ) {
                showAccountSection(targetId);

                // Update tab appearance
                const parentSection = this.closest("section");
                if (parentSection) {
                    const allTabs =
                        parentSection.querySelectorAll('a[href^="#"]');
                    allTabs.forEach((t) => {
                        t.className = t.className
                            .replace(/bg-(green|blue|red)-300/, "bg-gray-200")
                            .replace(
                                /hover:bg-(green|blue|red)-300/g,
                                function (match, color) {
                                    return `hover:bg-${color}-300`;
                                }
                            );
                    });

                    // Set active tab color
                    if (targetId === "create-account") {
                        this.className = this.className.replace(
                            "bg-gray-200",
                            "bg-green-300"
                        );
                    } else if (targetId === "view-accounts") {
                        this.className = this.className.replace(
                            "bg-gray-200",
                            "bg-blue-300"
                        );
                    } else if (targetId === "removed-accounts") {
                        this.className = this.className.replace(
                            "bg-gray-200",
                            "bg-red-300"
                        );
                    }
                }
            }
        });
    });
});

// Search functionality
function initializeSearch() {
    const searchInputs = document.querySelectorAll('input[name="search"]');
    searchInputs.forEach((input) => {
        input.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const table = this.closest("div").querySelector("table tbody");

            if (table) {
                const rows = table.querySelectorAll("tr");
                rows.forEach((row) => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
        });
    });
}

// Form handling
function initializeForms() {
    const createAccountForm = document.getElementById("create-account");
    if (createAccountForm && createAccountForm.tagName === "FORM") {
        createAccountForm.addEventListener("submit", function (e) {
            e.preventDefault();
            // Handle form submission
            console.log("Creating account...");
            // You can add AJAX call here to submit to Laravel backend
        });
    }

    // Reset button
    const resetButtons = document.querySelectorAll('button[type="button"]');
    resetButtons.forEach((button) => {
        if (button.textContent.trim() === "Reset") {
            button.addEventListener("click", function () {
                const form = this.closest("form");
                if (form) {
                    form.reset();
                }
            });
        }
    });
}

// Initialize all functionality
document.addEventListener("DOMContentLoaded", function () {
    initializeSearch();
    initializeForms();
});

// Global functions for backward compatibility
window.showHomeSection = function (id) {
    showSection(id);
};

window.showSection = showSection;
window.showAccountSection = showAccountSection;
