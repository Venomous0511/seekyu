@extends('layouts.dashboard')

@section('title', 'SeekYu - Super Admin Dashboard')

@section('dashboard-content')

    <!-- TODO: CREATE A PAGE FOR ACCOUNT MANAGEMENT -->

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
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Super Admin Management Dashboard</h1>
                <p class="text-gray-600 mb-6">Welcome to your security management portal. Monitor and manage all security
                    operations from here.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                                <i class="fas fa-user-shield text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-lg font-semibold text-gray-800">{{ $activeGuards }}</h2>
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
                                <h2 class="text-lg font-semibold text-gray-800">{{ $activeClients }}</h2>
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
                                <h2 class="text-lg font-semibold text-gray-800">{{ $pendingRequests }}</h2>
                                <p class="text-sm text-gray-600">Pending Requests</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
                <div class="border-t border-gray-100 pt-4">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-user-plus text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-800"><span class="font-medium">John Doe</span> registered as a new security
                                guard</p>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Other Sections (initially hidden) -->

        <!-- ACCOUNTS MANAGEMENT - Replace existing #accounts block with this -->
        <div id="accounts" class="content-section">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Account Management</h1>
                    <div class="flex gap-2">
                        <button id="accountsTabCreate" class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">Create
                            Account</button>
                        <button id="accountsTabView" class="px-3 py-2 rounded bg-slate-200 text-gray-800 text-sm">View
                            Accounts</button>
                        <button id="accountsTabRemoved" class="px-3 py-2 rounded bg-slate-200 text-gray-800 text-sm">Removed
                            Accounts</button>
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
                                <option>Super Admin</option>
                                <option>Admin</option>
                                <option>HR</option>
                                <option>Security Guard</option>
                                <option>Head Guard</option>
                                <option>Client</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600">Password</label>
                            <input id="password" type="password" class="w-full px-3 py-2 rounded border bg-slate-50"
                                required />
                        </div>

                        <div class="md:col-span-2 flex gap-2 mt-2">
                            <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white">Create
                                Account</button>
                            <button type="button" id="resetCreate" class="px-4 py-2 rounded bg-slate-200">Reset</button>
                        </div>
                    </form>
                </div>

                <!-- View Accounts -->
                <div id="view-accounts-section" class="hidden mt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <input id="accountsSearch" placeholder="Search by name, username or role..."
                            class="flex-1 px-3 py-2 rounded border bg-slate-50" />
                        <button id="refreshAccounts" class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
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
                            <button type="button" id="cancelEdit" class="px-4 py-2 rounded bg-slate-200">Cancel</button>
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
                            <button type="button" id="cancelPass" class="px-4 py-2 rounded bg-slate-200">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- USER ACTIVITY (replace existing #user-activity block) -->
        <div id="user-activity" class="content-section">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">View User Activity</h1>
                        <p class="text-gray-600">Audit trail of user actions: logins, logouts, password attempts, profile
                            changes, etc.</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <button id="activityExport" class="px-3 py-2 rounded bg-slate-100 border">Export (JSON)</button>
                        <button id="activityRefresh" class="px-3 py-2 rounded bg-slate-100 border">Refresh</button>
                    </div>
                </div>

                <!-- filters -->
                <div class="flex flex-wrap gap-3 mb-4">
                    <input id="activitySearch" type="text" placeholder="Search (user, id, ip, details...)"
                        class="flex-1 min-w-[220px] px-3 py-2 rounded border bg-slate-50" />
                    <select id="activityRole" class="px-3 py-2 rounded border bg-slate-50">
                        <option value="">All Roles</option>
                        <option>Super Admin</option>
                        <option>Admin</option>
                        <option>HR</option>
                        <option>Client</option>
                        <option>Applicant</option>
                        <option>Security Guard</option>
                        <option>Head Guard</option>
                    </select>
                    <select id="activityUser" class="px-3 py-2 rounded border bg-slate-50">
                        <option value="">All Users</option>
                    </select>
                    <select id="activityType" class="px-3 py-2 rounded border bg-slate-50">
                        <option value="">All Types</option>
                        <option>Login</option>
                        <option>Logout</option>
                        <option>Failed Login</option>
                        <option>Password Change Attempt</option>
                        <option>Password Changed</option>
                        <option>Edit Profile</option>
                        <option>Other</option>
                    </select>
                    <input id="activityFrom" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                    <input id="activityTo" type="date" class="px-3 py-2 rounded border bg-slate-50" />
                </div>

                <!-- table -->
                <div class="overflow-x-auto bg-white rounded border">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50 text-left text-slate-600">
                            <tr>
                                <th class="py-3 px-3">Time</th>
                                <th class="py-3 px-3">User</th>
                                <th class="py-3 px-3">Role</th>
                                <th class="py-3 px-3">Event</th>
                                <th class="py-3 px-3">Source</th>
                                <th class="py-3 px-3">Details</th>
                                <th class="py-3 px-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="activityTable" class="divide-y"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Details Modal -->
        <div id="activityModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
            <div class="bg-white rounded-lg max-w-3xl w-full p-5 overflow-y-auto max-h-[90vh]">
                <div class="flex items-start justify-between mb-3">
                    <h2 class="text-lg font-semibold">Activity Details</h2>
                    <button id="closeActivityModal" class="text-slate-500">✕</button>
                </div>
                <div id="activityDetails" class="text-sm text-slate-700 space-y-3"></div>
                <div class="mt-4 flex justify-end gap-2">
                    <button id="activityDeleteBtn" class="px-3 py-2 rounded bg-red-600 text-white">Delete</button>
                    <button id="activityCloseBtn" class="px-3 py-2 rounded bg-slate-200">Close</button>
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
                        <button id="inboxBtn" class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">Inbox</button>
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
                                            <button class="viewBtn text-blue-600 hover:underline" data-sender="Admin"
                                                data-recipient="You" data-subject="Welcome to SeekYu"
                                                data-date="2025-09-13"
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
        <div id="message-popup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
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

        <!-- Notification Section -->
        <div id="notification" class="content-section">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Notifications</h1>
                <p class="text-gray-600">Manage system notifications and alerts.</p>
            </div>
        </div>
        <!-- Add other sections similarly -->

    </div>

    <!-- Popup Modal -->
    <div id="popup-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800" id="popup-title">Popup Title</h3>
                <p class="text-gray-600 mt-2" id="popup-content">This is the popup content. You can put any information
                    here.</p>
            </div>
            <div class="flex justify-end p-6 border-t border-gray-200">
                <button id="close-popup" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Close</button>
            </div>
        </div>
    </div>
@endsection
