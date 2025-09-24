<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeekYu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="Bulletin-Announce.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-item.active {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar-item.active:hover {
            background-color: #2563eb;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .calendar-grid {
            grid-template-columns: repeat(7, 1fr);
        }

        .day-cell {
            height: 2.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Modal backdrop */
        .modal-backdrop {
            background: rgba(15, 23, 42, 0.6);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <div class="sidebar bg-gray-800 text-white w-64 min-h-screen flex flex-col">
        <!-- Logo & Profile -->
        <div class="p-5 border-b border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-blue-400 text-2xl mr-3"></i>
                    <span class="text-xl font-semibold">SeekYu</span>
                </div>
                <button id="sidebar-toggle" class="text-gray-400 hover:text-white lg:hidden" title="Close sidebar menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Profile block -->
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <img id="profilePic" src="https://i.pravatar.cc/100?img=3" alt="Profile"
                        class="w-14 h-14 rounded-full object-cover border-2 border-gray-700" />
                    <button id="editProfileBtn" title="Edit profile"
                        class="absolute bottom-0 right-0 bg-gray-700 hover:bg-gray-600 p-1 rounded-full text-xs">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>
                <div>
                    <div id="profileName" class="text-sm font-semibold">Miles P. Pirater</div>
                    <div id="profileRole" class="text-xs text-gray-300 mt-1">Head Security Guard</div>
                    <button id="editProfileSmall" class="text-xs text-gray-300 hover:text-white mt-1">Edit
                        profile</button>
                </div>
            </div>

            <!-- hidden file input for changing avatar (kept for quick avatar change in modal too) -->
            <input id="profileFile" type="file" accept="image/*" class="hidden" />
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-1">
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Main Menu</div>

                <button onclick="showSection('dashboard')"
                    class="sidebar-item active w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-home mr-3 text-lg text-blue-400"></i>
                    <span>Dashboard</span>
                </button>

                <button onclick="showSection('recruiting-mgmt')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-user-plus mr-3 text-lg text-green-400"></i>
                    <span>Recruitment Management</span>
                </button>

                <button onclick="showSection('accounts')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-user-cog mr-3 text-lg text-purple-400"></i>
                    <span>Account Management</span>
                </button>

                <button onclick="showSection('client-mgmt')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-users mr-3 text-lg text-yellow-400"></i>
                    <span>Client Management</span>
                </button>

                <button onclick="showSection('guard-mgmt')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-user-shield mr-3 text-lg text-red-400"></i>
                    <span>Security Guard Management</span>
                </button>

                <button onclick="showSection('messaging-mgmt')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i>
                    <span>Send Message</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                </button>
            </div>

            <div class="px-4 space-y-1 mt-8">
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Reports & Analytics
                </div>

                <button onclick="showSection('attendance-monitoring')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-chart-line mr-3 text-lg text-teal-400"></i>
                    <span>Attendance Monitoring</span>
                </button>

                <button onclick="showSection('leave-requests')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-calendar-alt mr-3 text-lg text-pink-400"></i>
                    <span>Leave Requests</span>
                    <span class="ml-auto bg-blue-500 text-white text-xs px-2 py-1 rounded-full">2</span>
                </button>

                <button onclick="showSection('incident-reports')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-exclamation-circle mr-3 text-lg text-orange-400"></i>
                    <span>Incident Reports</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">1</span>
                </button>

                <button onclick="showSection('notification')"
                    class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-bell mr-3 text-lg text-yellow-400"></i>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">1</span>
                </button>
            </div>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-700">
            <form action="/logout" method="post">
                @csrf
                <button
                    class="w-full flex items-center justify-center px-4 py-3 text-gray-200 hover:bg-red-700 hover:text-white rounded-lg bg-red-600 cursor-pointer">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Mobile Header -->
        <div class="bg-white shadow-sm p-4 flex items-center justify-between lg:hidden">
            <button id="mobile-sidebar-toggle" class="text-gray-600 hover:text-gray-900" title="Open sidebar menu">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-semibold">Dashboard</h1>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                    <i class="fas fa-user text-gray-600"></i>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="p-6 flex-1">
            <!-- Dashboard Section -->
            <div id="dashboard" class="content-section active">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Security Guard Management Dashboard</h1>
                    <p class="text-gray-600 mb-6">Welcome to your security management portal. Monitor and manage all
                        security operations from here.</p>

                    <!-- Use grid with main area + right side panel for notifications + calendar -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main content (cards) spans two columns on large screens -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                                            <i class="fas fa-user-shield text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h2 class="text-lg font-semibold text-gray-800">245</h2>
                                            <p class="text-sm text-gray-600">Active Guards</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-lg bg-green-100 text-green-600">
                                            <i class="fas fa-building text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h2 class="text-lg font-semibold text-gray-800">38</h2>
                                            <p class="text-sm text-gray-600">Active Clients</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                                            <i class="fas fa-clipboard-list text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h2 class="text-lg font-semibold text-gray-800">12</h2>
                                            <p class="text-sm text-gray-600">Pending Requests</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                                <!-- Bulletin Board -->
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-xl font-semibold text-gray-800">Bulletin Board</h2>
                                    <!-- Create Announcement button -->
                                    <button id="createBulletinBtn"
                                        class="px-3 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fa fa-plus mr-2"></i>Create Announcement
                                    </button>
                                </div>

                                <div class="relative overflow-hidden">
                                    <div id="bulletinTrack" class="flex gap-4 transition-transform duration-400">
                                        <!-- JS injects bulletin cards here -->
                                    </div>
                                    <div class="absolute left-2 top-1/2 -translate-y-1/2">
                                        <button id="bulletPrev" aria-label="Previous bulletin"
                                            class="p-2 rounded bg-white shadow">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                    </div>
                                    <div class="absolute right-2 top-1/2 -translate-y-1/2">
                                        <button id="bulletNext" aria-label="Next bulletin"
                                            class="p-2 rounded bg-white shadow">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Create/Edit Bulletin Modal (fixed + correctly centered + scrollable) -->
                                <div id="createBulletinModal"
                                    class="fixed inset-0 hidden items-center justify-center z-50">
                                    <div class="absolute inset-0 bg-black/50"></div>
                                    <div
                                        class="relative bg-white w-full max-w-xl mx-4 rounded-lg shadow-xl overflow-hidden z-10 max-h-[90vh]">
                                        <div class="p-4 border-b flex items-center justify-between">
                                            <h3 id="modalTitleText" class="text-lg font-semibold">Create Announcement
                                            </h3>
                                            <button id="closeBulletinModal"
                                                class="text-gray-500 hover:text-gray-700"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                        <div class="p-6 overflow-y-auto" style="max-height: calc(90vh - 4rem);">
                                            <form id="bulletinForm" class="space-y-4">
                                                <div>
                                                    <label class="text-xs font-medium text-gray-600">Title *</label>
                                                    <input name="title" required
                                                        class="w-full mt-1 px-3 py-2 border rounded bg-gray-50" />
                                                </div>

                                                <div>
                                                    <label class="text-xs font-medium text-gray-600">Body *</label>
                                                    <textarea name="body" rows="4" required class="w-full mt-1 px-3 py-2 border rounded bg-gray-50"></textarea>
                                                </div>

                                                <div>
                                                    <label class="text-xs font-medium text-gray-600">Image
                                                        (optional)</label>
                                                    <div class="mt-2 flex items-start gap-3">
                                                        <div>
                                                            <img id="modalImagePreview" src="" alt="preview"
                                                                class="w-28 h-20 object-cover rounded border bg-gray-100 hidden" />
                                                        </div>
                                                        <div class="flex-1">
                                                            <input id="bulletinImageFile" type="file"
                                                                accept="image/*" class="block mb-2" />
                                                            <div class="flex items-center gap-3">
                                                                <button type="button" id="removeImageBtn"
                                                                    class="text-xs px-3 py-1 rounded bg-red-100 text-red-700 hidden">Remove
                                                                    image</button>
                                                                <div class="text-xs text-gray-500">Allowed: jpg/png.
                                                                    Small images recommended.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center justify-end space-x-3 pt-2 border-t">
                                                    <button type="button" id="cancelBulletin"
                                                        class="px-4 py-2 rounded border">Cancel</button>
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded bg-indigo-600 text-white">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Recent Activity -->
                                <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-6">Recent Activity</h2>
                                <div class="border-t border-gray-100 pt-4">
                                    <div class="flex items-start mb-4">
                                        <div class="bg-blue-100 p-2 rounded-full">
                                            <i class="fas fa-user-plus text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-gray-800"><span class="font-medium">John Doe</span>
                                                registered as a new security guard</p>
                                            <p class="text-sm text-gray-500">2 hours ago</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start mb-4">
                                        <div class="bg-green-100 p-2 rounded-full">
                                            <i class="fas fa-check-circle text-green-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-gray-800">Shift <span class="font-medium">#3245</span> was
                                                completed successfully</p>
                                            <p class="text-sm text-gray-500">5 hours ago</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="bg-red-100 p-2 rounded-full">
                                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-gray-800">New incident report submitted for Client #3829</p>
                                            <p class="text-sm text-gray-500">Yesterday at 5:30 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side panel: Notifications + Calendar -->
                        <aside class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Notifications</h3>
                            <ul id="notifList" class="space-y-2 max-h-40 overflow-y-auto mb-4">
                                <!-- sample notifications -->
                                <li class="p-3 rounded-lg bg-gray-50 border border-gray-100">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="text-sm font-medium text-gray-800">Holiday Notice</div>
                                            <div class="text-xs text-gray-500">Office closed on Sept 25 for local
                                                holiday.</div>
                                        </div>
                                        <div class="text-xs text-gray-400 ml-3">2d</div>
                                    </div>
                                </li>
                                <li class="p-3 rounded-lg bg-gray-50 border border-gray-100">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="text-sm font-medium text-gray-800">New Leave Request</div>
                                            <div class="text-xs text-gray-500">John D. submitted a leave request.</div>
                                        </div>
                                        <div class="text-xs text-gray-400 ml-3">1d</div>
                                    </div>
                                </li>
                                <li class="p-3 rounded-lg bg-gray-50 border border-gray-100">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="text-sm font-medium text-gray-800">Incident Report</div>
                                            <div class="text-xs text-gray-500">Incident #234 requires review.</div>
                                        </div>
                                        <div class="text-xs text-gray-400 ml-3">3h</div>
                                    </div>
                                </li>
                            </ul>

                            <!-- Calendar -->
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm font-semibold" id="calendarMonth">Month Year</div>
                                    <div class="flex items-center space-x-2">
                                        <button id="prevMonth" class="p-2 rounded hover:bg-gray-100"><i
                                                class="fas fa-chevron-left"></i></button>
                                        <button id="nextMonth" class="p-2 rounded hover:bg-gray-100"><i
                                                class="fas fa-chevron-right"></i></button>
                                    </div>
                                </div>

                                <div class="grid calendar-grid gap-1 text-xs text-gray-600 mb-2">
                                    <div class="text-center font-medium">Sun</div>
                                    <div class="text-center font-medium">Mon</div>
                                    <div class="text-center font-medium">Tue</div>
                                    <div class="text-center font-medium">Wed</div>
                                    <div class="text-center font-medium">Thu</div>
                                    <div class="text-center font-medium">Fri</div>
                                    <div class="text-center font-medium">Sat</div>
                                </div>

                                <div id="calendarDays" class="grid calendar-grid gap-1 text-sm text-gray-700"></div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>


            <!-- Other Sections (initially hidden) -->
            <div id="recruiting-mgmt" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Recruitment Management</h1>
                    <p class="text-gray-600">Manage security guard recruitment, applications, and hiring processes.</p>

                </div>
            </div>

            <!-- ACCOUNTS MANAGEMENT - Replace existing #accounts block with this -->
            <div id="accounts" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Account Management</h1>
                        <div class="flex gap-2">
                            <button id="accountsTabCreate"
                                class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">Create Account</button>
                            <button id="accountsTabView"
                                class="px-3 py-2 rounded bg-slate-200 text-gray-800 text-sm">View Accounts</button>
                            <button id="accountsTabRemoved"
                                class="px-3 py-2 rounded bg-slate-200 text-gray-800 text-sm">Removed Accounts</button>
                        </div>
                    </div>

                    <!-- Create Account -->
                    <div id="create-account-section" class="">
                        <form id="createAccountForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-slate-600">Full Name</label>
                                <input id="fullName" class="w-full px-3 py-2 rounded border bg-slate-50" required />
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Username</label>
                                <input id="username" class="w-full px-3 py-2 rounded border bg-slate-50" required />
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Role</label>
                                <select id="role" class="w-full px-3 py-2 rounded border bg-slate-50" required>
                                    <option value="">Select role</option>
                                    <option>Admin</option>
                                    <option>HR</option>
                                    <option>Security Guard</option>
                                    <option>Head Guard</option>
                                    <option>Client</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Password</label>
                                <input id="password" type="password"
                                    class="w-full px-3 py-2 rounded border bg-slate-50" required />
                            </div>

                            <div class="md:col-span-2 flex gap-2 mt-2">
                                <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white">Create
                                    Account</button>
                                <button type="button" id="resetCreate"
                                    class="px-4 py-2 rounded bg-slate-200">Reset</button>
                            </div>
                        </form>
                    </div>

                    <!-- View Accounts -->
                    <div id="view-accounts-section" class="hidden mt-6">
                        <div class="flex items-center gap-3 mb-4">
                            <input id="accountsSearch" placeholder="Search by name, username or role..."
                                class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                            <button id="refreshAccounts"
                                class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
                        </div>

                        <div class="overflow-x-auto bg-white rounded border">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 text-left text-slate-600">
                                    <tr>
                                        <th class="py-3 px-3">Name</th>
                                        <th class="py-3 px-3">Username</th>
                                        <th class="py-3 px-3">Role</th>
                                        <th class="py-3 px-3">Created</th>
                                        <th class="py-3 px-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="accountsTable" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Removed Accounts -->
                    <div id="removed-accounts-section" class="hidden mt-6">
                        <div class="flex items-center gap-3 mb-4">
                            <input id="removedSearch" placeholder="Search removed accounts..."
                                class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                        </div>

                        <div class="overflow-x-auto bg-white rounded border">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 text-left text-slate-600">
                                    <tr>
                                        <th class="py-3 px-3">Login ID</th>
                                        <th class="py-3 px-3">Name</th>
                                        <th class="py-3 px-3">Username</th>
                                        <th class="py-3 px-3">Role</th>
                                        <th class="py-3 px-3">Created</th>
                                        <th class="py-3 px-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="removedAccountsTable" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Edit Account Modal -->
                <div id="editAccountModal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                    <div class="bg-white rounded-lg max-w-lg w-full p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold">Edit Account</h3>
                            <button id="closeEditModal" class="text-slate-500">✕</button>
                        </div>

                        <form id="editAccountForm" class="space-y-3">
                            <input type="hidden" id="editId" />
                            <div>
                                <label class="block text-sm text-slate-600">Full Name</label>
                                <input id="editFullName" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Username</label>
                                <input id="editUsername" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Role</label>
                                <select id="editRole" class="w-full px-3 py-2 rounded border bg-slate-50">
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                    <option>HR</option>
                                    <option>Security Guard</option>
                                    <option>Head Guard</option>
                                    <option>Client</option>
                                </select>
                            </div>

                            <div class="flex justify-end gap-2 mt-3">
                                <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Save
                                    Changes</button>
                                <button type="button" id="cancelEdit"
                                    class="px-4 py-2 rounded bg-slate-200">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Modal -->
                <div id="changePasswordModal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                    <div class="bg-white rounded-lg max-w-md w-full p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold">Change Password</h3>
                            <button id="closePassModal" class="text-slate-500">✕</button>
                        </div>

                        <form id="changePasswordForm" class="space-y-3">
                            <input type="hidden" id="passUserId" />
                            <div>
                                <label class="block text-sm text-slate-600">New Password</label>
                                <input id="newPassword" type="password"
                                    class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div>
                                <label class="block text-sm text-slate-600">Confirm Password</label>
                                <input id="confirmNewPassword" type="password"
                                    class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>

                            <div class="flex justify-end gap-2 mt-3">
                                <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white">Change
                                    Password</button>
                                <button type="button" id="cancelPass"
                                    class="px-4 py-2 rounded bg-slate-200">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Messaging Section -->
            <div id="messaging-mgmt" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Messaging Management</h1>

                    <!-- Sub-navigation -->
                    <div class="mt-4">
                        <div class="flex gap-2 mb-4">
                            <button id="inboxBtn"
                                class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">Inbox</button>
                            <button id="composeBtn"
                                class="px-3 py-2 rounded bg-slate-200 text-gray-800 text-sm">Compose</button>
                        </div>

                        <!-- Inbox Section -->
                        <div id="inbox-section" class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center gap-3 mb-4">
                                <input type="text" id="messageSearch" placeholder="Search messages..."
                                    class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                                <button id="refreshBtn" class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="text-left text-slate-500">
                                        <tr>
                                            <th class="py-2">Sender</th>
                                            <th class="py-2">Subject</th>
                                            <th class="py-2">Date</th>
                                            <th class="py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="messageTable" class="divide-y">
                                        <!-- Example row -->
                                        <tr>
                                            <td class="py-2">Admin</td>
                                            <td class="py-2">Welcome to SeekYu</td>
                                            <td class="py-2">2025-09-13</td>
                                            <td class="py-2">
                                                <button class="viewBtn text-blue-600 hover:underline"
                                                    data-sender="Admin" data-recipient="You"
                                                    data-subject="Welcome to SeekYu" data-date="2025-09-13"
                                                    data-body="This is a sample welcome message.">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Compose Section -->
                        <div id="compose-section" class="hidden bg-white rounded-lg shadow-sm p-4 mt-4">
                            <form id="composeForm" class="space-y-3">
                                <div>
                                    <label class="block text-sm text-slate-600">To:</label>
                                    <input type="text" id="recipient" name="recipient" required
                                        class="w-full px-3 py-2 rounded border bg-slate-50" />
                                </div>

                                <div>
                                    <label class="block text-sm text-slate-600">Subject:</label>
                                    <input type="text" id="subject" name="subject" required
                                        class="w-full px-3 py-2 rounded border bg-slate-50" />
                                </div>

                                <div>
                                    <label class="block text-sm text-slate-600">Message:</label>
                                    <textarea id="message" name="message" rows="5" required class="w-full px-3 py-2 rounded border bg-slate-50"></textarea>
                                </div>

                                <div class="flex gap-2">
                                    <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Send
                                        Message</button>
                                    <button type="button" id="cancelCompose"
                                        class="px-4 py-2 rounded bg-slate-200">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup for Viewing Message -->
            <div id="message-popup"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-lg max-w-lg w-full p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h2 class="text-lg font-semibold">Message Details</h2>
                        <button id="closePopup" class="text-slate-500 hover:text-slate-800">✕</button>
                    </div>

                    <p class="text-sm"><strong>From:</strong> <span id="popupSender">-</span></p>
                    <p class="text-sm"><strong>To:</strong> <span id="popupRecipient">-</span></p>
                    <p class="text-sm"><strong>Subject:</strong> <span id="popupSubject">-</span></p>
                    <p class="text-sm"><strong>Date:</strong> <span id="popupDate">-</span></p>

                    <div class="mt-3">
                        <p id="popupBody" class="whitespace-pre-wrap text-sm text-slate-700"></p>
                    </div>

                    <div class="mt-4 flex gap-2 justify-end">
                        <button id="replyBtn" class="px-3 py-2 rounded bg-emerald-600 text-white">Reply</button>
                        <button id="deleteBtn" class="px-3 py-2 rounded bg-red-600 text-white">Delete</button>
                        <button id="closePopup2" class="px-3 py-2 rounded bg-slate-200">Close</button>
                    </div>
                </div>
            </div>

            <!--Client Management-->
            <div id="client-mgmt" class="content-section section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Client Management</h1>
                            <p class="text-gray-600">Oversee client requests and deployed personnel. Client records are
                                created automatically when a user account with role <strong>Client</strong> is created.
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <!-- Add button removed: clients come from account creation -->
                            <input id="client_search" placeholder="Search clients..."
                                class="px-3 py-2 rounded border bg-slate-50 text-sm" />
                        </div>
                    </div>

                    <!-- slimmer table: only summary columns (details shown in View modal) -->
                    <!-- Slim table header (same place as before in client-mgmt section) -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm border-collapse">
                            <thead class="bg-slate-50 text-left text-slate-600">
                                <tr>
                                    <th class="py-3 px-3">#</th>
                                    <th class="py-3 px-3">Client Name</th>
                                    <th class="py-3 px-3">Company</th>
                                    <th class="py-3 px-3">Contact</th>
                                    <th class="py-3 px-3">Location</th>
                                    <th class="py-3 px-3"># Guards</th>
                                    <th class="py-3 px-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="client_clientsTable" class="divide-y bg-white"></tbody>
                        </table>
                    </div>
                </div>

                <!-- View Profile Modal (shows all client fields) -->
                <div id="client_viewClientModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
                    <div class="bg-white rounded-lg max-w-2xl w-full p-5">
                        <div class="flex items-start justify-between mb-3">
                            <h2 class="text-lg font-semibold">Client Profile</h2>
                            <button id="client_closeView" class="text-slate-500">✕</button>
                        </div>
                        <div id="client_viewClientBody" class="text-sm text-slate-700 space-y-2"></div>
                        <div class="mt-4 flex justify-end gap-2">
                            <button id="client_viewAssignBtn"
                                class="px-3 py-2 rounded bg-indigo-600 text-white">Assign / Manage Personnel</button>
                            <button id="client_closeView2" class="px-3 py-2 rounded bg-slate-200">Close</button>
                        </div>
                    </div>
                </div>

                <!-- Edit Client Modal -->
                <div id="client_editClientModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
                    <div class="bg-white rounded-lg max-w-md w-full p-5">
                        <div class="flex items-start justify-between mb-3">
                            <h2 class="text-lg font-semibold">Edit Client</h2>
                            <button id="client_closeEdit" class="text-slate-500">✕</button>
                        </div>
                        <form id="client_editClientForm" class="space-y-3">
                            <input type="hidden" id="client_editClientId" />
                            <div><label class="block text-sm text-slate-600">Contact Name</label><input
                                    id="client_editContactName" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div><label class="block text-sm text-slate-600">Company Name</label><input
                                    id="client_editCompany" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div><label class="block text-sm text-slate-600">Email</label><input id="client_editEmail"
                                    class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                            <div><label class="block text-sm text-slate-600">Phone</label><input id="client_editPhone"
                                    class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                            <div><label class="block text-sm text-slate-600">Job Title / Requested Role</label><input
                                    id="client_editJobTitle" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>
                            <div><label class="block text-sm text-slate-600">Location</label><input
                                    id="client_editLocation" class="w-full px-3 py-2 rounded border bg-slate-50" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div><label class="block text-sm text-slate-600">Number of Guards</label><input
                                        id="client_editNumGuards" type="number" min="0"
                                        class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                                <div><label class="block text-sm text-slate-600">Shift Schedule</label><input
                                        id="client_editShift" class="w-full px-3 py-2 rounded border bg-slate-50" />
                                </div>
                                <div><label class="block text-sm text-slate-600">License Requirement</label><input
                                        id="client_editLicense" class="w-full px-3 py-2 rounded border bg-slate-50" />
                                </div>
                                <div><label class="block text-sm text-slate-600">Experience Required
                                        (yrs)</label><input id="client_editExperience" type="number" min="0"
                                        step="1" class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                                <div><label class="block text-sm text-slate-600">Salary Offer (PHP)</label><input
                                        id="client_editSalary" type="number" min="0"
                                        class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                                <div><label class="block text-sm text-slate-600">Contract Duration</label><input
                                        id="client_editDuration"
                                        class="w-full px-3 py-2 rounded border bg-slate-50" /></div>
                            </div>

                            <div class="flex justify-end gap-2 mt-3">
                                <button type="submit"
                                    class="px-4 py-2 rounded bg-emerald-600 text-white">Save</button>
                                <button type="button" id="client_cancelEditForm"
                                    class="px-4 py-2 rounded bg-slate-200">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assign / Remove Personnel Modal -->
                <div id="client_assignModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
                    <div class="bg-white rounded-lg max-w-3xl w-full p-5">
                        <div class="flex items-start justify-between mb-3">
                            <h2 class="text-lg font-semibold">Assign / Remove Personnel</h2>
                            <button id="client_closeAssign" class="text-slate-500">✕</button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-slate-700">Deployed Personnel</h3>
                                <div id="client_deployedList"
                                    class="mt-2 space-y-2 max-h-64 overflow-auto border rounded p-2 bg-slate-50"></div>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-slate-700">Available Guards</h3>
                                <div id="client_availableList"
                                    class="mt-2 space-y-2 max-h-64 overflow-auto border rounded p-2 bg-white"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <div class="text-xs text-slate-500">Select guards and click Assign. To remove, click the
                                trash on deployed items.</div>
                            <div class="flex gap-2">
                                <button id="client_assignSelected"
                                    class="px-3 py-2 rounded bg-indigo-600 text-white">Assign Selected</button>
                                <button id="client_closeAssign2" class="px-3 py-2 rounded bg-slate-200">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guard Management (replace existing #guard-mgmt) -->
            <div id="guard-mgmt" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Security Guard Management</h1>
                            <p class="text-gray-600">List of guards. Click <strong>View</strong> to open the guard
                                profile page (edit, KPI, attendance).</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <input id="guard_search" placeholder="Search guards by name, role, client..."
                                class="px-3 py-2 rounded border bg-slate-50 text-sm" />
                            <button id="guard_refresh"
                                class="px-3 py-2 rounded bg-slate-100 border text-sm">Refresh</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-50 text-left text-slate-600">
                                <tr>
                                    <th class="py-3 px-3">#</th>
                                    <th class="py-3 px-3">Name</th>
                                    <th class="py-3 px-3">Position</th>
                                    <th class="py-3 px-3">Client</th>
                                    <th class="py-3 px-3">Shift</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="guard_table" class="divide-y bg-white"></tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div id="kpi" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">KPI Evaluation</h1>
                    <p class="text-gray-600">Analyze key performance indicators for security operations.</p>
                </div>
            </div>

            <!-- Leave Requests (Higher-ups view) - role-aware with working Approve/Reject -->
            <div id="leave-requests" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Leave Requests (Admin)</h1>
                            <p class="text-gray-600">Review and manage leave requests submitted by users.</p>
                        </div>

                        <!-- DEMO: role / user switcher (replace with real session UI) -->
                        <div class="flex items-center gap-3">
                            <label class="text-sm text-slate-600">Act as:</label>
                            <select id="demoUserSelect" class="px-3 py-2 rounded border bg-slate-50 text-sm">
                                <!-- options populated by JS -->
                            </select>
                            <button id="exportAllLeaves" class="px-3 py-2 rounded bg-slate-100 border text-sm">Export
                                All (JSON)</button>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex gap-3 items-center mb-4">
                        <input id="adminLeaveSearch" placeholder="Search ID, name, type, reason..."
                            class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                        <select id="adminFilterStatus" class="px-3 py-2 rounded border bg-slate-50">
                            <option value="">All Status</option>
                            <option>Pending</option>
                            <option>Approved</option>
                            <option>Rejected</option>
                        </select>
                        <input id="adminFilterFrom" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                        <input id="adminFilterTo" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                        <button id="adminRefresh" class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto bg-white rounded border">
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-50 text-left text-slate-600">
                                <tr>
                                    <th class="py-3 px-3">Request ID</th>
                                    <th class="py-3 px-3">Name</th>
                                    <th class="py-3 px-3">Role</th>
                                    <th class="py-3 px-3">Range</th>
                                    <th class="py-3 px-3">Type</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3">Submitted</th>
                                    <th class="py-3 px-3">Approver / Remarks</th>
                                    <th class="py-3 px-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminLeaveTable" class="divide-y"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Admin modal: view + action -->
            <div id="adminLeaveModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-lg max-w-2xl w-full p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h2 class="text-lg font-semibold">Leave Request Details</h2>
                        <button id="closeAdminLeaveModal" class="text-slate-500">✕</button>
                    </div>

                    <div id="adminLeaveDetails" class="text-sm text-slate-700 space-y-2"></div>

                    <hr class="my-3" />

                    <div id="adminActionArea" class="space-y-3">
                        <label class="block text-sm text-slate-600">Approver Remarks (required to
                            Approve/Reject)</label>
                        <textarea id="adminRemarks" rows="3" class="w-full px-3 py-2 rounded border bg-slate-50"></textarea>

                        <div class="flex justify-end gap-2">
                            <button id="adminRejectBtn"
                                class="px-3 py-2 rounded bg-red-600 text-white">Reject</button>
                            <button id="adminApproveBtn"
                                class="px-3 py-2 rounded bg-emerald-600 text-white">Approve</button>
                            <button id="adminCloseBtn" class="px-3 py-2 rounded bg-slate-200">Close</button>
                        </div>
                    </div>

                    <div class="mt-3 text-xs text-slate-500">
                        <em>Note: Only users with roles <strong>Admin</strong>, <strong>Manager</strong> or
                            <strong>HR</strong> can Approve/Reject.</em>
                    </div>
                </div>
            </div>

            <!-- INCIDENT REPORTS - VIEW ONLY -->
            <div id="incident-reports" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Incident Reports</h1>
                        <div class="flex gap-2">
                            <button id="irTabViewOnly" class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">View
                                Reports</button>
                        </div>
                    </div>

                    <!-- View Reports (only) -->
                    <div id="ir-view-only-section" class="mt-0">
                        <div class="flex items-center gap-3 mb-4">
                            <input id="reportsSearch" placeholder="Search by reporter, ID, location, subject..."
                                class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                            <select id="filterRole" class="px-3 py-2 rounded border bg-slate-50">
                                <option value="">All Roles</option>
                                <option>Security Guard</option>
                                <option>Head Guard</option>
                            </select>
                            <select id="filterType" class="px-3 py-2 rounded border bg-slate-50">
                                <option value="">All Types</option>
                                <option>Trespassing</option>
                                <option>Theft / Burglary</option>
                                <option>Vandalism</option>
                                <option>Fire / Smoke</option>
                                <option>Assault</option>
                                <option>Safety Hazard</option>
                                <option>False Fire Alarm</option>
                                <option>Accident</option>
                                <option>Other</option>
                            </select>
                            <input id="filterFrom" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                            <input id="filterTo" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                            <button id="refreshReports" class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
                        </div>

                        <div class="overflow-x-auto bg-white rounded border">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 text-left text-slate-600">
                                    <tr>
                                        <th class="py-3 px-3">Report ID</th>
                                        <th class="py-3 px-3">Date</th>
                                        <th class="py-3 px-3">Reporter</th>
                                        <th class="py-3 px-3">Role</th>
                                        <th class="py-3 px-3">Type</th>
                                        <th class="py-3 px-3">Location</th>
                                        <th class="py-3 px-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="reportsTable" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Details Modal (view-only) -->
            <div id="reportModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-lg max-w-3xl w-full p-5 overflow-y-auto max-h-[90vh]">
                    <div class="flex items-start justify-between mb-3">
                        <h2 class="text-lg font-semibold">Incident Report Details</h2>
                        <button id="closeReportModal" class="text-slate-500">✕</button>
                    </div>
                    <div id="reportDetails" class="space-y-2 text-sm text-slate-700"></div>
                    <div class="mt-4 flex justify-end gap-2">
                        <button id="exportReportBtn" class="px-3 py-2 rounded bg-blue-600 text-white">Export
                            (JSON)</button>
                        <button id="closeReportModal2" class="px-3 py-2 rounded bg-slate-200">Close</button>
                    </div>
                </div>
            </div>

            <!--Notification Section-->
            <div id="notification" class="content-section">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Notifications</h1>
                    <p class="text-gray-600">Manage system notifications and alerts.</p>
                </div>
            </div>
            <!-- Add other sections similarly -->

        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup-modal"
        class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800" id="popup-title">Popup Title</h3>
                <p class="text-gray-600 mt-2" id="popup-content">This is the popup content. You can put any
                    information here.</p>
            </div>
            <div class="flex justify-end p-6 border-t border-gray-200">
                <button id="close-popup"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Close</button>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal (simplified: full name, email, phone, avatar) -->
    <div id="editProfileModal" class="fixed inset-0 hidden items-center justify-center z-50">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="relative bg-white w-full max-w-2xl mx-4 rounded-lg shadow-xl overflow-hidden">
            <div class="p-4 border-b flex items-center justify-between">
                <h3 class="text-lg font-semibold">Edit Profile (HR)</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700"><i
                        class="fas fa-times"></i></button>
            </div>
            <div class="p-6">
                <form id="profileForm" class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img id="modalAvatar" src="https://i.pravatar.cc/100?img=3"
                                class="w-20 h-20 rounded-full object-cover border" alt="avatar" />
                            <div class="mt-2">
                                <input id="modalFile" type="file" accept="image/*" class="hidden" />
                                <button type="button" id="changeAvatarBtn"
                                    class="text-xs px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 mt-2"><i
                                        class="fas fa-image mr-1"></i> Change</button>
                            </div>
                        </div>

                        <div class="flex-1 grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <label class="text-xs font-medium text-gray-600">Full name *</label>
                                <input id="inputFullName" required
                                    class="w-full mt-1 px-3 py-2 border rounded bg-gray-50" />
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-600">Email *</label>
                                <input id="inputEmail" type="email" required
                                    class="w-full mt-1 px-3 py-2 border rounded bg-gray-50" />
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-600">Phone</label>
                                <input id="inputPhone" class="w-full mt-1 px-3 py-2 border rounded bg-gray-50" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-2 border-t">
                        <button type="button" id="cancelProfile" class="px-4 py-2 rounded border">Cancel</button>
                        <button type="submit" id="saveProfile" class="px-4 py-2 rounded bg-blue-600 text-white">Save
                            Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Replace your existing <script>
        ...
    </script> with this block -->
    <script>
        // Security Guard Section
        (function() {
            // Guard Management script (scoped)
            const key = 'seekyu_guards';
            const table = document.getElementById('guard_table');
            const search = document.getElementById('guard_search');
            const refresh = document.getElementById('guard_refresh');

            const demo = [{
                    id: 1001,
                    name: 'Juan Santos',
                    role: 'Security Guard',
                    client: 'Mall One',
                    shift: 'Day',
                    status: 'Active',
                    phone: '09171230011',
                    email: 'juan.santos@example.com'
                },
                {
                    id: 1002,
                    name: 'Miguel Lopez',
                    role: 'Head Guard',
                    client: 'Office Tower',
                    shift: 'Night',
                    status: 'Active',
                    phone: '09171230012',
                    email: 'miguel.lopez@example.com'
                },
                {
                    id: 1003,
                    name: 'Pedro Reyes',
                    role: 'Security Guard',
                    client: 'Shopping Plaza',
                    shift: 'Rotating',
                    status: 'Inactive',
                    phone: '09171230013',
                    email: 'pedro.reyes@example.com'
                }
            ];

            function load() {
                try {
                    const raw = localStorage.getItem(key);
                    if (raw) return JSON.parse(raw);
                } catch (e) {
                    console.warn(e);
                }
                // save demo if fresh
                localStorage.setItem(key, JSON.stringify(demo));
                return JSON.parse(JSON.stringify(demo));
            }

            function save(arr) {
                localStorage.setItem(key, JSON.stringify(arr));
            }

            let guards = load();

            function render(q = '') {
                table.innerHTML = '';
                const term = (q || '').toLowerCase().trim();
                const rows = guards.filter(g => {
                    if (!term) return true;
                    const hay = `${g.name} ${g.role} ${g.client} ${g.shift} ${g.status}`.toLowerCase();
                    return hay.includes(term);
                });
                if (rows.length === 0) {
                    table.innerHTML = '<tr><td class="py-4 px-3 text-slate-500" colspan="7">No guards found.</td></tr>';
                    return;
                }
                rows.forEach((g, i) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
        <td class="py-3 px-3">${i+1}</td>
        <td class="py-3 px-3 font-medium">${escapeHtml(g.name)}</td>
        <td class="py-3 px-3">${escapeHtml(g.role)}</td>
        <td class="py-3 px-3">${escapeHtml(g.client || '')}</td>
        <td class="py-3 px-3">${escapeHtml(g.shift || '')}</td>
        <td class="py-3 px-3">${escapeHtml(g.status)}</td>
        <td class="py-3 px-3">
          <div class="flex gap-2">
            <a href="guard-profile.html?id=${encodeURIComponent(g.id)}" class="px-3 py-1 rounded bg-slate-100 text-slate-700 text-sm">View</a>
            <button data-id="${g.id}" class="toggleStatusBtn px-3 py-1 rounded text-sm ${g.status==='Active' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-700'}">${g.status==='Active' ? 'Set Inactive' : 'Set Active'}</button>
          </div>
        </td>
      `;
                    table.appendChild(tr);
                });

                // wire toggle buttons
                Array.from(document.querySelectorAll('.toggleStatusBtn')).forEach(btn => {
                    btn.onclick = function() {
                        const id = Number(this.dataset.id);
                        const idx = guards.findIndex(x => x.id === id);
                        if (idx === -1) return alert('Guard not found');
                        guards[idx].status = guards[idx].status === 'Active' ? 'Inactive' : 'Active';
                        save(guards);
                        render(search.value);
                    };
                });
            }

            function escapeHtml(s) {
                if (s === 0 || s) return String(s).replace(/[&<>"'`=\/]/g, ch => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#47;',
                '`': '&#96;',
                    '=': '&#61;'
                })[ch]);
                return '';
            }

            // Search and refresh
            search.addEventListener('input', () => render(search.value));
            refresh.addEventListener('click', () => {
                guards = load();
                render(search.value);
            });

            // init
            render();
            // expose small API
            window.GuardManagement = {
                list: () => guards.slice(),
                refresh: () => {
                    guards = load();
                    render(search.value);
                }
            };
        })();

        // ------- Sidebar toggle and section switching -------
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar mobile toggle (kept similar to your original)
            const mobileToggle = document.getElementById('mobile-sidebar-toggle');
            mobileToggle?.addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.toggle('-ml-64');
                sidebar.classList.toggle('ml-0');
                const toggleIcon = document.querySelector('#sidebar-toggle i');
                if (sidebar.classList.contains('-ml-64')) {
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-bars');
                } else {
                    toggleIcon.classList.remove('fa-bars');
                    toggleIcon.classList.add('fa-times');
                }
            });

            // --- Section switching (keeps your showSection logic but safer) ---
            window.showSection = function(sectionId, clickedBtn = null) {
                document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));

                const target = document.getElementById(sectionId);
                if (target) target.classList.add('active');

                // mark button active if provided
                if (clickedBtn) clickedBtn.classList.add('active');

                if (window.innerWidth < 1024) {
                    document.querySelector('.sidebar')?.classList.add('-ml-64');
                    const icon = document.querySelector('#sidebar-toggle i');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            };
        });

        // If sidebar buttons use inline onclick (your layout), ensure the Messaging button opens inbox first
        const messagingSidebarBtn = Array.from(document.querySelectorAll('button')).find(b => b.getAttribute('onclick')
            ?.includes("showSection('messaging-mgmt')"));
        if (messagingSidebarBtn) {
            messagingSidebarBtn.addEventListener('click', function(ev) {
                // use the safer showSection, and pass the clicked button to be marked active
                showSection('messaging-mgmt', messagingSidebarBtn);
                showInbox();
            });
        }

        // --- Messaging UI elements ---
        const inboxBtn = document.getElementById('inboxBtn');
        const composeBtn = document.getElementById('composeBtn');
        const inboxSection = document.getElementById('inbox-section');
        const composeSection = document.getElementById('compose-section');
        const cancelCompose = document.getElementById('cancelCompose');
        const composeForm = document.getElementById('composeForm');
        const messageTable = document.getElementById('messageTable');
        const messagePopup = document.getElementById('message-popup');
        const popupSender = document.getElementById('popupSender');
        const popupRecipient = document.getElementById('popupRecipient');
        const popupSubject = document.getElementById('popupSubject');
        const popupDate = document.getElementById('popupDate');
        const popupBody = document.getElementById('popupBody');
        const replyBtn = document.getElementById('replyBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const closePopupBtns = [document.getElementById('closePopup'), document.getElementById('closePopup2')];

        // In-memory messages store for frontend demo (id increments)
        let messages = [{
            id: 1,
            sender: 'Admin',
            recipient: 'You',
            subject: 'Welcome to SeekYu',
            date: '2025-09-13',
            body: 'This is a sample welcome message.'
        }];
        let nextMessageId = 2;
        let currentViewedMessageId = null; // id of message currently shown in popup

        function renderInbox() {
            messageTable.innerHTML = '';
            for (const msg of messages.slice().reverse()) { // show newest first
                const tr = document.createElement('tr');
                tr.innerHTML = `
        <td class="py-2">${escapeHtml(msg.sender)}</td>
        <td class="py-2">${escapeHtml(msg.subject)}</td>
        <td class="py-2">${escapeHtml(msg.date)}</td>
        <td class="py-2">
          <button class="viewBtn text-blue-600 hover:underline" data-id="${msg.id}">View</button>
          <button class="delInlineBtn ml-3 text-red-600 hover:underline" data-id="${msg.id}">Delete</button>
        </td>`;
                messageTable.appendChild(tr);
            }
        }

        // Simple HTML escape
        function escapeHtml(s) {
            if (!s && s !== 0) return '';
            return String(s).replace(/[&<>"'`=\/]/g, function(ch) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#47;',
                '`': '&#96;',
                    '=': '&#61;'
                } [ch];
            });
        }

        // Inbox/Compose toggles
        function showInbox() {
            inboxSection.classList.remove('hidden');
            composeSection.classList.add('hidden');
            inboxBtn.classList.add('bg-indigo-600', 'text-white');
            inboxBtn.classList.remove('bg-slate-200', 'text-gray-800');
            composeBtn.classList.remove('bg-indigo-600', 'text-white');
            composeBtn.classList.add('bg-slate-200', 'text-gray-800');
        }

        function showCompose() {
            composeSection.classList.remove('hidden');
            inboxSection.classList.add('hidden');
            composeBtn.classList.add('bg-indigo-600', 'text-white');
            composeBtn.classList.remove('bg-slate-200', 'text-gray-800');
            inboxBtn.classList.remove('bg-indigo-600', 'text-white');
            inboxBtn.classList.add('bg-slate-200', 'text-gray-800');
        }
        inboxBtn?.addEventListener('click', showInbox);
        composeBtn?.addEventListener('click', showCompose);
        cancelCompose?.addEventListener('click', showInbox);

        // Open a message in popup (delegated)
        document.addEventListener('click', function(e) {
            // view inline from table
            if (e.target && e.target.classList.contains('viewBtn')) {
                const id = Number(e.target.dataset.id);
                const msg = messages.find(m => m.id === id);
                if (!msg) return;
                currentViewedMessageId = id;
                popupSender.textContent = msg.sender;
                popupRecipient.textContent = msg.recipient;
                popupSubject.textContent = msg.subject;
                popupDate.textContent = msg.date;
                popupBody.textContent = msg.body;
                messagePopup.classList.remove('hidden');
            }

            // inline delete button in table (asks confirm)
            if (e.target && e.target.classList.contains('delInlineBtn')) {
                const id = Number(e.target.dataset.id);
                if (!confirm('Delete this message?')) return;
                messages = messages.filter(m => m.id !== id);
                renderInbox();
                // if deleted message is currently open in popup, close popup
                if (currentViewedMessageId === id) {
                    currentViewedMessageId = null;
                    messagePopup.classList.add('hidden');
                }
            }
        });

        // Reply button: prefill compose form and open compose
        replyBtn?.addEventListener('click', function() {
            if (!currentViewedMessageId) return;
            const msg = messages.find(m => m.id === currentViewedMessageId);
            if (!msg) return;
            // open messaging section and compose
            showSection('messaging-mgmt');
            showCompose();

            // prefill
            const recipientInput = document.getElementById('recipient');
            const subjectInput = document.getElementById('subject');
            const bodyTextarea = document.getElementById('message');

            if (recipientInput) recipientInput.value = msg.sender || '';
            if (subjectInput) {
                // if subject already starts with Re:, keep it
                subjectInput.value = msg.subject && !/^Re:/i.test(msg.subject) ? `Re: ${msg.subject}` : msg
                    .subject || '';
            }
            if (bodyTextarea) {
                bodyTextarea.value =
                    `\n\n--- Original Message ---\nFrom: ${msg.sender}\nDate: ${msg.date}\nSubject: ${msg.subject}\n\n${msg.body}`;
                bodyTextarea.focus();
                // put cursor at start of textarea for user to type reply
                bodyTextarea.setSelectionRange(0, 0);
            }

            // close popup after replying to reduce UI noise
            messagePopup.classList.add('hidden');
        });

        // Delete button (from popup) - removes the message and closes popup
        deleteBtn?.addEventListener('click', function() {
            if (!currentViewedMessageId) return;
            if (!confirm('Delete this message? This cannot be undone in this demo.')) return;
            messages = messages.filter(m => m.id !== currentViewedMessageId);
            currentViewedMessageId = null;
            messagePopup.classList.add('hidden');
            renderInbox();
        });

        // Close popup buttons
        closePopupBtns.forEach(btn => btn?.addEventListener('click', function() {
            messagePopup.classList.add('hidden');
            currentViewedMessageId = null;
        }));

        // Clicking outside popup content closes it
        messagePopup?.addEventListener('click', function(e) {
            if (e.target === messagePopup) {
                messagePopup.classList.add('hidden');
                currentViewedMessageId = null;
            }
        });

        // Compose handler (frontend-only simulation)
        composeForm?.addEventListener('submit', function(e) {
            e.preventDefault();
            const recipient = document.getElementById('recipient').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const body = document.getElementById('message').value.trim();
            if (!recipient || !subject || !body) {
                alert('Please fill out all fields.');
                return;
            }
            const newMsg = {
                id: nextMessageId++,
                sender: 'You', // outgoing: from current user
                recipient,
                subject,
                date: new Date().toISOString().split('T')[0],
                body
            };
            // For demo, add to messages store (so it appears in inbox)
            messages.push(newMsg);
            renderInbox();
            // Reset form and show inbox
            composeForm.reset();
            showInbox();
            alert('Message sent (demo mode). In a real app this would call your backend API.');
        });

        // initial render: show inbox first
        renderInbox();
        showInbox();

        // Utility: refresh button (just re-render here)
        document.getElementById('refreshBtn')?.addEventListener('click', function() {
            renderInbox();
        });

        // Search (very basic filter by subject/sender)
        document.getElementById('messageSearch')?.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            const rows = messageTable.querySelectorAll('tr');
            rows.forEach(r => {
                const txt = r.textContent.toLowerCase();
                r.style.display = txt.includes(q) ? '' : 'none';
            });
        });

        // accounts management logic
        (function() {
            // Elements (same IDs as in the HTML you already have)
            const createForm = document.getElementById('createAccountForm');
            const accountsTable = document.getElementById('accountsTable');
            const removedTable = document.getElementById('removedAccountsTable');
            const accountsSearch = document.getElementById('accountsSearch');
            const removedSearch = document.getElementById('removedSearch');
            const refreshAccounts = document.getElementById('refreshAccounts');

            const editModal = document.getElementById('editAccountModal');
            const editForm = document.getElementById('editAccountForm');
            const closeEditModal = document.getElementById('closeEditModal');
            const cancelEdit = document.getElementById('cancelEdit');

            const passModal = document.getElementById('changePasswordModal');
            const passForm = document.getElementById('changePasswordForm');
            const closePassModal = document.getElementById('closePassModal');
            const cancelPass = document.getElementById('cancelPass');

            const tabCreate = document.getElementById('accountsTabCreate');
            const tabView = document.getElementById('accountsTabView');
            const tabRemoved = document.getElementById('accountsTabRemoved');
            const createSection = document.getElementById('create-account-section');
            const viewSection = document.getElementById('view-accounts-section');
            const removedSection = document.getElementById('removed-accounts-section');
            const resetCreate = document.getElementById('resetCreate');

            // In-memory stores
            // account object shape:
            // { id: number, accountId: 'ADM-0001', fullName, username, role, password, createdAt }
            let accounts = [{
                id: 1,
                accountId: 'ADM-0001',
                fullName: 'Jane Admin',
                username: 'jane.admin',
                role: 'Admin',
                password: 'admin123',
                createdAt: '2025-09-13'
            }];
            let removedAccounts = []; // { id, accountId, fullName, username, role, password, createdAt, removedAt }
            let nextAccountId = 2;

            // mapping for prefixes
            const rolePrefixes = {
                'Admin': 'ADM',
                'HR': 'HR',
                'Security Guard': 'SG',
                'Head Guard': 'HG',
                'Client': 'CL'
            };

            // utils
            function today() {
                return new Date().toISOString().split('T')[0];
            }

            function padNum(n, size = 4) {
                return String(n).padStart(size, '0');
            }

            function genAccountId(role, seq) {
                const pref = rolePrefixes[role] || 'USR';
                return `${pref}-${padNum(seq)}`;
            }

            function escapeHtml(s) {
                if (!s && s !== 0) return '';
                return String(s).replace(/[&<>"'`=\/]/g, function(ch) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                    '/': '&#47;',
                    '`': '&#96;',
                        '=': '&#61;'
                    } [ch];
                });
            }

            // Render functions
            function renderAccounts(filter = '') {
                accountsTable.innerHTML = '';
                const rows = accounts.filter(a => {
                    const q = filter.toLowerCase();
                    return !q || (a.accountId + ' ' + a.fullName + ' ' + a.username + ' ' + a.role)
                        .toLowerCase().includes(q);
                });

                if (rows.length === 0) {
                    accountsTable.innerHTML =
                        '<tr><td class="py-4 px-3 text-slate-500" colspan="6">No accounts found.</td></tr>';
                    return;
                }

                for (const a of rows) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
        <td class="py-3 px-3 font-mono text-sm">${escapeHtml(a.accountId)}</td>
        <td class="py-3 px-3">${escapeHtml(a.fullName)}</td>
        <td class="py-3 px-3">${escapeHtml(a.username)}</td>
        <td class="py-3 px-3">${escapeHtml(a.role)}</td>
        <td class="py-3 px-3">${escapeHtml(a.createdAt)}</td>
        <td class="py-3 px-3">
          <button class="editBtn text-indigo-600 hover:underline" data-id="${a.id}">Edit</button>
          <button class="passBtn ml-3 text-sky-600 hover:underline" data-id="${a.id}">Change Password</button>
          <button class="removeBtn ml-3 text-red-600 hover:underline" data-id="${a.id}">Remove</button>
        </td>
      `;
                    accountsTable.appendChild(tr);
                }
            }

            function renderRemovedAccounts(filter = '') {
                removedTable.innerHTML = '';
                const rows = removedAccounts.filter(a => {
                    const q = filter.toLowerCase();
                    return !q || (a.accountId + ' ' + a.fullName + ' ' + a.username + ' ' + a.role)
                        .toLowerCase().includes(q);
                });

                if (rows.length === 0) {
                    removedTable.innerHTML =
                        '<tr><td class="py-4 px-3 text-slate-500" colspan="6">No removed accounts.</td></tr>';
                    return;
                }

                for (const a of rows) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
        <td class="py-3 px-3 font-mono text-sm">${escapeHtml(a.accountId)}</td>
        <td class="py-3 px-3">${escapeHtml(a.fullName)}</td>
        <td class="py-3 px-3">${escapeHtml(a.username)}</td>
        <td class="py-3 px-3">${escapeHtml(a.role)}</td>
        <td class="py-3 px-3">${escapeHtml(a.removedAt)}</td>
        <td class="py-3 px-3">
          <button class="restoreBtn text-emerald-600 hover:underline" data-id="${a.id}">Restore</button>
          <button class="permaDelBtn ml-3 text-red-700 hover:underline" data-id="${a.id}">Permanently Delete</button>
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
                [tabCreate, tabView, tabRemoved].forEach(t => t.classList.remove('bg-indigo-600', 'text-white'));
                [tabCreate, tabView, tabRemoved].forEach(t => t.classList.add('bg-slate-200', 'text-gray-800'));
                tab.classList.remove('bg-slate-200', 'text-gray-800');
                tab.classList.add('bg-indigo-600', 'text-white');

                createSection.classList.add('hidden');
                viewSection.classList.add('hidden');
                removedSection.classList.add('hidden');

                if (tab === tabCreate) createSection.classList.remove('hidden');
                if (tab === tabView) viewSection.classList.remove('hidden');
                if (tab === tabRemoved) removedSection.classList.remove('hidden');
            }

            tabCreate.addEventListener('click', () => activateTab(tabCreate));
            tabView.addEventListener('click', () => activateTab(tabView));
            tabRemoved.addEventListener('click', () => activateTab(tabRemoved));

            // Default: show create
            activateTab(tabCreate);

            // Create account: now generates accountId
            createForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const fullName = document.getElementById('fullName').value.trim();
                const username = document.getElementById('username').value.trim();
                const role = document.getElementById('role').value;
                const password = document.getElementById('password').value;

                if (!fullName || !username || !role || !password) {
                    alert('Please fill out all fields.');
                    return;
                }

                // Generate accountId from role prefix + sequence
                const accountId = genAccountId(role, nextAccountId);

                // ensure unique accountId / username (demo)
                if (accounts.some(a => a.username === username) || removedAccounts.some(a => a.username ===
                        username)) {
                    alert('Username already exists. Choose another one.');
                    return;
                }
                if (accounts.some(a => a.accountId === accountId) || removedAccounts.some(a => a.accountId ===
                        accountId)) {
                    // unlikely as we use incremental, but handle it
                    nextAccountId++;
                    alert('ID collision, generating a different ID. Please submit again.');
                    return;
                }

                const newAcc = {
                    id: nextAccountId++,
                    accountId,
                    fullName,
                    username,
                    role,
                    password,
                    createdAt: today()
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

            resetCreate.addEventListener('click', function() {
                createForm.reset();
            });

            // Table action delegation for accounts (edit, change pass, remove)
            document.addEventListener('click', function(e) {
                if (e.target.matches('.editBtn')) {
                    const id = Number(e.target.dataset.id);
                    const a = accounts.find(x => x.id === id);
                    if (!a) return;
                    document.getElementById('editId').value = a.id;
                    document.getElementById('editFullName').value = a.fullName;
                    document.getElementById('editUsername').value = a.username;
                    document.getElementById('editRole').value = a.role;
                    editModal.classList.remove('hidden');
                }

                if (e.target.matches('.passBtn')) {
                    const id = Number(e.target.dataset.id);
                    document.getElementById('passUserId').value = id;
                    document.getElementById('newPassword').value = '';
                    document.getElementById('confirmNewPassword').value = '';
                    passModal.classList.remove('hidden');
                }

                if (e.target.matches('.removeBtn')) {
                    const id = Number(e.target.dataset.id);
                    if (!confirm('Move this account to Removed (Trash)?')) return;
                    const idx = accounts.findIndex(x => x.id === id);
                    if (idx === -1) return;
                    const removed = accounts.splice(idx, 1)[0];
                    removed.removedAt = today();
                    removedAccounts.push(removed);
                    renderAccounts();
                    renderRemovedAccounts();
                }

                // Removed table actions
                if (e.target.matches('.restoreBtn')) {
                    const id = Number(e.target.dataset.id);
                    const idx = removedAccounts.findIndex(x => x.id === id);
                    if (idx === -1) return;
                    const restored = removedAccounts.splice(idx, 1)[0];
                    delete restored.removedAt;
                    accounts.push(restored);
                    renderAccounts();
                    renderRemovedAccounts();
                }

                if (e.target.matches('.permaDelBtn')) {
                    const id = Number(e.target.dataset.id);
                    if (!confirm('Permanently delete this account? This cannot be undone.')) return;
                    const idx = removedAccounts.findIndex(x => x.id === id);
                    if (idx === -1) return;
                    removedAccounts.splice(idx, 1);
                    renderRemovedAccounts();
                }
            });

            // Edit form submit
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = Number(document.getElementById('editId').value);
                const fullName = document.getElementById('editFullName').value.trim();
                const username = document.getElementById('editUsername').value.trim();
                const role = document.getElementById('editRole').value;

                const acc = accounts.find(a => a.id === id);
                if (!acc) {
                    alert('Account not found');
                    return;
                }

                // ensure username unique among accounts and removed (except self)
                if ((accounts.some(a => a.username === username && a.id !== id)) || (removedAccounts.some(a => a
                        .username === username))) {
                    alert('Username already taken.');
                    return;
                }

                acc.fullName = fullName;
                acc.username = username;
                acc.role = role;
                // NOTE: accountId stays unchanged here to preserve login credentials
                renderAccounts();
                editModal.classList.add('hidden');
            });

            closeEditModal.addEventListener('click', () => editModal.classList.add('hidden'));
            cancelEdit.addEventListener('click', () => editModal.classList.add('hidden'));

            // Change password submit
            passForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = Number(document.getElementById('passUserId').value);
                const p1 = document.getElementById('newPassword').value;
                const p2 = document.getElementById('confirmNewPassword').value;
                if (!p1 || !p2) {
                    alert('Enter the new password in both fields.');
                    return;
                }
                if (p1 !== p2) {
                    alert('Passwords do not match');
                    return;
                }
                const acc = accounts.find(a => a.id === id);
                if (!acc) {
                    alert('Account not found');
                    return;
                }
                acc.password = p1; // demo only
                passModal.classList.add('hidden');
                alert('Password changed (demo mode). In production, call your backend API and hash passwords.');
            });

            closePassModal.addEventListener('click', () => passModal.classList.add('hidden'));
            cancelPass.addEventListener('click', () => passModal.classList.add('hidden'));

            // Search handlers
            accountsSearch?.addEventListener('input', function() {
                renderAccounts(this.value || '');
            });
            removedSearch?.addEventListener('input', function() {
                renderRemovedAccounts(this.value || '');
            });
            refreshAccounts?.addEventListener('click', function() {
                renderAccounts();
            });

            // Optional: Expose functions for backend wiring
            window.AccountsDemo = {
                getAccounts: () => accounts,
                getRemoved: () => removedAccounts,
                render: () => {
                    renderAccounts();
                    renderRemovedAccounts();
                }
            };

        })();

        document.addEventListener('DOMContentLoaded', function() {
            // In-memory demo data (replace or fetch from backend later)
            let reports = [{
                    id: 'IR-0001',
                    reporterName: 'John Guard',
                    employeeId: 'SG-1001',
                    role: 'Security Guard',
                    shiftDate: '2025-09-12',
                    shiftStart: '08:00',
                    shiftEnd: '16:00',
                    contact: '09171234567',
                    email: 'john.guard@example.com',
                    incidentDate: '2025-09-12',
                    incidentTime: '17:30',
                    location: 'Client #3829 - Main Gate',
                    type: 'Accident',
                    description: 'Guard slipped on wet floor during patrol. Minor bruises.',
                    parties: [{
                        name: 'Jane Doe',
                        role: 'Witness',
                        contact: '09170001111',
                        id: 'DL-12345',
                        desc: 'Saw slip near gate'
                    }],
                    injuries: 'Yes',
                    injuries_desc: 'Bruise on left arm',
                    medical_provided: 'Yes',
                    police_notified: false,
                    medical_contacted: true,
                    scene_secured: true,
                    actions: 'Assisted guard, called medics, logged incident.',
                    evidence: {
                        photos: true,
                        videos: false,
                        witness: true,
                        physical: false,
                        other: ''
                    },
                    remarks: 'Install wet-floor signage.',
                    createdAt: '2025-09-12'
                }
                // additional reports may be added here or loaded from backend
            ];

            // helpers
            function escapeHtml(s) {
                if (!s && s !== 0) return '';
                return String(s).replace(/[&<>"'`=\/]/g, function(ch) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                    '/': '&#47;',
                    '`': '&#96;',
                        '=': '&#61;'
                    } [ch];
                });
            }

            // render reports table with filters
            const reportsTable = document.getElementById('reportsTable');

            function renderReports() {
                reportsTable.innerHTML = '';
                const q = (document.getElementById('reportsSearch').value || '').toLowerCase();
                const roleFilter = document.getElementById('filterRole').value;
                const typeFilter = document.getElementById('filterType').value;
                const from = document.getElementById('filterFrom').value;
                const to = document.getElementById('filterTo').value;

                const filtered = reports.slice().reverse().filter(r => {
                    if (roleFilter && r.role !== roleFilter) return false;
                    if (typeFilter && r.type !== typeFilter) return false;
                    if (from && r.incidentDate < from) return false;
                    if (to && r.incidentDate > to) return false;
                    if (!q) return true;
                    const hay = (r.id + ' ' + r.reporterName + ' ' + r.employeeId + ' ' + r.location + ' ' +
                        r.type + ' ' + r.description).toLowerCase();
                    return hay.includes(q);
                });

                if (filtered.length === 0) {
                    reportsTable.innerHTML =
                        '<tr><td class="py-4 px-3 text-slate-500" colspan="7">No reports found.</td></tr>';
                    return;
                }

                for (const r of filtered) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
        <td class="py-2 px-3 font-mono text-sm">${r.id}</td>
        <td class="py-2 px-3">${escapeHtml(r.incidentDate)} ${escapeHtml(r.incidentTime)}</td>
        <td class="py-2 px-3">${escapeHtml(r.reporterName)}</td>
        <td class="py-2 px-3">${escapeHtml(r.role)}</td>
        <td class="py-2 px-3">${escapeHtml(r.type)}</td>
        <td class="py-2 px-3">${escapeHtml(r.location)}</td>
        <td class="py-2 px-3">
          <button class="viewReportBtn text-blue-600 hover:underline" data-id="${r.id}">View</button>
        </td>`;
                    reportsTable.appendChild(tr);
                }
            }

            // wire filters/search
            ['reportsSearch', 'filterRole', 'filterType', 'filterFrom', 'filterTo'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', renderReports);
            });
            document.getElementById('refreshReports').addEventListener('click', renderReports);

            // report details modal logic
            const reportModal = document.getElementById('reportModal');
            const reportDetails = document.getElementById('reportDetails');

            function openReportModal(report) {
                reportDetails.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><strong>Report ID:</strong> ${report.id}</div>
        <div><strong>Created:</strong> ${report.createdAt}</div>
        <div><strong>Reporter:</strong> ${escapeHtml(report.reporterName)}</div>
        <div><strong>Employee ID:</strong> ${escapeHtml(report.employeeId)}</div>
        <div><strong>Role:</strong> ${escapeHtml(report.role)}</div>
        <div><strong>Contact:</strong> ${escapeHtml(report.contact)}</div>
        <div><strong>Email:</strong> ${escapeHtml(report.email)}</div>
        <div><strong>Shift Date / Start-End:</strong> ${report.shiftDate} ${report.shiftStart||''} - ${report.shiftEnd||''}</div>
        <div><strong>Incident Date / Time:</strong> ${report.incidentDate} ${report.incidentTime}</div>
        <div class="md:col-span-2"><strong>Location:</strong> ${escapeHtml(report.location)}</div>
        <div class="md:col-span-2"><strong>Type:</strong> ${escapeHtml(report.type)}</div>
        <div class="md:col-span-2"><strong>Description:</strong><div class="mt-1 whitespace-pre-wrap">${escapeHtml(report.description)}</div></div>
      </div>

      <hr class="my-2" />

      <div>
        <h4 class="font-semibold">Parties Involved</h4>
        ${report.parties && report.parties.length ? report.parties.map(p=>`
                                      <div class="p-2 border rounded mt-2">
                                        <div><strong>Name:</strong> ${escapeHtml(p.name)}</div>
                                        <div><strong>Role:</strong> ${escapeHtml(p.role)}</div>
                                        <div><strong>Contact:</strong> ${escapeHtml(p.contact)}</div>
                                        <div><strong>ID:</strong> ${escapeHtml(p.id)}</div>
                                        <div><strong>Involvement:</strong> ${escapeHtml(p.desc)}</div>
                                      </div>`).join('') : '<div class="text-slate-500">No parties recorded.</div>'}
      </div>

      <hr class="my-2" />

      <div>
        <h4 class="font-semibold">Injuries & Medical</h4>
        <div><strong>Were there injuries?</strong> ${escapeHtml(report.injuries)}</div>
        <div><strong>Injuries description:</strong> ${escapeHtml(report.injuries_desc)}</div>
        <div><strong>Medical provided:</strong> ${escapeHtml(report.medical_provided)}</div>
      </div>

      <hr class="my-2" />

      <div>
        <h4 class="font-semibold">Actions Taken</h4>
        <div><strong>Police notified:</strong> ${report.police_notified ? 'Yes' : 'No'}</div>
        <div><strong>Medical contacted:</strong> ${report.medical_contacted ? 'Yes' : 'No'}</div>
        <div><strong>Scene secured:</strong> ${report.scene_secured ? 'Yes' : 'No'}</div>
        <div class="mt-2"><strong>Other actions:</strong><div class="mt-1 whitespace-pre-wrap">${escapeHtml(report.actions)}</div></div>
      </div>

      <hr class="my-2" />

      <div>
        <h4 class="font-semibold">Evidence</h4>
        <div><strong>Photos:</strong> ${report.evidence && report.evidence.photos ? 'Yes' : 'No'}</div>
        <div><strong>Videos:</strong> ${report.evidence && report.evidence.videos ? 'Yes' : 'No'}</div>
        <div><strong>Witness statements:</strong> ${report.evidence && report.evidence.witness ? 'Yes' : 'No'}</div>
        <div><strong>Physical items:</strong> ${report.evidence && report.evidence.physical ? 'Yes' : 'No'}</div>
        <div><strong>Other:</strong> ${escapeHtml(report.evidence && report.evidence.other || '')}</div>
      </div>

      <hr class="my-2" />

      <div><strong>Additional Remarks:</strong><div class="mt-1 whitespace-pre-wrap">${escapeHtml(report.remarks)}</div></div>
    `;
                reportModal.classList.remove('hidden');
            }

            // delegated click for view buttons
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('viewReportBtn')) {
                    const id = e.target.dataset.id;
                    const r = reports.find(x => x.id === id);
                    if (r) openReportModal(r);
                }
            });

            // close modal
            document.getElementById('closeReportModal')?.addEventListener('click', () => reportModal.classList.add(
                'hidden'));
            document.getElementById('closeReportModal2')?.addEventListener('click', () => reportModal.classList.add(
                'hidden'));
            reportModal.addEventListener('click', function(e) {
                if (e.target === reportModal) reportModal.classList.add('hidden');
            });

            // export JSON of currently displayed report
            document.getElementById('exportReportBtn')?.addEventListener('click', function() {
                const content = reportDetails.textContent || '';
                const match = (reportDetails.textContent || '').match(/Report ID:\s*(IR-\d+)/);
                if (!match) return alert('Cannot determine report ID for export.');
                const id = match[1];
                const r = reports.find(x => x.id === id);
                if (!r) return alert('Report not found.');
                const blob = new Blob([JSON.stringify(r, null, 2)], {
                    type: 'application/json'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `${r.id}.json`;
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(url);
            });

            // initial render
            renderReports();

            // ensure clicking sidebar Incident Reports opens view-only section
            const incidentSidebarBtn = Array.from(document.querySelectorAll('button')).find(b => b.getAttribute(
                'onclick')?.includes("showSection('incident-reports')"));
            if (incidentSidebarBtn) {
                incidentSidebarBtn.addEventListener('click', function() {
                    showSection('incident-reports', incidentSidebarBtn);
                    // nothing to switch; just ensure view is visible
                    renderReports();
                });
            }
        });

        /*
          Admin Leave Requests manager (role-aware).
          Uses localStorage key 'seekyu_leave_requests_v1' (same demo key as user-side).
          - Replace demo user list with your real users/sessions in production.
          - Approve/Reject persist to localStorage.
        */
        (function() {
            const STORAGE_KEY = 'seekyu_leave_requests_v1';

            // Allowed roles
            const ALLOWED_APPROVER_ROLES = ['Admin', 'Manager', 'HR'];

            // ----- demo users (replace with real session / server data) -----
            const demoUsers = [{
                    id: 9001,
                    name: 'Alice Manager',
                    role: 'Manager',
                    email: 'alice.manager@example.com'
                },
                {
                    id: 9002,
                    name: 'Bob HR',
                    role: 'HR',
                    email: 'bob.hr@example.com'
                },
                {
                    id: 9003,
                    name: 'Carol Admin',
                    role: 'Admin',
                    email: 'carol.admin@example.com'
                },
                {
                    id: 42,
                    name: 'John Guard',
                    role: 'Security Guard',
                    email: 'john.guard@example.com'
                },
                {
                    id: 43,
                    name: 'Mary Head',
                    role: 'Head Guard',
                    email: 'mary.head@example.com'
                }
            ];
            // ----------------------------------------------------------------

            // DOM refs
            const demoUserSelect = document.getElementById('demoUserSelect');
            const exportAllBtn = document.getElementById('exportAllLeaves');
            const table = document.getElementById('adminLeaveTable');
            const searchEl = document.getElementById('adminLeaveSearch');
            const statusFilter = document.getElementById('adminFilterStatus');
            const fromFilter = document.getElementById('adminFilterFrom');
            const toFilter = document.getElementById('adminFilterTo');
            const refreshBtn = document.getElementById('adminRefresh');

            const modal = document.getElementById('adminLeaveModal');
            const closeModalBtns = [document.getElementById('closeAdminLeaveModal'), document.getElementById(
                'adminCloseBtn')];
            const detailsEl = document.getElementById('adminLeaveDetails');
            const remarksEl = document.getElementById('adminRemarks');
            const approveBtn = document.getElementById('adminApproveBtn');
            const rejectBtn = document.getElementById('adminRejectBtn');

            // load or init demo requests
            function loadRequests() {
                try {
                    const raw = localStorage.getItem(STORAGE_KEY);
                    if (!raw) {
                        // seed demo data if none exists
                        const demo = [{
                                id: 'RL-0001',
                                userId: 42,
                                accountId: 'SG-1001',
                                name: 'John Guard',
                                role: 'Security Guard',
                                email: 'john.guard@example.com',
                                start: '2025-10-01',
                                end: '2025-10-05',
                                type: 'Vacation',
                                reason: 'Family trip',
                                status: 'Pending',
                                submittedAt: '2025-09-10',
                                updatedAt: '2025-09-10',
                                approver: null,
                                approverRemarks: ''
                            },
                            {
                                id: 'RL-0002',
                                userId: 43,
                                accountId: 'SG-1002',
                                name: 'Mary Head',
                                role: 'Head Guard',
                                email: 'mary.head@example.com',
                                start: '2025-09-20',
                                end: '2025-09-22',
                                type: 'Sick',
                                reason: 'Medical',
                                status: 'Approved',
                                submittedAt: '2025-09-08',
                                updatedAt: '2025-09-09',
                                approver: 'Alice Manager',
                                approverRemarks: 'Approved for 3 days.'
                            }
                        ];
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(demo));
                        return demo;
                    }
                    return JSON.parse(raw);
                } catch (e) {
                    console.error(e);
                    return [];
                }
            }

            function saveRequests(arr) {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(arr));
            }

            let requests = loadRequests();

            // current acting admin (demo)
            let currentAdmin = demoUsers[0];

            // populate demo user select
            function populateUserSelect() {
                demoUserSelect.innerHTML = '';
                for (const u of demoUsers) {
                    const o = document.createElement('option');
                    o.value = u.id;
                    o.textContent = `${u.name} — ${u.role}`;
                    demoUserSelect.appendChild(o);
                }
                demoUserSelect.value = currentAdmin.id;
            }
            populateUserSelect();
            demoUserSelect.addEventListener('change', function() {
                const id = Number(this.value);
                const u = demoUsers.find(x => x.id === id);
                if (u) currentAdmin = u;
                renderTable(); // update buttons enablement if modal open later
            });

            // render table
            function renderTable() {
                table.innerHTML = '';
                const q = (searchEl.value || '').toLowerCase();
                const st = statusFilter.value;
                const from = fromFilter.value;
                const to = toFilter.value;

                const filtered = requests.slice().reverse().filter(r => {
                    if (st && r.status !== st) return false;
                    if (from && r.start < from) return false;
                    if (to && r.end > to) return false;
                    if (!q) return true;
                    const hay = (r.id + ' ' + r.name + ' ' + r.accountId + ' ' + r.type + ' ' + r.reason)
                        .toLowerCase();
                    return hay.includes(q);
                });

                if (filtered.length === 0) {
                    table.innerHTML =
                        '<tr><td class="py-4 px-3 text-slate-500" colspan="8">No leave requests found.</td></tr>';
                    return;
                }

                for (const r of filtered) {
                    const tr = document.createElement('tr');
                    const approverText = r.approver ?
                        `${escapeHtml(r.approver)} — ${escapeHtml(r.approverRemarks || '')}` : '-';
                    tr.innerHTML = `
        <td class="py-2 px-3 font-mono text-sm">${r.id}</td>
        <td class="py-2 px-3">${escapeHtml(r.name)}</td>
        <td class="py-2 px-3">${r.start} → ${r.end}</td>
        <td class="py-2 px-3">${escapeHtml(r.type)}</td>
        <td class="py-2 px-3">${r.status}</td>
        <td class="py-2 px-3">${r.submittedAt}</td>
        <td class="py-2 px-3"><div class="max-w-sm truncate">${escapeHtml(approverText)}</div></td>
        <td class="py-2 px-3">
          <button class="viewAdminLeave text-blue-600 hover:underline" data-id="${r.id}">View</button>
        </td>`;
                    table.appendChild(tr);
                }
            }

            function escapeHtml(s) {
                if (!s && s !== 0) return '';
                return String(s).replace(/[&<>"'`=\/]/g, function(ch) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                    '/': '&#47;',
                    '`': '&#96;',
                        '=': '&#61;'
                    } [ch];
                });
            }

            // delegated clicks to open modal
            document.addEventListener('click', function(e) {
                const t = e.target;
                if (t.matches('.viewAdminLeave')) {
                    const id = t.dataset.id;
                    const req = requests.find(x => x.id === id);
                    if (!req) return alert('Request not found.');
                    openModalFor(req);
                }
            });

            // open modal and populate
            let currentModalId = null;

            function openModalFor(req) {
                currentModalId = req.id;
                detailsEl.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div><strong>Request ID:</strong> ${req.id}</div>
        <div><strong>Submitted:</strong> ${req.submittedAt}</div>
        <div><strong>Name:</strong> ${escapeHtml(req.name)}</div>
        <div><strong>Account ID:</strong> ${escapeHtml(req.accountId || '-')}</div>
        <div><strong>Role:</strong> ${escapeHtml(req.role)}</div>
        <div><strong>Email:</strong> ${escapeHtml(req.email || '')}</div>
        <div><strong>Range:</strong> ${req.start} → ${req.end}</div>
        <div><strong>Type:</strong> ${escapeHtml(req.type)}</div>
        <div class="md:col-span-2"><strong>Reason:</strong><div class="mt-1 whitespace-pre-wrap">${escapeHtml(req.reason)}</div></div>
      </div>

      <hr class="my-2" />

      <div>
        <strong>Status:</strong> ${req.status} <br/>
        <strong>Approver:</strong> ${escapeHtml(req.approver || '-')} <br/>
        <strong>Approver Remarks:</strong> <div class="mt-1 whitespace-pre-wrap">${escapeHtml(req.approverRemarks || '')}</div>
      </div>
    `;
                const canAct = ALLOWED_APPROVER_ROLES.includes(currentAdmin.role) && req.status === 'Pending';
                approveBtn.disabled = !canAct;
                rejectBtn.disabled = !canAct;
                remarksEl.value = req.approverRemarks || '';
                modal.classList.remove('hidden');
            }

            // perform approve or reject
            function performAction(action) {
                if (!currentModalId) return;
                const remarks = (remarksEl.value || '').trim();
                if (!remarks) return alert('Please add approver remarks before approving/rejecting.');
                const idx = requests.findIndex(x => x.id === currentModalId);
                if (idx === -1) return alert('Request not found.');
                if (!ALLOWED_APPROVER_ROLES.includes(currentAdmin.role)) return alert(
                    'You are not authorized to perform this action.');
                if (requests[idx].status !== 'Pending') return alert('Only Pending requests can be actioned.');

                requests[idx].status = action === 'approve' ? 'Approved' : 'Rejected';
                requests[idx].approver = currentAdmin.name;
                requests[idx].approverRemarks = remarks;
                requests[idx].updatedAt = new Date().toISOString().split('T')[0];
                saveRequests(requests);
                modal.classList.add('hidden');
                currentModalId = null;
                renderTable();
                alert(`Request ${requests[idx].id} ${requests[idx].status}.`);
            }

            approveBtn.addEventListener('click', () => performAction('approve'));
            rejectBtn.addEventListener('click', () => {
                if (!confirm('Reject this request?')) return;
                performAction('reject');
            });

            // close modal
            closeModalBtns.forEach(b => b?.addEventListener('click', () => {
                modal.classList.add('hidden');
                currentModalId = null;
            }));

            // filters / search
            [searchEl, statusFilter, fromFilter, toFilter].forEach(el => {
                if (el) el.addEventListener('input', renderTable);
            });
            refreshBtn.addEventListener('click', renderTable);

            // export all
            exportAllBtn.addEventListener('click', function() {
                if (!requests.length) return alert('No requests to export.');
                const blob = new Blob([JSON.stringify(requests, null, 2)], {
                    type: 'application/json'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `leave_requests_all.json`;
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(url);
            });

            // initial render
            renderTable();

            // expose small helpers for debugging (optional)
            window._LeaveAdmin = {
                list: () => requests,
                setUser: (id) => {
                    const u = demoUsers.find(x => x.id === Number(id));
                    if (u) {
                        currentAdmin = u;
                        demoUserSelect.value = u.id;
                        renderTable();
                    }
                }
            };

        })();

        // Client Management module (Admin view)
        // - Uses localStorage key 'seekyu_clients' to persist data (demo).
        // - View client details in client-profile.html?id= (new page).
        // - Assign personnel to client (modal).
        // - Extend client and personnel data as needed.
        (function() {
            const root = document.getElementById('client-mgmt');
            if (!root) return;
            const $ = sel => root.querySelector(sel);
            const $all = sel => Array.from(root.querySelectorAll(sel));

            // sample data (extend with the new fields)
            const clients = [{
                    id: 1,
                    contact: 'Maria Santos',
                    company: 'MJL Security Corp',
                    email: 'maria@example.com',
                    phone: '09171234567',
                    jobTitle: 'Mall Guard',
                    location: 'Towerville, Graceville, SJDM',
                    numGuards: 5,
                    shift: 'Day',
                    license: 'PNP',
                    experience: 2,
                    salary: 15000,
                    duration: '6 months',
                    guards: [101, 103],
                    headGuard: 103
                }
                // more...
            ];

            const personnel = [{
                    id: 101,
                    name: 'Ramon Dela Cruz',
                    role: 'Security Guard'
                },
                {
                    id: 102,
                    name: 'Jose Garcia',
                    role: 'Security Guard'
                },
                {
                    id: 103,
                    name: 'Lito Ramos',
                    role: 'Head Guard'
                },
                {
                    id: 104,
                    name: 'Anna Reyes',
                    role: 'Security Guard'
                }
            ];

            function escapeHtml(s) {
                if (!s && s !== 0) return '';
                return String(s).replace(/[&<>"'`=\/]/g, ch => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#47;',
                '`': '&#96;',
                    '=': '&#61;'
                })[ch]);
            }

            (function() {
                // load from localStorage (if exists) otherwise use the in-memory clients already defined
                const storageKey = 'seekyu_clients';
                try {
                    const raw = localStorage.getItem(storageKey);
                    if (raw) {
                        // replace clients array if store exists
                        const parsed = JSON.parse(raw);
                        if (Array.isArray(parsed) && parsed.length) {
                            // assume `clients` variable exists in module scope — replace its contents
                            clients.length = 0;
                            parsed.forEach(c => clients.push(c));
                        }
                    }
                } catch (e) {
                    console.warn('Failed to load clients from storage', e);
                }

                function persistClients() {
                    try {
                        localStorage.setItem(storageKey, JSON.stringify(clients));
                    } catch (e) {
                        console.warn('Failed to save clients', e);
                    }
                }

                // updated renderClients (View button is now a link to client-profile.html?id=)
                function renderClients(filter = '') {
                    const tbody = $('#client_clientsTable');
                    if (!tbody) return;
                    tbody.innerHTML = '';
                    const q = String(filter || '').trim().toLowerCase();

                    if (!clients || clients.length === 0) {
                        tbody.innerHTML =
                            '<tr><td class="py-4 px-3 text-slate-500" colspan="7">No clients available.</td></tr>';
                        return;
                    }

                    clients.forEach((c, idx) => {
                        const hay = [c.contact, c.company, c.email, c.phone, c.jobTitle, c.location].join(
                            ' ').toLowerCase();
                        if (q && !hay.includes(q)) return;

                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-slate-50';
                        tr.innerHTML = `
        <td class="py-3 px-3 align-top">${idx + 1}</td>
        <td class="py-3 px-3 align-top font-medium">${escapeHtml(c.contact)}</td>
        <td class="py-3 px-3 align-top">${escapeHtml(c.company)}</td>
        <td class="py-3 px-3 align-top">${escapeHtml(c.phone || c.email || '')}</td>
        <td class="py-3 px-3 align-top">${escapeHtml(c.location || '')}</td>
        <td class="py-3 px-3 align-top">${Number(c.numGuards || 0)}</td>
        <td class="py-3 px-3 align-top">
          <div class="flex gap-2 items-center">
            <!-- VIEW: open new page with client id in query -->
            <a href="client-profile.html?id=${encodeURIComponent(c.id)}" class="px-3 py-1 rounded bg-slate-100 text-slate-700 text-sm inline-block">View</a>
            <!-- ASSIGN: open assign modal (keeps existing assign behaviour) -->
            <button data-id="${c.id}" class="client_btnAssign px-3 py-1 rounded bg-indigo-600 text-white text-sm">Assign</button>
          </div>
        </td>`;

                        tbody.appendChild(tr);
                    });

                    // re-bind assign buttons
                    $all('.client_btnAssign').forEach(b => b.onclick = () => openAssign(Number(b.dataset.id)));

                    // persist any changes (if other flows updated clients)
                    persistClients();
                }

                // expose persist function so other flows (edit page) can call ClientsModule.render()
                window.ClientsModule = window.ClientsModule || {};
                window.ClientsModule.render = renderClients;
                window.ClientsModule._persist = persistClients;

                // initial render (call existing module init)
                renderClients($('#client_search')?.value || '');

            })();

            function openEdit(id) {
                const c = getClient(id);
                if (!c) return;
                $('#client_editClientId').value = c.id;
                $('#client_editContactName').value = c.contact;
                $('#client_editCompany').value = c.company;
                $('#client_editEmail').value = c.email;
                $('#client_editPhone').value = c.phone;
                $('#client_editJobTitle').value = c.jobTitle || '';
                $('#client_editLocation').value = c.location || '';
                $('#client_editNumGuards').value = c.numGuards || '';
                $('#client_editShift').value = c.shift || '';
                $('#client_editLicense').value = c.license || '';
                $('#client_editExperience').value = c.experience || '';
                $('#client_editSalary').value = c.salary || '';
                $('#client_editDuration').value = c.duration || '';
                showModal('#client_editClientModal');
            }

            let currentAssignClient = null;

            function openAssign(id) {
                currentAssignClient = getClient(id);
                renderAssignLists();
                showModal('#client_assignModal');
            }

            function renderAssignLists() {
                const deployedEl = $('#client_deployedList'),
                    availableEl = $('#client_availableList');
                if (!deployedEl || !availableEl) return;
                deployedEl.innerHTML = '';
                availableEl.innerHTML = '';

                const deployed = (currentAssignClient.guards || []).map(gid => getPerson(gid)).filter(Boolean);
                if (deployed.length === 0) deployedEl.innerHTML =
                    '<div class="text-xs text-slate-500">No deployed personnel</div>';
                deployed.forEach(p => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center justify-between border rounded px-3 py-2 bg-white';
                    div.innerHTML =
                        `<div><div class="font-medium">${escapeHtml(p.name)}</div><div class="text-xs text-slate-500">${escapeHtml(p.role)}</div></div><div><button data-id="${p.id}" class="client_removeDeployed text-red-600 hover:text-red-800"><i class="fa fa-trash"></i></button></div>`;
                    deployedEl.appendChild(div);
                });

                const deployedIds = new Set(currentAssignClient.guards || []);
                personnel.filter(p => !deployedIds.has(p.id)).forEach(p => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center gap-2 border rounded px-3 py-2';
                    div.innerHTML =
                        `<input type="checkbox" data-id="${p.id}" class="client_availChk" /><div><div class="font-medium">${escapeHtml(p.name)}</div><div class="text-xs text-slate-500">${escapeHtml(p.role)}</div></div>`;
                    availableEl.appendChild(div);
                });

                Array.from(deployedEl.querySelectorAll('.client_removeDeployed')).forEach(btn => btn.onclick = () =>
                    removePersonnel(currentAssignClient.id, Number(btn.dataset.id)));
            }

            function assignSelected() {
                const chks = Array.from(root.querySelectorAll('.client_availChk'));
                const toAssign = chks.filter(c => c.checked).map(c => Number(c.dataset.id));
                if (toAssign.length === 0) {
                    alert('Select at least one guard to assign');
                    return;
                }
                currentAssignClient.guards = Array.from(new Set([...(currentAssignClient.guards || []), ...toAssign]));
                renderAssignLists();
                renderClients($('#client_search')?.value || '');
            }

            function removePersonnel(clientId, personId) {
                const c = getClient(clientId);
                if (!c) return;
                c.guards = (c.guards || []).filter(g => g !== personId);
                if (c.headGuard === personId) c.headGuard = null;
                renderAssignLists();
                renderClients($('#client_search')?.value || '');
            }

            function showModal(sel) {
                const el = document.querySelector(sel);
                if (!el) return;
                el.classList.remove('hidden');
                el.classList.add('flex');
            }

            function hideModal(sel) {
                const el = document.querySelector(sel);
                if (!el) return;
                el.classList.add('hidden');
                el.classList.remove('flex');
            }

            (function wireClosers() {
                const map = [
                    ['#client_closeView', '#client_viewClientModal'],
                    ['#client_closeView2', '#client_viewClientModal'],
                    ['#client_closeEdit', '#client_editClientModal'],
                    ['#client_cancelEditForm', '#client_editClientModal'],
                    ['#client_closeAssign', '#client_assignModal'],
                    ['#client_closeAssign2', '#client_assignModal']
                ];
                map.forEach(([btnSel, modalSel]) => {
                    const btn = document.querySelector(btnSel);
                    if (btn) btn.addEventListener('click', () => hideModal(modalSel));
                });
                ['#client_viewClientModal', '#client_editClientModal', '#client_assignModal'].forEach(s => {
                    const m = document.querySelector(s);
                    if (!m) return;
                    m.addEventListener('click', e => {
                        if (e.target === m) hideModal(s);
                    });
                });
            })();

            // Edit/create submit
            $('#client_editClientForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const idVal = $('#client_editClientId').value;
                const payload = {
                    contact: $('#client_editContactName').value.trim(),
                    company: $('#client_editCompany').value.trim(),
                    email: $('#client_editEmail').value.trim(),
                    phone: $('#client_editPhone').value.trim(),
                    jobTitle: $('#client_editJobTitle')?.value.trim() || '',
                    location: $('#client_editLocation').value.trim(),
                    numGuards: Number($('#client_editNumGuards').value || 0),
                    shift: $('#client_editShift').value.trim(),
                    license: $('#client_editLicense').value.trim(),
                    experience: Number($('#client_editExperience').value || 0),
                    salary: Number($('#client_editSalary').value || 0),
                    duration: $('#client_editDuration').value.trim()
                };

                if (!idVal) {
                    // create (in rare cases admin can create; but typically clients are added via account creation)
                    const newId = (clients.length ? Math.max(...clients.map(c => c.id)) + 1 : 1);
                    clients.push(Object.assign({
                        id: newId,
                        guards: [],
                        headGuard: null
                    }, payload));
                    renderClients($('#client_search')?.value || '');
                    hideModal('#client_editClientModal');
                    return;
                }

                const id = Number(idVal);
                const c = getClient(id);
                if (!c) return alert('Client not found');
                Object.assign(c, payload);
                renderClients($('#client_search')?.value || '');
                hideModal('#client_editClientModal');
            });

            $('#client_assignSelected').addEventListener('click', assignSelected);
            $('#client_search').addEventListener('input', e => renderClients(e.target.value));

            // Initialize
            renderClients();

            // PUBLIC API: call this from your account creation flow
            // accountObj should include at least: role (must be 'Client'), fullName/contact, companyName, email, phone, jobTitle, location, numGuards, shift, license, experience, salary, duration
            function addFromAccount(accountObj) {
                if (!accountObj || String(accountObj.role || '').toLowerCase() !== 'client') return null;
                const newId = (clients.length ? Math.max(...clients.map(c => c.id)) + 1 : 1);
                const client = {
                    id: newId,
                    contact: accountObj.contactName || accountObj.fullName || accountObj.name || '',
                    company: accountObj.companyName || accountObj.company || '',
                    email: accountObj.email || accountObj.username || '',
                    phone: accountObj.phone || '',
                    jobTitle: accountObj.jobTitle || accountObj.requestedRole || '',
                    location: accountObj.location || '',
                    numGuards: Number(accountObj.numGuards || accountObj.numberOfGuards || 0),
                    shift: accountObj.shiftSchedule || accountObj.shift || '',
                    license: accountObj.licenseRequirement || accountObj.license || '',
                    experience: Number(accountObj.experienceRequired || accountObj.experience || 0),
                    salary: Number(accountObj.salaryOffer || accountObj.salary || 0),
                    duration: accountObj.contractDuration || accountObj.duration || '',
                    guards: [],
                    headGuard: null
                };
                clients.push(client);
                renderClients($('#client_search')?.value || '');
                return client; // return created client object for the caller if needed
            }

            // expose module API
            window.ClientsModule = {
                render: renderClients,
                addFromAccount,
                openAssign
            };
        })();
    </script>
</body>

</html>
