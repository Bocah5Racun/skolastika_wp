jQuery.ajax({
  type: "get",
  url: `${ajaxObject.url}/wp-json/wp/v2/popup?_embed&per_page=1`,
  success: (results) => {
    if (!results.length) return;
    showPopup(results[0]);
  },
});

function showPopup(results) {
  if (getCookie("popup_timer")) return;

  document.cookie = "popup_timer=1; max-age=300; path=/";

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

function getCookie(name) {
  let value = "; " + document.cookie;
  let parts = value.split("; " + name + "=");
  if (parts.length === 2) return parts.pop().split(";").shift();
}
