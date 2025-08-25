// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Property view switcher
  const gridViewBtn = document.querySelector('[data-view="grid"]');
  const listViewBtn = document.querySelector('[data-view="list"]');
  const propertiesContainer = document.querySelector('.properties-grid');
  
  if (gridViewBtn && listViewBtn && propertiesContainer) {
    gridViewBtn.addEventListener('click', function() {
      listViewBtn.classList.remove('active');
      gridViewBtn.classList.add('active');
      propertiesContainer.classList.remove('properties-list');
      propertiesContainer.classList.add('properties-grid');
      
      // Update the layout of property cards
      updatePropertyCardLayout('grid');
    });
    
    listViewBtn.addEventListener('click', function() {
      gridViewBtn.classList.remove('active');
      listViewBtn.classList.add('active');
      propertiesContainer.classList.remove('properties-grid');
      propertiesContainer.classList.add('properties-list');
      
      // Update the layout of property cards
      updatePropertyCardLayout('list');
    });
    
    function updatePropertyCardLayout(viewType) {
      const propertyCards = document.querySelectorAll('.property-card');
      
      propertyCards.forEach(card => {
        if (viewType === 'list') {
          // Make changes for list view
          const img = card.querySelector('.property-img');
          const info = card.querySelector('.property-info');
          
          card.style.flexDirection = 'row';
          img.style.width = '35%';
          img.style.paddingTop = '0';
          img.style.minHeight = '220px';
          info.style.width = '65%';
        } else {
          // Reset to grid view
          const img = card.querySelector('.property-img');
          const info = card.querySelector('.property-info');
          
          card.style.flexDirection = '';
          img.style.width = '';
          img.style.paddingTop = '';
          img.style.minHeight = '';
          info.style.width = '';
        }
      });
    }
  }
  
  // Filter toggle for mobile
  const filterToggle = document.querySelector('.filter-toggle');
  const filterSidebar = document.querySelector('.filter-sidebar');
  const body = document.body;
  
  if (filterToggle && filterSidebar) {
    // Create overlay for mobile filter
    const overlay = document.createElement('div');
    overlay.className = 'filter-overlay';
    document.body.appendChild(overlay);
    
    filterToggle.addEventListener('click', function() {
      filterSidebar.classList.toggle('show');
      overlay.classList.toggle('show');
      body.classList.toggle('no-scroll');
      
      // Toggle icon
      const icon = this.querySelector('i');
      if (icon.classList.contains('fa-sliders')) {
        icon.classList.remove('fa-sliders');
        icon.classList.add('fa-times');
      } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-sliders');
      }
    });
    
    // Close filter on overlay click
    overlay.addEventListener('click', function() {
      filterSidebar.classList.remove('show');
      overlay.classList.remove('show');
      body.classList.remove('no-scroll');
      
      // Reset icon
      const icon = filterToggle.querySelector('i');
      icon.classList.remove('fa-times');
      icon.classList.add('fa-sliders');
    });
    
    // Close button functionality
    const filterClose = document.querySelector('.filter-close');
    if (filterClose) {
      filterClose.addEventListener('click', function() {
        filterSidebar.classList.remove('show');
        overlay.classList.remove('show');
        body.classList.remove('no-scroll');
        
        // Reset icon
        const icon = filterToggle.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-sliders');
      });
    }
  }
  
  // Price Range inputs synchronization
  const priceMin = document.getElementById('price-min');
  const priceMax = document.getElementById('price-max');
  
  if (priceMin && priceMax) {
    priceMin.addEventListener('input', function() {
      if (parseInt(priceMin.value) > parseInt(priceMax.value)) {
        priceMax.value = priceMin.value;
      }
    });
    
    priceMax.addEventListener('input', function() {
      if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
        priceMin.value = priceMax.value;
      }
    });
  }
  
  // Filter form reset
  const resetFilterBtn = document.querySelector('.filter-actions button:last-child');
  const filterForm = document.querySelector('.filter-sidebar');
  
  if (resetFilterBtn && filterForm) {
    resetFilterBtn.addEventListener('click', function() {
      // Reset all checkboxes
      const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        checkbox.checked = false;
      });
      
      // Reset radio buttons to first option
      const radioGroups = filterForm.querySelectorAll('.btn-group');
      radioGroups.forEach(group => {
        const firstRadio = group.querySelector('input[type="radio"]');
        if (firstRadio) {
          firstRadio.checked = true;
        }
      });
      
      // Reset price inputs
      if (priceMin && priceMax) {
        priceMin.value = '';
        priceMax.value = '';
      }
      
      // Show confirmation
      showNotification('Filters have been reset.', 'info');
    });
  }
  
  // Apply Filters
  const applyFilterBtn = document.querySelector('.filter-actions button:first-child');
  
  if (applyFilterBtn) {
    applyFilterBtn.addEventListener('click', function() {
      // Here you would normally collect filter values and reload the properties
      // For demo, we'll just show a notification
      
      showNotification('Filters applied successfully.', 'success');
      
      // On mobile, close the filter sidebar
      if (window.innerWidth < 992) {
        filterSidebar.classList.remove('show');
        document.querySelector('.filter-overlay').classList.remove('show');
        body.classList.remove('no-scroll');
        
        // Reset icon
        const icon = filterToggle.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-sliders');
      }
    });
  }
  
  // Sorting change handler
  const sortingSelect = document.querySelector('.sorting-options select');
  
  if (sortingSelect) {
    sortingSelect.addEventListener('change', function() {
      const sortValue = this.value;
      const propertyCards = Array.from(document.querySelectorAll('.property-card'));
      const propertyContainer = document.querySelector('.properties-grid');
      
      // Sort logic based on selected option
      switch(sortValue) {
        case 'price-asc':
          sortProperties(propertyCards, propertyContainer, 'price', 'asc');
          break;
        case 'price-desc':
          sortProperties(propertyCards, propertyContainer, 'price', 'desc');
          break;
        case 'area-asc':
          sortProperties(propertyCards, propertyContainer, 'area', 'asc');
          break;
        case 'area-desc':
          sortProperties(propertyCards, propertyContainer, 'area', 'desc');
          break;
        default: // recent
          // Just restore original order
          sortProperties(propertyCards, propertyContainer, 'order', 'asc');
      }
      
      showNotification('Properties sorted by ' + sortingSelect.options[sortingSelect.selectedIndex].text, 'info');
    });
    
    // Function to sort property cards
    function sortProperties(cards, container, sortBy, direction) {
      cards.sort((a, b) => {
        let aValue, bValue;
        
        if (sortBy === 'price') {
          // Extract price value
          aValue = extractPrice(a.querySelector('.price').textContent);
          bValue = extractPrice(b.querySelector('.price').textContent);
        } else if (sortBy === 'area') {
          // Extract area value
          aValue = extractArea(a.querySelector('.property-tags').textContent);
          bValue = extractArea(b.querySelector('.property-tags').textContent);
        } else {
          // Default sort by DOM order
          aValue = Array.from(container.children).indexOf(a.parentNode);
          bValue = Array.from(container.children).indexOf(b.parentNode);
        }
        
        // Sort based on direction
        if (direction === 'asc') {
          return aValue - bValue;
        } else {
          return bValue - aValue;
        }
      });
      
      // Re-append sorted cards
      cards.forEach(card => {
        container.appendChild(card.parentNode);
      });
    }
    
    // Helper functions to extract values
    function extractPrice(priceStr) {
      return parseInt(priceStr.replace(/[^0-9]/g, ''));
    }
    
    function extractArea(areaStr) {
      const match = areaStr.match(/(\d+,?\d*)\s*sq ft/);
      return match ? parseInt(match[1].replace(',', '')) : 0;
    }
  }
  
  // Helper function to show notifications
  function showNotification(message, type = 'info') {
    // Check if notification container exists, if not create it
    let container = document.querySelector('.notification-container');
    
    if (!container) {
      container = document.createElement('div');
      container.className = 'notification-container';
      document.body.appendChild(container);
    }
    
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
    
    // Add to container
    container.appendChild(notification);
    
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
        
        // Remove container if empty
        if (container.children.length === 0) {
          container.remove();
        }
      }, 300); // Wait for transition to complete
    });
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
      if (document.body.contains(notification)) {
        notification.classList.remove('visible');
        setTimeout(() => {
          if (document.body.contains(notification)) {
            notification.remove();
            
            // Remove container if empty
            if (container.children.length === 0) {
              container.remove();
            }
          }
        }, 300);
      }
    }, 5000);
  }
  
  // Add CSS for notifications if not already present
  if (!document.getElementById('notification-styles')) {
    const style = document.createElement('style');
    style.id = 'notification-styles';
    style.textContent = `
      .notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 350px;
      }
      
      .notification {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 10px;
        transform: translateX(120%);
        transition: transform 0.3s ease;
        overflow: hidden;
        display: flex;
        align-items: center;
      }
      
      .notification.visible {
        transform: translateX(0);
      }
      
      .notification-content {
        padding: 12px 15px;
        display: flex;
        align-items: center;
        flex-grow: 1;
      }
      
      .notification i {
        margin-right: 10px;
        font-size: 1.2rem;
      }
      
      .notification.success i {
        color: #27ae60;
      }
      
      .notification.info i {
        color: #3498db;
      }
      
      .notification.warning i {
        color: #f39c12;
      }
      
      .notification.error i {
        color: #e74c3c;
      }
      
      .notification-close {
        background: none;
        border: none;
        color: #6c757d;
        padding: 12px 15px;
        cursor: pointer;
        transition: color 0.2s;
      }
      
      .notification-close:hover {
        color: #343a40;
      }
      
      @media (max-width: 576px) {
        .notification-container {
          left: 20px;
          right: 20px;
          max-width: none;
        }
      }
    `;
    document.head.appendChild(style);
  }
});