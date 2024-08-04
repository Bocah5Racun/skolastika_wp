jQuery.ajax({
  type: "get",
  url: `${ajaxObject.url}/wp-json/wp/v2/popup?_embed&per_page=1`,
  success: (results) => {
    if (!results.length) return;
    showPopup(results[0]);
  },
});

function showPopup(results) {
  const postId = results.id;
  const thumbnailUrl = results._embedded["wp:featuredmedia"][0].source_url;

  const popup = document.createElement("div");
  popup.classList.add("popup-wrapper");

  popup.innerHTML += `
  <div class="popup-content-wrapper">
    <div class="popup-closer"></div>
    <a href="${results.link}">
        <img src="${thumbnailUrl}" />
    </a>
  </div>
  `;

  document.body.appendChild(popup);

  popup.querySelector(".popup-closer").addEventListener("click", (e) => {
    popup.remove();
  });
}
