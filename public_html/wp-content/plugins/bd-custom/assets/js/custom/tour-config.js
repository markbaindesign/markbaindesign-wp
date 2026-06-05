/**
 * Tour Configuration
 * Centralized configuration for all curriculum tours
 */

window.TourConfig = {
   // Available tours - add new tours here
   tours: {
      learningGoal: {
         name: 'learningGoal',
         displayName: 'Learning Goal',
         autoStart: {
            enabled: true,
            delay: 1500,
            condition: 'isSingleGoalPage'
         }
      }
      // Add new tours here following the same pattern:
      // newTour: {
      //     name: 'newTour',
      //     displayName: 'New Tour Name',
      //     autoStart: {
      //         enabled: false,
      //         delay: 2000,
      //         condition: 'customConditionMethod'
      //     }
      // }
   },

   // Page detection methods - add new page types here
   pageDetection: {
      isSingleGoalPage: function () {
         return window.location.pathname.includes('/goal') ||
            document.body.classList.contains('single-curriculum');
      }
      // Add new page detection methods here:
      // isCustomPage: function() {
      //     return window.location.pathname.includes('/custom-path');
      // }
   },

   // Contextual triggers - map actions to tours
   contextualTriggers: {
      'goal-page-visit': 'learningGoal'
      // Add new triggers here:
      // 'custom-action': 'customTour'
   },

   // Global tour settings
   settings: {
      autoStartDelay: 2000,
      useModalOverlay: true,
      defaultStepClasses: 'mwe-curriculum-tour-step',
      scrollBehavior: 'smooth'
   }
};