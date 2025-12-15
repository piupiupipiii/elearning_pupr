<header class="header">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo KemenPU" class="logo">
    </div>

    @if(!request()->routeIs('login') && !request()->routeIs('signup'))
    <div class="icon-container">
        @auth
            <!-- User Icon: Shows dropdown with name and logout -->
            <div class="icon-wrapper" onclick="toggleUserMenu()">
                <img src="{{ asset('images/icon/profile.png') }}" alt="User" class="icon">
                <div class="user-dropdown" id="userDropdown">
                    <span>{{ Auth::user()->name }}</span>
                    <a href="{{ route('profile') }}" class="profile-button">Profile</a>
                    <button type="button" class="logout-button" onclick="event.stopPropagation(); showLogoutConfirm();">Logout</button>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @else
            <!-- User Icon: Links to login page -->
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/icon/profile.png') }}" alt="User" class="icon">
            </a>
        @endauth

        <!-- Question Icon: No-op for now -->
        <img src="{{ asset('images/icon/qna.png') }}" alt="Question" class="icon">
    </div>
    @endif
</header>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="logout-modal">
    <div class="logout-modal-content">
        <h3>Konfirmasi Logout</h3>
        <p>Apakah Anda yakin akan keluar?</p>
        <div class="logout-modal-buttons">
            <button class="logout-btn-no" onclick="closeLogoutModal()">Tidak</button>
            <button class="logout-btn-yes" onclick="confirmLogout()">Ya</button>
        </div>
    </div>
</div>

<style>
/* Override any global button styles for logout button */
.logout-button,
button.logout-button,
.user-dropdown .logout-button {
    background: #dc3545 !important;
    color: white !important;
    border: none !important;
    cursor: pointer !important;
    pointer-events: auto !important;
    z-index: 10001 !important;
}

.logout-button:hover,
button.logout-button:hover,
.user-dropdown .logout-button:hover {
    background: #c82333 !important;
    color: white !important;
}

/* Logout Modal Styles */
.logout-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.logout-modal-content {
    background: white;
    margin: 15% auto;
    padding: 30px 40px;
    border-radius: 16px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: slideDown 0.4s ease;
    text-align: center;
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.logout-modal-content h3 {
    color: #1E40AF;
    font-size: 24px;
    margin-bottom: 15px;
    font-weight: 700;
}

.logout-modal-content p {
    color: #4B5563;
    font-size: 16px;
    margin-bottom: 25px;
}

.logout-modal-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.logout-btn-no,
.logout-btn-yes {
    padding: 12px 35px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.logout-btn-no {
    background: #E5E7EB;
    color: #374151;
}

.logout-btn-no:hover {
    background: #D1D5DB;
    transform: translateY(-2px);
}

.logout-btn-yes {
    background: linear-gradient(135deg, #DC2626, #EF4444);
    color: white;
}

.logout-btn-yes:hover {
    background: linear-gradient(135deg, #B91C1C, #DC2626);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
}
</style>

<script>
function showLogoutConfirm() {
    document.getElementById('logoutModal').style.display = 'block';
    // Close user dropdown when modal opens
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.classList.remove('show');
    }
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function confirmLogout() {
    const form = document.getElementById('logoutForm');
    if (form) {
        form.submit();
    }
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('logoutModal');
    if (event.target == modal) {
        closeLogoutModal();
    }
}
</script>
