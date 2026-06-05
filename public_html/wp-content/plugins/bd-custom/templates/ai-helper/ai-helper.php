<!-- Modal -->
<?php
$ai_custom_prompt = get_field('ai_helper_custom_prompt', 'option');
$icon_preview = bd324_get_icon('preview');
$icon_preview_hide = bd324_get_icon('hide_preview');
$icon_copy = bd324_get_icon('copy');

?>
<div
   x-data="lessonPlanner"
   x-show="$store.aiHelperModal.show"
   class="modal modal__ai-helper"
   x-transition
   x-cloak>

   <!-- Modal Header -->
   <header class="ai-helper__header">
      <?php if ($header = get_field('ai_helper_header', 'option')): ?>
         <?php echo bd324_get_icon('ai'); ?>
         <h5><?php echo $header; ?></h5>
      <?php endif; ?>
      <button
         @click="$store.aiHelperModal.show = false"
         class="modal__ai-helper__close"
         aria-label="Close"><?php echo bd324_get_icon('close'); ?>
      </button>
   </header>

   <?php if ($intro = get_field('ai_helper_intro', 'option')): ?>
      <div class="ai-helper__intro"><?php echo $intro; ?></div>
   <?php endif; ?>

   <!-- Toggle for Custom Params -->
   <h6
      @click="showCustomParams = !showCustomParams"
      role="button"
      tabindex="0"
      class="ai-helper__toggle ai-helper__toggle--params"
      aria-expanded="false"
      :aria-expanded="showCustomParams"
      title="Show/Hide Custom Parameters">
      <span x-text="showCustomParams ? '▲' : '▼'"></span><span style="margin-left: 0.5em;">Custom Parameters (editable)</span>

   </h6>
   <template x-if="showCustomParams">
      <div style="margin-bottom:1em;">
         <textarea
            x-model="userGoals"
            @input="watchUserInput"
            class="ai-helper__custom-params"
            :placeholder="Type your custom parameters here..."
            x-init="userGoals = <?php echo json_encode($ai_custom_prompt); ?>"></textarea>
      </div>
   </template>



   <!-- Buttons -->
   <div class="ai-helper__buttons" style="margin-top:1em;">

      <!-- Generate Button -->
      <button
         @click="transform()"
         class="bg-blue-600 text-white px-4 py-2 rounded"
         data-post-id="<?php echo get_the_ID(); ?>"
         data-post-title="<?php echo esc_attr(get_the_title()); ?>">
         Generate AI Lesson Planning Data
      </button>

      <div class="ai-helper__buttons-messages">
         <p x-show="copied" x-html="copyMessage"></p>
         <p class="ai-helper__message--prompt-generated" x-show="generated">
            <strong>Prompt generated!</strong>&nbsp;
            <span x-show="generated" class="ai-helper__actions-item">
               <span x-show="!showJsonOutput" x-html="iconPreview" class="ai-helper__icon-preview"></span>
               <span x-show="showJsonOutput" x-html="iconPreviewHide" class="ai-helper__icon-preview-hide"></span>
               <a href="#"
                  @click.prevent="showJsonOutput = !showJsonOutput; if (showJsonOutput) { $nextTick(() => highlightJson()) }"
                  class="ai-helper__preview-toggle">
                  <span x-text="showJsonOutput ? 'Hide' : 'Preview'" class="ai-helper__preview-text"></span> prompt
               </a>
            </span>
         <ul x-show="generated" class="ai-helper__actions-list">
            <li class="ai-helper__actions-item">
               <button
                  @click="copyToClipboard"
                  :disabled="!transformed"
                  class="ml-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                  Copy to Clipboard
               </button>
            </li>
         </ul>
         </p>
      </div>
   </div>

   <!-- Simple Text Output -->
   <template x-if="showJsonOutput">
      <div class="ai-helper__output" style="margin-top:1em;">
         <template x-if="transformed">
            <div>
               <pre class="bg-gray-50 p-4 font-mono text-sm" x-text="simpleFormat"></pre>
            </div>
         </template>
      </div>
   </template>


</div>

<?php
$taxonomies = ['framework-grade', 'framework-domain', 'framework-strand', 'framework-topic'];
$term_data = [];

foreach ($taxonomies as $taxonomy) {
    $terms = get_the_terms(get_the_ID(), $taxonomy);
    $term_data[$taxonomy] = [];

    if (!is_wp_error($terms) && $terms) {
        foreach ($terms as $term) {
            $term_data[$taxonomy][] = [
               'id' => $term->term_id,
               'name' => $term->name,
               'slug' => $term->slug,
            ];
        }
    }
}
?>
<script>
   document.addEventListener('alpine:init', () => {
      const myPostId = <?php echo json_encode((int) get_the_ID()); ?>;
      const aiHelperText = <?php echo json_encode(get_field('ai_helper_custom_prompt', 'option')); ?>;
      const aiInstructions = <?php echo json_encode(get_field('ai_helper_lesson_planning_instructions', 'option')); ?>;
      const frameworkTax = <?php echo json_encode($term_data); ?>;
      console.log('Framework Taxonomies:', frameworkTax);
      Alpine.data('lessonPlanner', () => ({
         rawGoal: null,
         wpOptions: null,
         transformed: null,
         context: '',
         userGoals: aiHelperText ?? '',
         copied: false,
         copyMessage: '',
         generateMessage: '',
            generated: false,
         showModal: false,
         showDetails: false,
         showCustomParams: false,
         showJsonOutput: false,
         iconPreview: <?php echo json_encode($icon_preview); ?>,
         iconPreviewHide: <?php echo json_encode($icon_preview_hide); ?>,
         iconCopy: <?php echo json_encode($icon_copy); ?>,

         async init() {
            const [goalRes] = await Promise.all([
               fetch(`/wp-json/wp/v2/learning-goals/${myPostId}`),
            ]);

            this.rawGoal = await goalRes.json();
         },

        get simpleFormat() {
            if (!this.transformed) return '';

            // Priority fields to show first
            const priorityFields = ['user_defined_params', 'ai_helper_text'];
            let output = '';

            // Add priority fields first
            for (const key of priorityFields) {
                if (this.transformed[key]) {
                    let displayValue = this.transformed[key];
                    if (Array.isArray(displayValue)) {
                        displayValue = displayValue.join(', ');
                    } else if (typeof displayValue === 'object' && displayValue !== null) {
                        displayValue = JSON.stringify(displayValue, null, 2);
                    }
                    output += `${key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}: ${displayValue}\n`;
                }
            }

            // Add remaining fields
            for (const [key, value] of Object.entries(this.transformed)) {
                if (priorityFields.includes(key)) continue; // Skip already added fields
                
                let displayValue = value;
                if (Array.isArray(value)) {
                    displayValue = value.join(', ');
                } else if (typeof value === 'object' && value !== null) {
                    displayValue = JSON.stringify(value, null, 2);
                }
                output += `${key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}: ${displayValue}\n`;
            }
            
            return output.trim();
        },

         highlightJson() {
            this.$nextTick(() => {
               const codeBlock = this.$root.querySelector('code.language-json');
               if (window.hljs && codeBlock) {
                  hljs.highlightElement(codeBlock);
               }
            });
         },

         // Watch the userGoals field for changes
         watchUserInput() {
            this.transformed = null; // reset JSON
            this.showJsonOutput = false;
            this.copied = false;
            this.generated = false; // <-- reset generated state
            this.copyMessage = '';
         },

         transform() {
            if (!this.rawGoal) return;

            const acf = this.rawGoal.acf || {};
            console.log(acf);

            this.transformed = {
                               // User input
               user_defined_params: this.userGoals,

               // Global teaching settings from options table
               ai_helper_text: aiInstructions ?? "",
               title: this.rawGoal.title?.rendered ?? "",
               subtitle: acf.byline ?? "",
               knowledge: acf.knowledge ?? "",
               understanding: acf.Understanding ?? "",
               experience: acf.Experience ?? "",
               guiding_questions: (acf.guiding_questions || "").split("\n").map(q => q.trim()).filter(Boolean),
               vocabulary: (acf.vocabulary || "").split(",").map(v => v.trim()).filter(Boolean),
               tags: (acf.related_topics || "").split(",").map(v => v.trim()).filter(Boolean),
               action: acf.action ?? "",
               quote: acf.quotes ?? "",
               implementation: acf.implementation  ?? "",
               goal_link: this.rawGoal.link ?? "",
               grade: (frameworkTax["framework-grade"] || []).map(term => term.name),
               domain: (frameworkTax["framework-domain"] || []).map(term => term.name),
               strand: (frameworkTax["framework-strand"] || []).map(term => term.name),
               topic: (frameworkTax["framework-topic"] || []).map(term => term.name),
               serial: acf.serial ?? "",


            };
            this.copied = false; // reset copy state on new generation
            this.copyMessage = false; // reset copy state on new generation
            this.generated = true;
            this.showJsonOutput = false;


         },

         copyToClipboard() {
            if (!this.transformed) return;

            navigator.clipboard.writeText(this.simpleFormat)
               .then(() => {
                  this.copyMessage = '<strong>Simple format copied to clipboard!</strong>';
                  this.copied = true;
                  this.generated = false;
                  this.showJsonOutput = false;
               })
               .catch(() => {
                  this.copyMessage = 'Failed to copy!';
                  this.copied = true;
               });
         },

      }));
   });
</script>