<aside id="sidebar-nav">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="dashboard" class="nav-link active">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="users" class="nav-link">
                <span class="nav-icon">👥</span>
                <span>Users</span>
            </a>
        </li>
        
        <!-- Tour Packages Section -->
        <li class="nav-item" style="margin-top: 15px;">
            <a href="tour-packages" class="nav-link">
                <span class="nav-icon">📦</span>
                <span>Tour Packages</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="golden-triangle" class="nav-link">
                <span class="nav-icon">🔺</span>
                <span>Golden Triangle</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="tajmahal-tours" class="nav-link">
                <span class="nav-icon">🕌</span>
                <span>Tajmahal Tours</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="rajasthan-tour" class="nav-link">
                <span class="nav-icon">🏰</span>
                <span>Rajasthan Tours</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="himachal-packages" class="nav-link">
                <span class="nav-icon">🏔️</span>
                <span>Himachal Packages</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="pilgrimage-package" class="nav-link">
                <span class="nav-icon">🙏</span>
                <span>Pilgrimage Tours</span>
            </a>
        </li>
        
        <!-- Media Section -->
        <li class="nav-item" style="margin-top: 15px;">
            <a href="gallery" class="nav-link">
                <span class="nav-icon">🖼️</span>
                <span>Gallery</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="videos" class="nav-link">
                <span class="nav-icon">🎥</span>
                <span>Videos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="reviews" class="nav-link">
                <span class="nav-icon">⭐</span>
                <span>Client Reviews</span>
            </a>
        </li>
        
        <!-- Vehicle & Settings -->
        <li class="nav-item" style="margin-top: 15px;">
            <a href="cars" class="nav-link">
                <span class="nav-icon">🚗</span>
                <span>Cars/Vehicles</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="contact-info" class="nav-link">
                <span class="nav-icon">📞</span>
                <span>Contact Info</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="footer-content" class="nav-link">
                <span class="nav-icon">📄</span>
                <span>Footer Content</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="meta-tags" class="nav-link">
                <span class="nav-icon">🏷️</span>
                <span>Meta Tags</span>
            </a>
        </li>
        
        <li class="nav-item" style="margin-top: 30px;">
            <a href="logout" class="nav-link">
                <span class="nav-icon">🚪</span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>

<script>
// Highlight active link based on current page
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const links = document.querySelectorAll('#sidebar-nav .nav-link');
    
    links.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage || (currentPage === '' && href === 'dashboard')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});
</script>
