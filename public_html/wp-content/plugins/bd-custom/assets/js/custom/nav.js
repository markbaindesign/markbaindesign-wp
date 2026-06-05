// Fade-in when page loads
window.addEventListener('DOMContentLoaded', () => {
   document.body.style.opacity = '1';
});

// Fade-out + spinner before going to a new page
function fadeAndGo(url) {
   document.body.classList.add('fade-out');
   setTimeout(() => {
      window.location.href = url;
   }, 400);
}

document.addEventListener('keydown', function (event) {
   const prevLinks = document.querySelectorAll('.prev-post a');
   const nextLinks = document.querySelectorAll('.next-post a');
   const key = event.key.toLowerCase();

   if ((event.key === 'ArrowLeft' || key === 'k') && prevLinks.length > 0) {
      fadeAndGo(prevLinks[0].href); // Use the first matching link
   } else if ((event.key === 'ArrowRight' || key === 'j') && nextLinks.length > 0) {
      fadeAndGo(nextLinks[0].href); // Use the first matching link
   } else if (event.key === 'Escape') {
      fadeAndGo("/curricular-framework/");
   }
});

// Sidebar Navigation
document.addEventListener('DOMContentLoaded', function () {
   // Change these selectors to match your theme
   const contentArea = document.querySelector('#main-content--framework');
   const sidebar = document.querySelector('.sidebar--framework__inner aside');
   console.log('contentArea:', contentArea);
   console.log('sidebar:', sidebar);
   if (!contentArea || !sidebar) return;

   const headings = [];
   let lastH2Id = null;

   // Find all h2 and h3 headings
   contentArea.querySelectorAll('h2, h3').forEach((el, i) => {
      // Inject unique ID if missing
      if (!el.id) {
         el.id = el.textContent.trim().toLowerCase().replace(/\s+/g, '-') + '-' + i;
      }
      let parent_id = null;
      if (el.tagName.toLowerCase() === 'h2') {
         lastH2Id = el.id;
      } else if (el.tagName.toLowerCase() === 'h3') {
         parent_id = lastH2Id;
      }
      headings.push({
         tag: el.tagName.toLowerCase(),
         text: el.textContent,
         id: el.id,
         parent_id: parent_id,
      });
   });

   console.log('Headings:', headings);

   // Build the navigation menu
   const nav = document.createElement('nav');
   nav.className = 'toc-nav';
   const ul = document.createElement('ul');
   ul.className = 'sidebar--framework__list';

   headings.forEach(h => {
      const li = document.createElement('li');
      li.className = 'sidebar--framework__list-item ' + (h.tag === 'h2' ? 'toc-h2' : 'toc-h3');
      const a = document.createElement('a');
      a.href = '#' + h.id;
      a.textContent = h.text;
      li.appendChild(a);
      ul.appendChild(li);
   });

   nav.appendChild(ul);

   // Insert the menu in the sidebar
   sidebar.innerHTML = '';
   sidebar.appendChild(nav);
   sidebar.style.display = 'block';

   // Optional: Smooth scroll for anchor links
   sidebar.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', function (e) {
         e.preventDefault();
         const target = document.getElementById(this.getAttribute('href').substring(1));
         if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
         }
      });
   });
});