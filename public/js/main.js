// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Navbar scroll effect
  const navbar = document.querySelector('.navbar');
  
  // Function to handle navbar scroll effect
  function handleNavbarScroll() {
    if (window.scrollY > 100) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }

  // Add scroll event listener if navbar exists
  if (navbar) {
    window.addEventListener('scroll', handleNavbarScroll);
    // Initialize on page load
    handleNavbarScroll();
  }

  // Initialize favorite buttons
  const favoriteButtons = document.querySelectorAll('.favorite-btn');
  favoriteButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const icon = this.querySelector('i');
      
      if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        this.classList.add('active');
        
        // Show notification (you could implement a toast notification here)
        showNotification('Property added to favorites!', 'success');
      } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        this.classList.remove('active');
        
        // Show notification
        showNotification('Property removed from favorites.', 'info');
      }
    });
  });

  // Property filter toggle (for property listings page)
  const filterToggle = document.querySelector('.filter-toggle');
  const filterSidebar = document.querySelector('.filter-sidebar');
  
  if (filterToggle && filterSidebar) {
    filterToggle.addEventListener('click', function() {
      filterSidebar.classList.toggle('show');
      
      // Change icon
      const icon = this.querySelector('i');
      if (icon.classList.contains('fa-sliders')) {
        icon.classList.remove('fa-sliders');
        icon.classList.add('fa-times');
      } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-sliders');
      }
    });
  }

  // Price range slider (for property listings page)
  const priceRange = document.getElementById('price-range');
  const priceMin = document.getElementById('price-min');
  const priceMax = document.getElementById('price-max');
  
  if (priceRange && priceMin && priceMax) {
    const min = parseInt(priceRange.getAttribute('min'));
    const max = parseInt(priceRange.getAttribute('max'));
    const step = parseInt(priceRange.getAttribute('step')) || 100;
    
    // Initialize noUiSlider if available
    if (window.noUiSlider) {
      noUiSlider.create(priceRange, {
        start: [min, max],
        connect: true,
        step: step,
        range: {
          'min': min,
          'max': max
        },
        format: {
          to: function (value) {
            return Math.round(value);
          },
          from: function (value) {
            return Number(value);
          }
        }
      });
      
      priceRange.noUiSlider.on('update', function (values, handle) {
        const value = values[handle];
        if (handle === 0) {
          priceMin.value = value;
        } else {
          priceMax.value = value;
        }
      });
    }
  }

  // Property Gallery (for property detail page)
  const mainImage = document.querySelector('.property-main-image img');
  const thumbnails = document.querySelectorAll('.property-thumbnail');
  
  if (mainImage && thumbnails.length > 0) {
    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', function() {
        const newSrc = this.querySelector('img').getAttribute('src');
        
        // Remove active class from all thumbnails
        thumbnails.forEach(item => item.classList.remove('active'));
        
        // Add active class to clicked thumbnail
        this.classList.add('active');
        
        // Fade out main image, change src, fade in
        mainImage.style.opacity = 0;
        setTimeout(() => {
          mainImage.setAttribute('src', newSrc);
          mainImage.style.opacity = 1;
        }, 300);
      });
    });
  }

  // Login/Register form toggle
  const loginTab = document.getElementById('login-tab');
  const registerTab = document.getElementById('register-tab');
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');
  
  if (loginTab && registerTab && loginForm && registerForm) {
    loginTab.addEventListener('click', function(e) {
      e.preventDefault();
      loginTab.classList.add('active');
      registerTab.classList.remove('active');
      loginForm.classList.add('show', 'active');
      registerForm.classList.remove('show', 'active');
    });
    
    registerTab.addEventListener('click', function(e) {
      e.preventDefault();
      registerTab.classList.add('active');
      loginTab.classList.remove('active');
      registerForm.classList.add('show', 'active');
      loginForm.classList.remove('show', 'active');
    });
  }

  // Newsletter subscription
  const newsletterForm = document.querySelector('.newsletter-form');
  
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      
      // Here you would normally make an API call to subscribe the user
      // For now, just show a success notification
      if (email) {
        showNotification('Thanks for subscribing!', 'success');
        this.reset();
      }
    });
  }

  // Notification helper function
  function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
      <div class="notification-content">
        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i>
        <span>${message}</span>
      </div>
      <button class="notification-close">
        <i class="fas fa-times"></i>
      </button>
    `;
    
    // Add to DOM
    document.body.appendChild(notification);
    
    // Add visible class after a small delay (for animation)
    setTimeout(() => {
      notification.classList.add('visible');
    }, 10);
    
    // Add close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
      notification.classList.remove('visible');
      setTimeout(() => {
        notification.remove();
      }, 300); // Wait for transition to complete
    });
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
      if (notification.parentNode) {
        notification.classList.remove('visible');
        setTimeout(() => {
          if (notification.parentNode) {
            notification.remove();
          }
        }, 300);
      }
    }, 5000);
  }

  // Mobile menu close on click outside
  document.addEventListener('click', function(e) {
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navbarToggler = document.querySelector('.navbar-toggler');
    
    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
      if (!navbarCollapse.contains(e.target) && !navbarToggler.contains(e.target)) {
        // Close the menu by clicking the toggler
        navbarToggler.click();
      }
    }
  });

  // Initialize animations for elements with .animate-on-scroll class
  const animatedElements = document.querySelectorAll('.animate-on-scroll');
  
  if (animatedElements.length > 0) {
    // Check if element is in viewport
    function isInViewport(element) {
      const rect = element.getBoundingClientRect();
      return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
        rect.bottom >= 0
      );
    }
    
    // Add animation class when element is in viewport
    function checkAnimations() {
      animatedElements.forEach(element => {
        if (isInViewport(element) && !element.classList.contains('animated')) {
          element.classList.add('animated');
        }
      });
    }
    
    // Run on scroll and on page load
    window.addEventListener('scroll', checkAnimations);
    checkAnimations();
  }

  // Add scroll-to-top button functionality
  const scrollTopBtn = document.querySelector('.scroll-top');
  
  if (scrollTopBtn) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 500) {
        scrollTopBtn.classList.add('visible');
      } else {
        scrollTopBtn.classList.remove('visible');
      }
    });
    
    scrollTopBtn.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});

// Add a class to body when page is fully loaded (for transition effects)
window.addEventListener('load', function() {
  document.body.classList.add('loaded');
  
  // Initialize smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      
      // Skip if just "#"
      if (href === '#') return;
      
      const target = document.querySelector(href);
      
      if (target) {
        e.preventDefault();
        window.scrollTo({
          top: target.offsetTop - 80, // Adjust for header height
          behavior: 'smooth'
        });
      }
    });
  });
});