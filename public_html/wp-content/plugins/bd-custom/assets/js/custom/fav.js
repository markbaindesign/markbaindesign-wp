document.addEventListener("alpine:init", () => {
   // Create an Alpine store to hold the number of favorited items
   Alpine.store("favoritesCount", {
      count: JSON.parse(localStorage.getItem("favoritePosts"))?.length || 0,

      updateCount(newCount) {
         this.count = newCount;
      },
   });
   Alpine.store('aiHelperModal', {
      show: false
   });

   Alpine.data("favoritesHandler", () => ({
      favsListExpanded: false, // Local accordion state
      favorites: [],
      postId: null, // Replace with the actual post ID dynamically

      init() {
         // Set up reactivity watcher
         Alpine.effect(() => {
            const count = Alpine.store("favoritesCount").count;
            // console.log("Favorites count changed:", count);
         });

         const stored = localStorage.getItem("favoritePosts");
         this.favorites = stored ? JSON.parse(stored) : [];

         // Only load if we have favorites
         if (this.favorites.length > 0) {
            this.loadFavorites();
         }

         Alpine.store("favoritesCount").updateCount(this.favorites.length);
      },

      isFavorited(id) {
         return this.favorites.includes(id);
      },

      toggleFavorite(id) {
         // console.log("Toggling favorite for ID:", id);
         // console.log("Current favorites:", this.favorites);
         const index = this.favorites.indexOf(id);

         if (index !== -1) {
            this.favorites.splice(index, 1); // remove
            // console.log(`Removed favorite: ${id}`);
         } else {
            this.favorites.push(id); // add
            // console.log(`Added favorite: ${id}`);
         }

         // Save only if not empty
         if (this.favorites.length > 0) {
            localStorage.setItem("favoritePosts", JSON.stringify(this.favorites));
            // console.log("Updated localStorage:", this.favorites);
         } else {
            localStorage.removeItem("favoritePosts");
            // console.log("Removed favoritePosts from localStorage");
         }

         Alpine.store("favoritesCount").updateCount(this.favorites.length);
         // console.log("Favorites count updated:", this.favorites.length);

         this.loadFavorites();
      },

      loadFavorites() {
         const ids = this.favorites; // Get the current list of favorite IDs
         const favoritesList = document.getElementById("favorites-list");
         const favoritesListContainer = document.getElementById("favoritesListContainer");
         // console.log("Fetching favorites: ", ids);

         if (!favoritesList) {
            // console.error("Favorites list element not found.");
            return;
         }

         if (!ids.length) {
            favoritesList.innerHTML = 'No favorites found.';
            favoritesListContainer.classList.remove("favoritesLoaded");
            favoritesListContainer.classList.add("notFound");
            // console.log("No favorites found.");
            return;
         }

         const params = new URLSearchParams();
         params.append("action", "get_favorite_posts");
         ids.forEach(id => params.append("ids[]", id));

         fetch("/wp-admin/admin-ajax.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: params.toString(),
         })
            .then(response => {
               if (!response.ok) {
                  throw new Error(`HTTP error! status: ${response.status}`);
               }
               // console.log("Favorites found:", ids);
               return response.text();

            })
            .then(html => {
               favoritesList.innerHTML = html;
               favoritesListContainer.classList.remove("notFound");
               favoritesListContainer.classList.add("favoritesLoaded");
            })
            .catch(error => {
               // console.error("Error fetching favorite posts:", error);
               favoritesList.innerHTML = 'Error loading favorites.';
               favoritesListContainer.classList.remove("favoritesLoaded");
               favoritesListContainer.classList.add("errorState");
            });
      },

      clear(id) {
         // console.log(this.favorites);
         // console.log("Clearing favorite from reactive state: ", id);
         this.favorites = this.favorites.filter(favId => favId !== id);
         // console.log("Updated favorites after clear:", this.favorites);
         // console.log("Favorites count in Alpine store:", Alpine.store("favoritesCount").count);
      },

      clearFavorites() {
         // Show confirmation dialog
         if (!window.confirm("Are you sure you want to delete all your favorites? This action cannot be undone.")) {
            return;
         }

         // Remove localStorage entry
         localStorage.removeItem("favoritePosts");
         // console.log("Cleared localStorage");

         // Clear reactive state
         this.favorites = [];
         // console.log("Clear reactive state favorites");
         // console.log(this.favorites);

         // Reset Alpine store count
         Alpine.store("favoritesCount")?.updateCount?.(0);
         // console.log("Reset Alpine store count");
         // console.log("Favorites count in Alpine store:", Alpine.store("favoritesCount").count);

         // Update the UI
         const favoritesList = document.getElementById("favorites-list");
         if (favoritesList) {
            favoritesList.innerHTML = 'No favorites found.';
         }
         // Broadcast event to update all components
         window.dispatchEvent(new CustomEvent('clear-favorites'));
      },

      addFavorite(id) {

         // Add the ID to Alpine store
         this.favorites.push(id);
         // console.log("Added to Alpine store:", id);

         // Update localStorage and the Alpine store
         // console.log("Favorites:", this.favorites);
         localStorage.setItem("favoritePosts", JSON.stringify(this.favorites));
         Alpine.store("favoritesCount").updateCount(this.favorites.length);

         // Update the UI
         this.loadFavorites();
      },

      removeFavorite(id) {

         // Remove the Alpine store
         this.favorites = this.favorites.filter(favId => favId !== id);
         // console.log("Removed from Alpine store:", id);

         // Update the count in the Alpine store
         Alpine.store("favoritesCount").updateCount(this.favorites.length);
         // console.log("Remaining Favorites, Alpine store:", this.favorites);

         // Update localStorage
         localStorage.setItem("favoritePosts", JSON.stringify(this.favorites));

         // Update the UI
         this.loadFavorites();

      },

      printPages(ids) {
         if (!ids.length) {
            // console.error("No favorite posts to print.");
            return;
         }
         ids.forEach((postId, index) => {
            setTimeout(() => {
               const postUrl = `/index.php?p=${postId}&print-friendly=true`; // or use permalink logic if needed
               const printWindow = window.open(postUrl, `_blank`);

               printWindow.onload = () => {
                  printWindow.print();
               };
            }, index * 2000); // stagger print jobs (adjust delay if needed)
         });
      },

   }));
});