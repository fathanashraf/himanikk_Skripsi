{{-- HEADER NAVBAR --}}
<div class="navbar bg-base-100 shadow-xl sticky top-0 z-50 backdrop-blur border-b border-base-200/50">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <i class="fas fa-bars text-2xl"></i>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-64">
                <li><a href="/dashboard" class="font-semibold"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                <li class="menu-title"><span>Management</span></li>
                <li><a href="/users" class="font-semibold"><i class="fas fa-users mr-2"></i>Users</a></li>
                <li><a href="/roles" class="font-semibold"><i class="fas fa-shield-alt mr-2"></i>Roles</a></li>
                <li><a href="/permissions" class="font-semibold"><i class="fas fa-key mr-2"></i>Permissions</a></li>
                <li class="menu-title"><span>Content</span></li>
                <li><a href="/posts" class="font-semibold"><i class="fas fa-newspaper mr-2"></i>Posts</a></li>
                <li><a href="/categories" class="font-semibold"><i class="fas fa-folder mr-2"></i>Categories</a></li>
                <li><a href="/events" class="font-semibold"><i class="fas fa-calendar mr-2"></i>Events</a></li>
                <li class="menu-title"><span>System</span></li>
                <li><a href="/logs" class="font-semibold"><i class="fas fa-file-alt mr-2"></i>Activity Logs</a></li>
                <li><a href="/backups" class="font-semibold"><i class="fas fa-database mr-2"></i>Backups</a></li>
                <li><a href="/settings" class="font-semibold"><i class="fas fa-cog mr-2"></i>Settings</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost normal-case text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
            HIMANIKKA
        </a>
    </div>
    
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 gap-1">
            <li><a href="/dashboard" class="font-semibold"><i class="fas fa-chart-line mr-1"></i>Dashboard</a></li>
            <li class="dropdown dropdown-hover">
                <a tabindex="0" class="font-semibold">Management<i class="fas fa-chevron-down ml-1"></i></a>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-1">
                    <li><a href="/users"><i class="fas fa-users mr-2"></i>Users</a></li>
                    <li><a href="/roles"><i class="fas fa-shield-alt mr-2"></i>Roles</a></li>
                    <li><a href="/permissions"><i class="fas fa-key mr-2"></i>Permissions</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-hover">
                <a tabindex="0" class="font-semibold">Content<i class="fas fa-chevron-down ml-1"></i></a>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-1">
                    <li><a href="/posts"><i class="fas fa-newspaper mr-2"></i>Posts</a></li>
                    <li><a href="/categories"><i class="fas fa-folder mr-2"></i>Categories</a></li>
                    <li><a href="/events"><i class="fas fa-calendar mr-2"></i>Events</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-hover">
                <a tabindex="0" class="font-semibold">System<i class="fas fa-chevron-down ml-1"></i></a>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-1">
                    <li><a href="/logs"><i class="fas fa-file-alt mr-2"></i>Activity Logs</a></li>
                    <li><a href="/backups"><i class="fas fa-database mr-2"></i>Backups</a></li>
                    <li><a href="/settings"><i class="fas fa-cog mr-2"></i>Settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
    
    <div class="navbar-end gap-2">
        {{-- SEARCH --}}
        <div class="form-control hidden md:flex">
            <div class="relative">
                <input type="text" placeholder="Search users, posts..." class="input input-bordered input-sm w-64 max-w-xs pl-10">
                <i class="fas fa-search absolute inset-y-0 left-3 text-base-content/50 pointer-events-none"></i>
            </div>
        </div>
        
        {{-- NOTIFICATIONS --}}
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle relative">
                <i class="fas fa-bell text-xl"></i>
                <span class="badge badge-warning badge-sm absolute -top-1 -right-1 h-4 w-4 grid place-items-center text-xs">3</span>
            </label>
            <div tabindex="0" class="menu dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-96">
                <div class="flex justify-between items-center mb-3 pb-2 border-b border-base-200">
                    <h3 class="font-semibold">Notifications</h3>
                    <a href="#" class="text-sm text-primary hover:text-primary/80">Mark all read</a>
                </div>
                <div class="menu-title">
                    <span>Recent activity</span>
                </div>
                <a class="justify-between mb-2 p-3 hover:bg-base-200 rounded-lg transition-all">
                    <div>New user registered</div>
                    <span class="text-xs text-base-content/60">2 mins ago</span>
                </a>
                <a class="justify-between mb-2 p-3 hover:bg-base-200 rounded-lg transition-all">
                    <div>Role updated successfully</div>
                    <span class="text-xs text-base-content/60">1 hour ago</span>
                </a>
                <a class="justify-between p-3 hover:bg-base-200 rounded-lg transition-all">
                    <div>Backup completed</div>
                    <span class="text-xs text-base-content/60">3 hours ago</span>
                </a>
                <div class="pt-2 mt-2 border-t border-base-200 text-center">
                    <a href="/notifications" class="text-primary text-sm hover:text-primary/80">View all notifications</a>
                </div>
            </div>
        </div>
        
        {{-- DARK MODE TOGGLE --}}
        <button @click="$store.darkMode.toggle()" 
                class="btn btn-ghost btn-circle swap swap-rotate transition-all"
                aria-label="Toggle dark mode">
            <!-- Sun icon (visible in light mode) -->
            <i class="swap-on fas fa-sun text-xl"></i>
            <!-- Moon icon (visible in dark mode) -->
            <i class="swap-off fas fa-moon text-xl"></i>
        </button>
        
        {{-- PROFILE --}}
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-1">
                    <img src="https://i.pravatar.cc/40" alt="Profile" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li class="menu-title">
                    <span>Super Admin</span>
                </li>
                <li>
                    <a class="justify-between">
                        <span>Admin Panel</span>
                        <span class="badge badge-primary">Active</span>
                    </a>
                </li>
                <li><a><i class="fas fa-user mr-2"></i>Profile</a></li>
                <li><a><i class="fas fa-cog mr-2"></i>Settings</a></li>
                <li><a><i class="fas fa-shield-alt mr-2"></i>Role Management</a></li>
                <li class="divider"></li>
                <li><a href="/logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</div>
