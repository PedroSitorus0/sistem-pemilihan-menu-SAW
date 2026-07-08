/**
 * Menu View - Decision Support System (SPK)
 * Handles filtering, sorting, and dynamic card rendering
 * 
 * @module MenuView
 */

class MenuView {
    constructor() {
        this.menuContainer = document.getElementById('menuContainer');
        this.filterKategoriBtn = document.querySelector('[data-target="filterKategori-menu"]');
        this.filterKategoriMenu = document.getElementById('filterKategori-menu');
        this.filterKategoriSelect = document.getElementById('filterKategori');
        this.filterKategoriLabel = document.getElementById('filterKategoriLabel');
        
        this.sortMenuBtn = document.getElementById('sortMenuBtn');
        this.sortMenuMenu = document.getElementById('sortMenu-menu');
        this.sortMenuSelect = document.getElementById('sortMenu');
        this.sortMenuLabel = document.getElementById('sortMenuLabel');

        this.circumference = 2 * Math.PI * 26;
        
        this.init();
    }

    /**
     * Initialize event listeners and styles
     */
    init() {
        this.setupContainerStyles();
        this.bindDropdownEvents();
        this.bindFilterEvents();
        this.bindSortEvents();
        this.bindGlobalClickHandler();
        this.updateCardStyles();
    }

    /**
     * Setup container transition styles
     */
    setupContainerStyles() {
        this.menuContainer.style.transition = 'all 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    /**
     * Toggle dropdown menu visibility
     * @param {HTMLElement} button - Toggle button
     * @param {HTMLElement} menu - Dropdown menu
     */
    toggleDropdown(button, menu) {
        const isOpen = !menu.classList.contains('hidden');
        if (isOpen) {
            menu.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        } else {
            menu.classList.remove('hidden');
            button.setAttribute('aria-expanded', 'true');
        }
    }

    /**
     * Close all dropdowns
     */
    closeAllDropdowns() {
        [this.filterKategoriMenu, this.sortMenuMenu].forEach(menu => {
            menu.classList.add('hidden');
        });
        this.filterKategoriBtn.setAttribute('aria-expanded', 'false');
        this.sortMenuBtn.setAttribute('aria-expanded', 'false');
    }

    /**
     * Bind dropdown toggle events
     */
    bindDropdownEvents() {
        this.filterKategoriBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleDropdown(this.filterKategoriBtn, this.filterKategoriMenu);
        });

        this.sortMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleDropdown(this.sortMenuBtn, this.sortMenuMenu);
        });
    }

    /**
     * Bind category filter events
     */
    bindFilterEvents() {
        this.filterKategoriMenu.querySelectorAll('option-item').forEach(item => {
            item.addEventListener('click', () => {
                this.handleFilterChange(
                    item,
                    this.filterKategoriMenu,
                    this.filterKategoriLabel,
                    this.filterKategoriSelect
                );
            });
        });
    }

    /**
     * Bind sort filter events
     */
    bindSortEvents() {
        this.sortMenuMenu.querySelectorAll('option-item').forEach(item => {
            item.addEventListener('click', () => {
                this.handleFilterChange(
                    item,
                    this.sortMenuMenu,
                    this.sortMenuLabel,
                    this.sortMenuSelect
                );
            });
        });
    }

    /**
     * Handle filter/sort option change
     * @param {HTMLElement} item - Selected option item
     * @param {HTMLElement} menu - Parent menu
     * @param {HTMLElement} label - Label to update
     * @param {HTMLElement} select - Hidden select element
     */
    handleFilterChange(item, menu, label, select) {
        const value = item.getAttribute('value');
        const text = item.textContent.trim();

        // Update UI
        menu.querySelectorAll('option-item').forEach(opt => {
            opt.classList.remove('selected');
        });
        item.classList.add('selected');
        label.textContent = text;
        select.value = value;

        // Trigger changes
        this.closeAllDropdowns();
        this.sortAndFilterCards();
    }

    /**
     * Bind global click handler to close dropdowns
     */
    bindGlobalClickHandler() {
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-container')) {
                this.closeAllDropdowns();
            }
        });
    }

    /**
     * Get all visible cards based on current filters
     * @returns {Array} Array of card elements
     */
    getFilteredCards() {
        let cards = Array.from(this.menuContainer.querySelectorAll('.menu-card'));
        const filterValue = this.filterKategoriSelect.value;

        if (filterValue !== 'all') {
            cards = cards.filter(card => {
                const cardKategori = card.dataset.kategori || '';
                return cardKategori.includes(filterValue);
            });
        }

        return cards;
    }

    /**
     * Sort cards based on current sort option
     * @param {Array} cards - Cards to sort
     * @returns {Array} Sorted cards
     */
    sortCards(cards) {
        const sortValue = this.sortMenuSelect.value;

        return cards.sort((a, b) => {
            if (sortValue === 'spk_desc') {
                return this.compareBySPK(a, b);
            }

            if (sortValue.startsWith('kriteria_')) {
                return this.compareByKriteria(a, b, sortValue);
            }

            return 0;
        });
    }

    /**
     * Compare two cards by SPK score
     * @param {HTMLElement} a - Card A
     * @param {HTMLElement} b - Card B
     * @returns {Number} Comparison result
     */
    compareBySPK(a, b) {
        const skorA = parseFloat(a.dataset.skor) || 0;
        const skorB = parseFloat(b.dataset.skor) || 0;
        return skorB - skorA;
    }

    /**
     * Compare two cards by specific criteria
     * @param {HTMLElement} a - Card A
     * @param {HTMLElement} b - Card B
     * @param {String} sortValue - Sort value (kriteria_ID_sifat)
     * @returns {Number} Comparison result
     */
    compareByKriteria(a, b, sortValue) {
        const parts = sortValue.split('_');
        const kriteriaId = parts[1];
        const sifat = parts[2];

        // Special handling for price
        if (this.sortMenuLabel.textContent.toLowerCase().includes('harga')) {
            const hargaA = parseFloat(a.dataset.harga) || 0;
            const hargaB = parseFloat(b.dataset.harga) || 0;
            return sifat === 'cost' ? (hargaA - hargaB) : (hargaB - hargaA);
        }

        // Get criteria values
        const nilaiA = parseFloat(a.getAttribute(`data-kriteria-${kriteriaId}`)) || 0;
        const nilaiB = parseFloat(b.getAttribute(`data-kriteria-${kriteriaId}`)) || 0;

        // Use SPK score as tie-breaker
        if (nilaiA === nilaiB) {
            return this.compareBySPK(a, b);
        }

        // Compare by criteria
        return sifat.toLowerCase() === 'cost' 
            ? (nilaiA - nilaiB) 
            : (nilaiB - nilaiA);
    }

    /**
     * Update card visual styles based on order
     * @param {Array} cards - Cards to style
     */
    updateCardStyles(cards = null) {
        if (!cards) {
            cards = Array.from(this.menuContainer.querySelectorAll('.menu-card'));
        }

        cards.forEach((card, index) => {
            const rankNumber = card.querySelector('.card-rank-number');
            const topBadge = card.querySelector('.top-badge');
            const gaugeRing = card.querySelector('.gauge-ring');
            const isTop = index === 0;

            // Update rank number
            if (rankNumber) {
                rankNumber.textContent = String(index + 1).padStart(2, '0');
            }

            // Apply/remove top card styling
            if (isTop) {
                card.classList.add('is-top');
                topBadge?.classList.remove('hidden');
                gaugeRing?.setAttribute('stroke', '#dc2626');
            } else {
                card.classList.remove('is-top');
                topBadge?.classList.add('hidden');
                gaugeRing?.setAttribute('stroke', '#111827');
            }
        });
    }

    /**
     * Animate and reorder cards in DOM
     * @param {Array} cards - Cards to reorder
     */
    reorderCards(cards) {
        // Add animation class
        this.menuContainer.style.opacity = '0.3';
        this.menuContainer.style.transform = 'translateY(12px)';

        setTimeout(() => {
            // Reorder in DOM
            cards.forEach(card => this.menuContainer.appendChild(card));
            
            // Update styles
            this.updateCardStyles(cards);

            // Remove animation class
            this.menuContainer.style.opacity = '1';
            this.menuContainer.style.transform = 'translateY(0)';
        }, 150);
    }

    /**
     * Main function: filter and sort cards
     */
    sortAndFilterCards() {
        const cards = this.getFilteredCards();
        const sorted = this.sortCards(cards);
        this.reorderCards(sorted);
    }
}

/**
 * Initialize MenuView when DOM is ready
 */
document.addEventListener('DOMContentLoaded', function() {
    new MenuView();
});

// Export for use in other modules (if needed)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MenuView;
}