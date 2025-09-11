<!-- Show all the User Table -->
<div class="space-y-6">
    <h2 class="text-xl font-semibold">Account Management</h2>

    <header class="flex justify-between items-center">
        <button
            onclick="toggleModal('createAccountModal')"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white cursor-pointer">
            Create Account
        </button>


        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search Box -->
            <div class="flex items-center gap-2 w-full md:w-auto">
                <input type="text" id="searchBox"
                    placeholder="Search by Name, Email, or Role..."
                    class="px-3 py-2 rounded bg-gray-900 text-white w-full md:w-64 focus:outline-none">
            </div>

            <!-- Role Filter -->
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <label for="roleFilter" class="text-sm">Filter by Role:</label>
                <select id="roleFilter" class="px-3 py-2 rounded bg-gray-900 text-white">
                    <option value="">All Roles</option>
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="hr">HR</option>
                    <option value="head_security_guard">Head Security Guard</option>
                    <option value="security_guard">Security Guard</option>
                    <option value="client">Client</option>
                    <option value="applicant">Applicant</option>
                </select>
            </div>
        </div>
    </header>

    <!-- Table for Users -->
    <table class="w-full border border-gray-700 text-sm mt-4">
        <thead class="bg-gray-900">
            <tr>
                <th class="p-2 border border-gray-700 text-left">Name</th>
                <th class="p-2 border border-gray-700 text-left">Email</th>
                <th class="p-2 border border-gray-700 text-left">Role</th>
                <th class="p-2 border border-gray-700 text-left">Role ID</th>
                <th class="p-2 border border-gray-700 text-left">Actions</th>
            </tr>
        </thead>
        <tbody id="usersTableBody">
            @foreach ($users as $user)
            <tr data-role="{{ $user->role }}">
                <td class="p-2 border border-gray-700">{{ $user->name }}</td>
                <td class="p-2 border border-gray-700">{{ $user->email }}</td>
                <td class="p-2 border border-gray-700">{{ ucfirst($user->role) }}</td>
                <td class="p-2 border border-gray-700">{{ $user->role_id }}</td>
                <td class="p-2 border border-gray-700 flex gap-2">
                    <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                        class="px-2 py-1 bg-yellow-500 rounded text-white cursor-pointer">Edit</button>

                    <button onclick="openPasswordModal('{{ $user->id }}')"
                        class="px-2 py-1 bg-indigo-500 rounded text-white cursor-pointer">Change Password</button>

                    <button
                        data-url="{{ route('accounts.destroy', $user->id) }}"
                        onclick="confirmDelete(this.dataset.url)"
                        class="px-2 py-1 bg-red-600 rounded text-white cursor-pointer">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Account Modal -->
<div id="createAccountModal"
    class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-gray-800 text-white w-full max-w-md p-6 rounded-lg shadow-lg relative">

        <!-- Close Button -->
        <button onclick="toggleModal('createAccountModal')"
            class="absolute top-5 right-6 text-gray-400 text-2xl hover:text-red-500 cursor-pointer duration-300">
            &times;
        </button>

        <h2 class="text-xl font-semibold mb-4">Create New Account</h2>

        <form method="POST" action="{{ route('accounts.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm mb-1">Role ID</label>
                <input type="text" name="role_id" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Role</label>
                <select name="role" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600" required>
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="hr">HR</option>
                    <option value="security_guard">Security Guard</option>
                    <option value="head_security_guard">Head Security Guard</option>
                    <option value="client">Client</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Name</label>
                <input type="text" name="name" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="toggleModal('createAccountModal')"
                    class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-500 cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded cursor-pointer">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal"
    class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-gray-800 text-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4">Edit User</h3>
        <form id="editUserForm">
            @csrf
            <input type="hidden" id="editUserId">
            <div class="mb-2">
                <label>Name</label>
                <input type="text" id="editUserName" class="w-full px-3 py-2 rounded bg-gray-900 text-white">
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" id="editUserEmail" class="w-full px-3 py-2 rounded bg-gray-900 text-white">
            </div>
            <div class="mb-2">
                <label>Role</label>
                <select id="editUserRole" class="w-full px-3 py-2 rounded bg-gray-900 text-white">
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="hr">HR</option>
                    <option value="head_security_guard">Head Security Guard</option>
                    <option value="security_guard">Security Guard</option>
                    <option value="client">Client</option>
                    <option value="applicant">Applicant</option>
                </select>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="toggleModal('editUserModal')" class="px-3 py-1 bg-gray-600 rounded cursor-pointer">Cancel</button>
                <button type="submit" class="px-3 py-1 bg-green-600 rounded text-white cursor-pointer">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal"
    class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-gray-800 text-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4">Change Password</h3>
        <form id="changePasswordForm">
            @csrf
            <input type="hidden" id="passwordUserId">
            <div class="mb-2">
                <label>New Password</label>
                <input type="password" id="newPassword" class="w-full px-3 py-2 rounded bg-gray-900 text-white">
            </div>
            <div class="mb-2">
                <label>Confirm Password</label>
                <input type="password" id="confirmPassword" class="w-full px-3 py-2 rounded bg-gray-900 text-white">
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="toggleModal('changePasswordModal')" class="px-3 py-1 bg-gray-600 rounded cursor-pointer">Cancel</button>
                <button type="submit" class="px-3 py-1 bg-green-600 rounded text-white cursor-pointer">Change</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal"
    class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-gray-800 text-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4 text-white">Confirm Delete</h3>
        <p class="mb-4 text-gray-300">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="flex justify-end gap-2">
            <button onclick="toggleModal('deleteModal')" class="px-3 py-1 bg-gray-600 rounded text-white cursor-pointer">Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-600 rounded text-white cursor-pointer">Delete</button>
            </form>
        </div>
    </div>
</div>