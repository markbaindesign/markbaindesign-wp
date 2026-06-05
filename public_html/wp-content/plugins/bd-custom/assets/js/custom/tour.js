/**
 * Curriculum Onboarding Tour using Shepherd.js
 * Streamlined tour system focused on Learning Goal tours
 */

class CurriculumTour {
   constructor() {
      this.shepherd = null;
      this.currentTour = null;
      this.userPrefs = this.loadUserPreferences();
      this.isAdmin = this.checkAdminStatus();
      this.previewMode = false;
      this.config = window.TourConfig || { tours: {}, pageDetection: {}, settings: {} };
      this.init();
   }

   testLocalStorage() {
      try {
         localStorage.setItem('test', 'value');
         const test = localStorage.getItem('test');
         localStorage.removeItem('test');
         console.log('localStorage test:', test === 'value' ? 'WORKING' : 'FAILED');
         return test === 'value';
      } catch (e) {
         console.error('localStorage not available:', e);
         return false;
      }
   }

   init() {
      console.log('🎯 CurriculumTour: Starting initialization...');
      console.log('🔧 Tour config loaded:', this.config);

      this.testLocalStorage();

      console.log('📦 Loading Shepherd.js...');
      this.loadShepherdJS().then(() => {
         console.log('✅ Shepherd.js loaded successfully');
         this.setupTours();
         this.bindEvents();
         this.checkAutoStart();
         console.log('✨ CurriculumTour initialization complete!');
      }).catch(error => {
         console.error('❌ Failed to load Shepherd.js:', error);
      });
   }

   async loadShepherdJS() {
      if (typeof Shepherd !== 'undefined') {
         return Promise.resolve();
      }

      return new Promise((resolve, reject) => {
         const link = document.createElement('link');
         link.rel = 'stylesheet';
         link.href = 'https://cdn.jsdelivr.net/npm/shepherd.js@11.2.0/dist/css/shepherd.css';
         document.head.appendChild(link);

         const script = document.createElement('script');
         script.src = 'https://cdn.jsdelivr.net/npm/shepherd.js@11.2.0/dist/js/shepherd.min.js';
         script.onload = resolve;
         script.onerror = reject;
         document.head.appendChild(script);
      });
   }

   checkAdminStatus() {
      const isAdmin = window.curriculumTourData?.isAdmin ||
         document.body.classList.contains('logged-in') &&
         document.body.classList.contains('admin-bar');

      console.log('👤 Admin status check:', { isAdmin });
      return isAdmin;
   }

   setupTours() {
      console.log('🔧 setupTours: Starting...');

      const tourDefinitions = window.curriculumTourData?.tours ?
         Object.values(window.curriculumTourData.tours) :
         [];

      console.log('📋 Tour definitions found:', {
         count: tourDefinitions.length,
         configuredTours: Object.keys(this.config.tours),
         isAdmin: this.isAdmin
      });

      if (tourDefinitions.length === 0) {
         console.warn('⚠️ No tour data available from ACF. Please configure tours in WordPress admin.');
         return;
      }

      this.tours = {};

      tourDefinitions.forEach((tourDef) => {
         // Only create tours that are in our config
         if (this.config.tours[tourDef.name] && this.canViewTour(tourDef)) {
            console.log(`🎯 Creating configured tour: ${tourDef.name}`);
            try {
               this.tours[tourDef.name] = this.createTourFromDefinition(tourDef);
               console.log(`✅ Tour "${tourDef.name}" created successfully`);
            } catch (error) {
               console.error(`❌ Failed to create tour "${tourDef.name}":`, error);
            }
         } else if (!this.config.tours[tourDef.name]) {
            console.log(`🚫 Tour "${tourDef.name}" not in config - skipped`);
         } else {
            console.log(`🚫 Tour "${tourDef.name}" - user cannot view`);
         }
      });

      console.log('🎉 Tours setup complete:', Object.keys(this.tours));
   }

   canViewTour(tourDef) {
      if (tourDef.public === true || tourDef.public === "1") {
         return true;
      }
      return this.isAdmin;
   }

   isTourInPreviewMode(tourName) {
      const tourData = this.getTourData(tourName);
      return tourData && (tourData.public === false || tourData.public === "0");
   }

   getTourData(tourName) {
      const tourDefinitions = window.curriculumTourData?.tours;
      if (!tourDefinitions) return null;
      return Object.values(tourDefinitions).find(tour => tour.name === tourName);
   }

   createTourFromDefinition(tourDef) {
      const settings = this.config.settings;
      const tour = new Shepherd.Tour({
         useModalOverlay: settings.useModalOverlay || true,
         defaultStepOptions: {
            classes: `${settings.defaultStepClasses || 'mwe-curriculum-tour-step'} ${!tourDef.public ? 'tour-preview-mode' : ''}`,
            scrollTo: { behavior: settings.scrollBehavior || 'smooth', block: 'center' },
            cancelIcon: { enabled: true }
         }
      });

      tourDef.steps.forEach((stepDef, stepIndex) => {
         const stepOptions = {
            title: stepDef.title,
            text: stepDef.text
         };

         if (!tourDef.public && this.isAdmin && stepIndex === 0) {
            stepOptions.text = `
                    <div class="tour-preview-banner">
                        🔍 <strong>PREVIEW MODE</strong> - This tour is not public yet
                    </div>
                    ${stepDef.text}
                `;
         }

         if (stepDef.attachTo && document.querySelector(stepDef.attachTo.element)) {
            stepOptions.attachTo = stepDef.attachTo;
         }

         if (stepDef.buttons && stepDef.buttons.length > 0) {
            stepOptions.buttons = stepDef.buttons.map(btn => {
               let action;
               switch (btn.action) {
                  case 'next': action = tour.next; break;
                  case 'back': action = tour.back; break;
                  case 'cancel': action = tour.cancel; break;
                  case 'complete':
                     action = () => {
                        if (tourDef.public) {
                           this.markTourCompleted(tourDef.name);
                        }
                        tour.complete();
                     };
                     break;
                  default: action = tour.next;
               }

               return {
                  text: btn.text,
                  classes: btn.classes || 'btn btn-primary',
                  action: action
               };
            });
         } else {
            stepOptions.buttons = [{
               text: 'Next',
               action: tour.next,
               classes: 'btn btn-primary'
            }];
         }

         tour.addStep(stepOptions);
      });

      return tour;
   }

   loadUserPreferences() {
      console.log('📋 loadUserPreferences: Starting...');

      try {
         if (!this.testLocalStorage()) {
            console.warn('⚠️ localStorage not available, using defaults');
            return { completedTours: [], skipAutoStart: false, lastTourDate: null };
         }

         const stored = localStorage.getItem('curriculum_tour_prefs');
         if (stored) {
            const parsed = JSON.parse(stored);
            console.log('✅ Parsed preferences:', parsed);
            return parsed;
         } else {
            const defaults = { completedTours: [], skipAutoStart: false, lastTourDate: null };
            localStorage.setItem('curriculum_tour_prefs', JSON.stringify(defaults));
            return defaults;
         }
      } catch (e) {
         console.error('❌ Error in loadUserPreferences:', e);
         return { completedTours: [], skipAutoStart: false, lastTourDate: null };
      }
   }

   saveUserPreferences() {
      console.log('💾 saveUserPreferences:', this.userPrefs);
      try {
         localStorage.setItem('curriculum_tour_prefs', JSON.stringify(this.userPrefs));
         console.log('✅ Preferences saved');
      } catch (e) {
         console.error('❌ Error saving preferences:', e);
      }
   }

   startTour(tourName) {
      console.log('🚀 startTour called:', {
         tourName,
         tourExists: !!(this.tours && this.tours[tourName]),
         isConfigured: !!(this.config.tours[tourName]),
         availableTours: Object.keys(this.tours || {})
      });

      if (this.tours[tourName]) {
         const isPreview = this.isTourInPreviewMode(tourName);
         console.log(isPreview ? `🔍 Starting PREVIEW tour: ${tourName}` : `✅ Starting tour: ${tourName}`);

         this.previewMode = isPreview;
         this.currentTour = this.tours[tourName];
         this.currentTour.start();
         this.trackTourStart(tourName);
      } else {
         console.error('❌ Tour not found or not configured:', tourName);
      }
   }

   trackTourStart(tourName) {
      console.log('📊 Tour started:', tourName);
   }

   checkAutoStart() {
      console.log('🚀 checkAutoStart: Checking configured tours...');

      // Check each configured tour for auto-start conditions
      Object.entries(this.config.tours).forEach(([tourName, tourConfig]) => {
         if (!tourConfig.autoStart?.enabled) return;
         if (this.userPrefs.completedTours.includes(tourName)) return;
         if (!this.tours[tourName]) return;

         const conditionMethod = tourConfig.autoStart.condition;
         const pageDetector = this.config.pageDetection[conditionMethod];

         if (pageDetector && pageDetector.call(this)) {
            const tourData = this.getTourData(tourName);
            if (this.canViewTour(tourData || {})) {
               console.log(`🎉 Auto-starting tour: ${tourName}`);
               setTimeout(() => {
                  this.startTour(tourName);
               }, tourConfig.autoStart.delay || this.config.settings.autoStartDelay);
            }
         }
      });
   }

   markTourCompleted(tourName) {
      if (this.isTourInPreviewMode(tourName)) {
         console.log('🔍 Preview mode - not recording completion for:', tourName);
         return;
      }

      console.log('✅ markTourCompleted:', tourName);

      if (!this.userPrefs.completedTours.includes(tourName)) {
         this.userPrefs.completedTours.push(tourName);
         this.userPrefs.lastTourDate = new Date().toISOString();

         this.userPrefs.tourContexts = this.userPrefs.tourContexts || {};
         this.userPrefs.tourContexts[tourName] = {
            page: window.location.pathname,
            completedAt: new Date().toISOString()
         };

         this.saveUserPreferences();
      }
   }

   triggerContextualTour(action) {
      const tourName = this.config.contextualTriggers[action];
      if (tourName &&
         !this.userPrefs.completedTours.includes(tourName) &&
         this.tours[tourName]) {

         const tourData = this.getTourData(tourName);
         if (this.canViewTour(tourData || {})) {
            this.startTour(tourName);
         }
      }
   }

   bindEvents() {
      // Manual tour trigger buttons
      document.addEventListener('click', (e) => {
         if (e.target.matches('[data-tour-trigger]')) {
            const tourName = e.target.dataset.tourTrigger;
            if (this.tours[tourName]) {
               this.startTour(tourName);
            }
         }
      });

      // Help menu items
      document.addEventListener('click', (e) => {
         if (e.target.matches('.tour-help-menu [data-tour]')) {
            const tourName = e.target.dataset.tour;
            this.startTour(tourName);
         }
      });

      // Keyboard shortcuts
      document.addEventListener('keydown', (e) => {
         if (e.ctrlKey && e.shiftKey && e.key === 'H') {
            // Start the first available tour
            const availableTours = Object.keys(this.tours);
            if (availableTours.length > 0) {
               this.startTour(availableTours[0]);
            }
         }
      });

      // Reset tours for testing
      if (window.location.search.includes('reset-tours')) {
         this.userPrefs = { completedTours: [], skipAutoStart: false, lastTourDate: null };
         this.saveUserPreferences();
         console.log('🔄 Tours reset!');
      }
   }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
   window.curriculumTour = new CurriculumTour();
});

// Expose globally
window.CurriculumTour = CurriculumTour;
