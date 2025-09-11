// Toast Notification System
export function showToast({
    title = "Success",
    message = "Operation completed",
    type = "success",
    duration = 3000,
}) {
    const toastContainer = document.getElementById("toastContainer");
    if (!toastContainer) return;

    const typeColors = {
        success:
            "text-green-600 border-green-300 bg-white dark:bg-gray-800 dark:border-green-700",
        error: "text-red-600 border-red-300 bg-white dark:bg-gray-800 dark:border-red-700",
        info: "text-blue-600 border-blue-300 bg-white dark:bg-gray-800 dark:border-blue-700",
        warning:
            "text-yellow-600 border-yellow-300 bg-white dark:bg-gray-800 dark:border-yellow-700",
    };

    const toast = document.createElement("div");
    toast.className = `rounded-md border p-4 shadow-sm flex items-start gap-4 ${
        typeColors[type] || typeColors.info
    } transform translate-x-24 opacity-0 transition-all duration-300`;

    toast.innerHTML = `
        <div class="flex-1">
            <strong class="font-medium text-gray-900 dark:text-white">${title}</strong>
            <p class="mt-0.5 text-sm text-gray-700 dark:text-gray-200">${message}</p>
        </div>
        <button class="-m-3 rounded-full p-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" type="button" aria-label="Dismiss alert">
            <span class="sr-only">Dismiss popup</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;

    // Dismiss button
    toast.querySelector("button").addEventListener("click", () => {
        hideToast(toast);
    });

    // Add toast to container (top of stack)
    toastContainer.prepend(toast);

    // Slide-in animation
    requestAnimationFrame(() => {
        toast.classList.remove("translate-x-24", "opacity-0");
        toast.classList.add("translate-x-0", "opacity-100");
    });

    // Auto-remove after duration
    setTimeout(() => {
        hideToast(toast);
    }, duration);
}

// Slide-out animation
function hideToast(toast) {
    toast.classList.add("translate-x-200", "opacity-0");
    toast.addEventListener("transitionend", () => toast.remove(), {
        once: true,
    });
}
