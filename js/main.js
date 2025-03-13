
// Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const navLinks = document.getElementById('nav-links');
    const navLinkItems = document.querySelectorAll('.nav-link');
    
    // Scroll event for navbar
    window.addEventListener('scroll', function() {
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Initial check for navbar
    if (window.scrollY > 10) {
        navbar.classList.add('scrolled');
    }
    
    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.toggle('active');
        this.classList.toggle('active');
        
        if (this.classList.contains('active')) {
            this.innerHTML = '<i class="fas fa-times"></i>';
        } else {
            this.innerHTML = '<i class="fas fa-bars"></i>';
        }
    });
    
    // Close mobile menu when clicking on a link
    navLinkItems.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.classList.remove('active');
            mobileMenuBtn.classList.remove('active');
            mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        });
    });
    
    // Portfolio filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            portfolioItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 0);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Scroll animation for elements
    const scrollElements = document.querySelectorAll('.service-card, .portfolio-item, .contact-card');
    
    const elementInView = (el, scrollOffset = 100) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop <= (window.innerHeight || document.documentElement.clientHeight) - scrollOffset
        );
    };
    
    const displayScrollElement = (element) => {
        element.classList.add('scrolled');
    };
    
    const hideScrollElement = (element) => {
        element.classList.remove('scrolled');
    };
    
    const handleScrollAnimation = () => {
        scrollElements.forEach(el => {
            if (elementInView(el, 100)) {
                displayScrollElement(el);
            } else {
                hideScrollElement(el);
            }
        });
    };
    
    window.addEventListener('scroll', () => {
        handleScrollAnimation();
    });
    
    // Initialize scroll animation
    handleScrollAnimation();
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
